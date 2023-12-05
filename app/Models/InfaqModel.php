<?php

namespace App\Models;

use CodeIgniter\Model;

class InfaqModel extends Model
{
    protected $table   = 'infaq';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->infaq = $db->table('infaq');
    }

    // --- infaq ---
    public function get_infaq($jenis = NULL, $limit = NULL)
    {
        $builder = $this->infaq;
        $builder->select('*');
        if ($jenis != NULL) {
            $builder->where('jenis', $jenis);
        }
        $builder->orderBy('id_infaq', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_infaq_by_id($id)
    {
        $builder = $this->infaq;
        $builder->select('*');
        $builder->where('id_infaq', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_infaq_total($data = NULL)
    {
        $builder = $this->infaq;
        $builder->select('sum(jml_dana) as jml');
        if ($data != NULL) {
            $builder->where($data);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_infaq($data)
    {
        return $this->infaq->insert($data);
    }

    public function update_infaq($data, $id)
    {
        $builder = $this->infaq;
        $builder->where('id_infaq', $id);
        return $builder->update($data);
    }

    public function delete_infaq($id)
    {
        $builder = $this->infaq;
        $builder->where('id_infaq', $id);
        return $builder->delete();
    }
}
