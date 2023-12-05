<?php

namespace App\Models;

use CodeIgniter\Model;

class SekilasinfoModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->sekilasinfo = $db->table('sekilasinfo');
    }

    // --- sekilasinfo ---
    public function get_sekilasinfo($limit = NULL, $order = NULL, $aktif = NULL)
    {
        $builder = $this->sekilasinfo;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_sekilasinfo', $order);
        } else {
            $builder->orderBy('id_sekilasinfo', 'DESC');
        }
        if ($aktif != NULL) {
            $builder->where('aktif', $aktif);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_sekilasinfo_by_id($id)
    {
        $builder = $this->sekilasinfo;
        $builder->select('*');
        $builder->where('id_sekilasinfo', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_sekilasinfo($data)
    {
        return $this->sekilasinfo->insert($data);
    }

    public function update_sekilasinfo($data, $id)
    {
        $builder = $this->sekilasinfo;
        $builder->where('id_sekilasinfo', $id);
        return $builder->update($data);
    }

    public function delete_sekilasinfo($id)
    {
        $builder = $this->sekilasinfo;
        $builder->where('id_sekilasinfo', $id);
        return $builder->delete();
    }
}
