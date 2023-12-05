<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->kategori = $db->table('kategori');
    }

    // --- kategori ---
    public function get_kategori($order = NULL)
    {
        $builder = $this->kategori;
        $builder->select('*');
        if ($order != NULL) {
            $builder->orderBy('id_kategori', $order);
        } else {
            $builder->orderBy('id_kategori', 'DESC');
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_kategori_by_id($id)
    {
        $builder = $this->kategori;
        $builder->select('*');
        $builder->where('id_kategori', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function get_all_combobox_kategori()
    {
        $data = $this->kategori->orderBy('id_kategori', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih kategori --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_kategori']] = $row['nm_kategori'];
            }
            return $result;
        }
    }

    function get_all_combobox_kategori_seo()
    {
        $data = $this->kategori->orderBy('id_kategori', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih kategori --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['kategori_seo']] = $row['nm_kategori'];
            }
            return $result;
        }
    }

    public function save_kategori($data)
    {
        return $this->kategori->insert($data);
    }

    public function update_kategori($data, $id)
    {
        $builder = $this->kategori;
        $builder->where('id_kategori', $id);
        return $builder->update($data);
    }

    public function delete_kategori($id)
    {
        $builder = $this->kategori;
        $builder->where('id_kategori', $id);
        return $builder->delete();
    }
}
