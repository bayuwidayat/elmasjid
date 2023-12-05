<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table   = 'pengumuman';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->pengumuman = $db->table('pengumuman');
    }

    // --- pengumuman ---
    public function get_pengumuman($limit = NULL)
    {
        $builder = $this->pengumuman;
        $builder->select('*');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $builder->orderBy('id_pengumuman', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_pengumuman_by_id($id, $user = NULL)
    {
        $builder = $this->pengumuman;
        $builder->select('*');
        $builder->where('id_pengumuman', $id);
        if ($user != NULL) {
            $builder->where('created_by', $user);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_pengumuman_where($data)
    {
        $builder = $this->pengumuman;
        $builder->select('*');
        $builder->where($data);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_pengumuman($data)
    {
        return $this->pengumuman->insert($data);
    }

    public function update_pengumuman($data, $id)
    {
        $builder = $this->pengumuman;
        $builder->where('id_pengumuman', $id);
        return $builder->update($data);
    }

    public function delete_pengumuman($id)
    {
        $builder = $this->pengumuman;
        $builder->where('id_pengumuman', $id);
        return $builder->delete();
    }
}
