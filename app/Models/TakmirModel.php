<?php

namespace App\Models;

use CodeIgniter\Model;

class TakmirModel extends Model
{
    protected $table   = 'takmir';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->takmir = $db->table('takmir');
    }

    // --- takmir ---
    public function get_takmir($order = NULL, $limit = NULL)
    {
        $builder = $this->takmir;
        $builder->select('*');
        if ($order == NULL) {
            $builder->orderBy('id_takmir', 'DESC');
        } else {
            $builder->orderBy('id_takmir', $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    // --- takmir dengan pagination ---
    public function get_all_takmir($pagination)
    {
        return $this->select('*')
            ->orderBy('id_takmir', 'DESC')
            ->paginate($pagination);
    }

    public function get_takmir_by_id($id, $slug = NULL)
    {
        $builder = $this->takmir;
        $builder->select('*');
        $builder->where('id_takmir', $id);
        if ($slug != NULL) {
            $builder->where('takmir_seo', $slug);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_takmir_where($data = NULL)
    {
        $builder = $this->takmir;
        $builder->select('*');
        if ($data != NULL) {
            $builder->where($data);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_takmir($data)
    {
        return $this->takmir->insert($data);
    }

    public function update_takmir($data, $id)
    {
        $builder = $this->takmir;
        $builder->where('id_takmir', $id);
        return $builder->update($data);
    }

    public function delete_takmir($id)
    {
        $builder = $this->takmir;
        $builder->where('id_takmir', $id);
        return $builder->delete();
    }
}
