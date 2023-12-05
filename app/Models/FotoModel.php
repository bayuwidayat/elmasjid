<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table   = 'foto';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->foto = $db->table('foto');
    }

    // --- foto ---
    public function get_foto($order = NULL, $limit = NULL, $album = NULL, $aktif = NULL)
    {
        $builder = $this->foto;
        $builder->select('foto.*,album.nm_album');
        $builder->join('album', 'album.id_album=foto.album_id', 'left');
        if ($album != NULL) {
            $builder->where('foto.album_id', $album);
        }
        if ($order == NULL) {
            $builder->orderBy('foto.id_foto', 'DESC');
        } else {
            $builder->orderBy('foto.id_foto', $order);
        }
        if ($aktif != NULL) {
            $builder->where('album.aktif', $aktif);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    // --- foto dengan pagination ---
    public function get_all_foto($pagination)
    {
        return $this->select('foto.*, album.nm_album')
            ->join('album', 'album.id_album=foto.album_id')
            ->orderBy('foto.id_foto', 'DESC')
            ->paginate($pagination);
    }

    public function get_foto_by_id($id, $slug = NULL)
    {
        $builder = $this->foto;
        $builder->select('foto.*,album.nm_album');
        $builder->join('album', 'album.id_album=foto.album_id', 'left');
        $builder->where('foto.id_foto', $id);
        if ($slug != NULL) {
            $builder->where('foto.foto_seo', $slug);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_foto_where($data)
    {
        $builder = $this->foto;
        $builder->select('foto.*,album.nm_album');
        $builder->join('album', 'album.id_album=foto.album_id', 'left');
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    function get_all_combobox_foto()
    {
        $data = $this->foto->orderBy('id_foto', 'ASC')->get();
        $numrows = count($data->getResult());

        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_foto']] = $row['nm_foto'];
            }
            return $result;
        }
    }

    public function save_foto($data)
    {
        return $this->foto->insert($data);
    }

    public function update_foto($data, $id)
    {
        $builder = $this->foto;
        $builder->where('id_foto', $id);
        return $builder->update($data);
    }

    public function delete_foto($id)
    {
        $builder = $this->foto;
        $builder->where('id_foto', $id);
        return $builder->delete();
    }
}
