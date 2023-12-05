<?php

namespace App\Models;

use CodeIgniter\Model;

class HalamanModel extends Model
{
    protected $table   = 'halaman';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->halaman = $db->table('halaman');
    }

    // --- halaman ---
    public function get_halaman($jenis = NULL)
    {
        $builder = $this->halaman;
        $builder->select('*');
        if ($jenis != NULL) {
            $builder->where('jenis', $jenis);
        }
        $builder->orderBy('id_halaman', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_all_halaman($jenis = NULL, $pagination, $user = NULL, $keyword = NULL)
    {
        $builder = $this->select('*');
        if ($jenis != NULL) {
            $builder->where('jenis', $jenis);
        }
        if ($user != NULL) {
            $builder->where('created_by', $user);
        }
        if ($keyword != NULL) {
            $builder->like('judul', $keyword);
            $builder->orlike('isi_halaman', $keyword);
        }
        $builder->orderBy('id_halaman', 'DESC');
        return $builder->paginate($pagination);
    }

    public function get_halaman_by_id($id, $user = NULL)
    {
        $builder = $this->halaman;
        $builder->select('*');
        $builder->where('id_halaman', $id);
        if ($user != NULL) {
            $builder->where('created_by', $user);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_halaman_where($data, $limit = NULL)
    {
        $builder = $this->halaman;
        $builder->select('*');
        $builder->where($data);
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    function get_all_combobox_halaman()
    {
        $data = $this->halaman->orderBy('id_halaman', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- Pilih Halaman --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_halaman'] . '/' . $row['judul_seo']] = $row['judul'];
            }
            return $result;
        }
    }

    public function save_halaman($data)
    {
        return $this->halaman->insert($data);
    }

    public function update_halaman($data, $id)
    {
        $builder = $this->halaman;
        $builder->where('id_halaman', $id);
        return $builder->update($data);
    }

    public function delete_halaman($id)
    {
        $builder = $this->halaman;
        $builder->where('id_halaman', $id);
        return $builder->delete();
    }

    public function delete_halaman_by_user($id, $user)
    {
        $builder = $this->halaman;
        $builder->where('id_halaman', $id);
        $builder->where('created_by', $user);
        return $builder->delete();
    }
}
