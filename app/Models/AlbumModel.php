<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table = 'album';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->album = $db->table('album');
    }

    // --- album ---
    public function get_album($aktif = NULL, $limit = NULL)
    {
        $builder = $this->album;
        $builder->select('*');
        if ($aktif != NULL) {
            $builder->where('aktif', 'Y');
        }
        $builder->orderBy('id_album', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_album_by_id($id)
    {
        $builder = $this->album;
        $builder->select('*');
        $builder->where('id_album', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_album_where($data, $order = NULL, $limit = NULL)
    {
        $builder = $this->album;
        $builder->select('*');
        $builder->where($data);
        if ($order != NULL) {
            $builder->orderBy('id_album', $order);
        } else {
            $builder->orderBy('id_album', 'DESC');
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    function get_all_combobox_album()
    {
        $data = $this->album->orderBy('id_album', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih album --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_album']] = $row['nm_album'];
            }
            return $result;
        }
    }

    function get_all_combobox_album_seo()
    {
        $data = $this->album->orderBy('id_album', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih album --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['album_seo']] = $row['nm_album'];
            }
            return $result;
        }
    }

    public function save_album($data)
    {
        return $this->album->insert($data);
    }

    public function update_album($data, $id)
    {
        $builder = $this->album;
        $builder->where('id_album', $id);
        return $builder->update($data);
    }

    public function delete_album($id)
    {
        $builder = $this->album;
        $builder->where('id_album', $id);
        return $builder->delete();
    }
}
