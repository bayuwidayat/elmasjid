<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->slider = $db->table('slider');
    }

    // --- slider ---
    public function get_slider($aktif = NULL)
    {
        $builder = $this->slider;
        $builder->select('*');
        if ($aktif != NULL) {
            $builder->where('aktif', $aktif);
        }
        $builder->orderBy('id_slider', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_slider_by_id($id)
    {
        $builder = $this->slider;
        $builder->select('*');
        $builder->where('id_slider', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    // --- slider ---
    public function get_slider_home($limit = NULL)
    {
        $builder = $this->slider;
        $builder->select('*');
        $builder->where('aktif', 'Y');
        $builder->orderBy('id_slider', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_slider($data)
    {
        return $this->slider->insert($data);
    }

    public function update_slider($data, $id)
    {
        $builder = $this->slider;
        $builder->where('id_slider', $id);
        return $builder->update($data);
    }

    public function delete_slider($id)
    {
        $builder = $this->slider;
        $builder->where('id_slider', $id);
        return $builder->delete();
    }
}
