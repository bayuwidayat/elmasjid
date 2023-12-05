<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->users = $db->table('users');
    }

    // --- users ---
    public function get_all_users()
    {
        $builder = $this->users;
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_users($data)
    {
        $builder = $this->users;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_users_by_id($id)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('username', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_users_by_session($id)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('id_session', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_users_by_email($email)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('email', $email);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function cek_nisn($nisn)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('username', $nisn);
        return $builder->countAllResults();
    }

    public function cek_email($email)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('email', $email);
        return $builder->countAllResults();
    }

    public function get_users_by_level($level)
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('level', $level);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_users_by_level_user()
    {
        $builder = $this->users;
        $builder->select('*');
        $builder->where('level', 'user');
        return $builder->countAllResults();
    }

    function get_all_combobox_users()
    {
        $data = $this->users->orderBy('nama_lengkap', 'ASC')->get();
        foreach ($data->getResultArray() as $row) {
            $result[''] = '- Pilih -';
            $result[$row['username']] = $row['nm_users'];
        }

        if (isset($result)) {
            return $result;
        } else {
            $result[''] = '- Pilih -';
            return $result;
        }
    }

    public function save_users($data)
    {
        return $this->users->insert($data);
    }

    public function update_users($data, $id)
    {
        $builder = $this->users;
        $builder->where('id_session', $id);
        return $builder->update($data);
    }

    public function delete_users($id)
    {
        $builder = $this->users;
        $builder->where('id_session', $id);
        return $builder->delete();
    }

    public function update_users_profile($data, $id, $uname)
    {
        $builder = $this->users;
        $builder->where('username', $uname);
        $builder->where('id_session', $id);
        return $builder->update($data);
    }
}
