<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersmodulModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->usersmodul = $db->table('usersmodul');
    }

    // --- usersmodul ---
    public function get_usersmodul()
    {
        $builder = $this->usersmodul;
        $builder->select('*');
        $builder->orderBy('id_usersmodul', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_usersmodul_by_id($id)
    {
        $builder = $this->usersmodul;
        $builder->select('*');
        $builder->where('id_usersmodul', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_usersmodul_by_username($username)
    {
        $builder = $this->usersmodul;
        $builder->select('usersmodul.*, modul.nm_modul');
        $builder->join('modul', 'modul.id_modul=usersmodul.modul_id', 'left');
        $builder->where('usersmodul.username', $username);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_hak_akses($link, $username)
    {
        $builder = $this->usersmodul;
        $builder->select('*');
        $builder->join('modul', 'modul.id_modul=usersmodul.modul_id', 'left');
        $builder->where('usersmodul.username', $username);
        $builder->where('modul.links', $link);
        return $builder->countAllResults();
    }

    function get_all_combobox_usersmodul()
    {
        $data = $this->usersmodul->orderBy('id_usersmodul', 'ASC')->get();
        $numrows = count($data->getResult());

        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_usersmodul']] = $row['nm_usersmodul'];
            }
            return $result;
        }
    }

    public function save_usersmodul($data)
    {
        return $this->usersmodul->insert($data);
    }

    public function update_usersmodul($data, $id)
    {
        $builder = $this->usersmodul;
        $builder->where('id_usersmodul', $id);
        return $builder->update($data);
    }

    public function delete_usersmodul($id)
    {
        $builder = $this->usersmodul;
        $builder->where('id_usersmodul', $id);
        return $builder->delete();
    }

    public function delete_by_username($username)
    {
        $builder = $this->usersmodul;
        $builder->where('username', $username);
        return $builder->delete();
    }
}
