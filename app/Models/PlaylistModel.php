<?php

namespace App\Models;

use CodeIgniter\Model;

class PlaylistModel extends Model
{
    protected $table = 'playlist';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->playlist = $db->table('playlist');
    }

    // --- playlist ---
    public function get_playlist($aktif = NULL, $limit = NULL)
    {
        $builder = $this->playlist;
        $builder->select('*');
        if ($aktif != NULL) {
            $builder->where('aktif', 'Y');
        }
        $builder->orderBy('id_playlist', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_playlist_by_id($id)
    {
        $builder = $this->playlist;
        $builder->select('*');
        $builder->where('id_playlist', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_playlist_where($data, $order = NULL, $limit = NULL)
    {
        $builder = $this->playlist;
        $builder->select('*');
        $builder->where($data);
        if ($order != NULL) {
            $builder->orderBy('id_playlist', $order);
        } else {
            $builder->orderBy('id_playlist', 'DESC');
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    function get_all_combobox_playlist()
    {
        $data = $this->playlist->orderBy('id_playlist', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih playlist --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_playlist']] = $row['nm_playlist'];
            }
            return $result;
        }
    }

    function get_all_combobox_playlist_seo()
    {
        $data = $this->playlist->orderBy('id_playlist', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih playlist --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['playlist_seo']] = $row['nm_playlist'];
            }
            return $result;
        }
    }

    public function save_playlist($data)
    {
        return $this->playlist->insert($data);
    }

    public function update_playlist($data, $id)
    {
        $builder = $this->playlist;
        $builder->where('id_playlist', $id);
        return $builder->update($data);
    }

    public function delete_playlist($id)
    {
        $builder = $this->playlist;
        $builder->where('id_playlist', $id);
        return $builder->delete();
    }
}
