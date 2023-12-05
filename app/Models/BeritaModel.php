<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table   = 'berita';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->berita = $db->table('berita');
    }

    // --- berita ---
    public function get_berita($tipe = NULL, $limit = NULL, $aktif = NULL, $pagination = NULL)
    {
        $builder = $this->berita;

        if ($tipe != NULL) {
            if ($tipe == 'berita') {
                $builder->select('berita.*, kategori.nm_kategori, kategori.id_kategori, kategori.kategori_seo');
                $builder->join('kategori', 'kategori.id_kategori=berita.id_kategori', 'left');
                $builder->where('berita.tipe', $tipe);
            } else {
                $builder->select('*');
                $builder->where('berita.tipe', $tipe);
            }
        }
        if ($aktif != NULL) {
            $builder->where('berita.status', $aktif);
        }
        $builder->orderBy('berita.id_berita', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        if ($pagination != NULL) {
            return $builder;
        } else {
            $query = $builder->get();
            return $query->getResult();
        }
    }

    public function get_all_berita($tipe, $pagination, $user = NULL, $keyword = NULL)
    {

        if ($tipe == 'berita') {
            $builder = $this->select('berita.*, kategori.nm_kategori, kategori.id_kategori, kategori.kategori_seo');
            $builder->join('kategori', 'kategori.id_kategori=berita.id_kategori');
        } else {
            $builder = $this->select('*');
        }
        if ($keyword != NULL) {
            $builder->like('berita.judul', $keyword);
            $builder->orlike('berita.isi_berita', $keyword);
        }
        if ($user != NULL) {
            $builder->where('berita.created_by', $user);
        }
        $builder->where('berita.tipe', $tipe);
        $builder->orderBy('berita.id_berita', 'DESC');
        return $builder->paginate($pagination);
    }

    public function get_berita_by_id($id, $user = NULL)
    {
        $builder = $this->berita;
        $builder->select('*');
        $builder->where('id_berita', $id);
        if ($user != NULL) {
            $builder->where('created_by', $user);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_berita_detail($data)
    {
        $builder = $this->berita;
        $builder->select('berita.*, kategori.nm_kategori, kategori.kategori_seo, users.username, users.nama_lengkap, users.keterangan, users.berita');
        $builder->join('kategori', 'kategori.id_kategori=berita.id_kategori', 'left');
        $builder->join('users', 'users.username=berita.created_by', 'left');
        $builder->where($data);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_berita_where($data = NULL, $dataOrder = NULL, $order = NULL, $limit = NULL)
    {
        $builder = $this->berita;
        $builder->select('berita.*, kategori.nm_kategori, kategori.kategori_seo');
        $builder->join('kategori', 'kategori.id_kategori=berita.id_kategori', 'left');
        if ($data != NULL) {
            $builder->where($data);
        }
        if ($dataOrder != NULL and $order != NULL) {
            $builder->orderBy($dataOrder, $order);
        }
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    // --- berita berdasarkan Tag ---
    public function get_berita_by_tag($data, $pagination)
    {
        return $this->select('berita.*, kategori.nm_kategori, kategori.id_kategori, kategori.kategori_seo')
            ->join('kategori', 'kategori.id_kategori=berita.id_kategori', 'left')
            ->like('berita.tag', $data)
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate($pagination);
    }

    // --- berita berdasarkan Kategori ---
    public function get_berita_by_kategori($data, $pagination)
    {
        return $this->select('berita.*, kategori.nm_kategori, kategori.id_kategori, kategori.kategori_seo')
            ->join('kategori', 'kategori.id_kategori=berita.id_kategori')
            ->like('kategori.kategori_seo', $data)
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate($pagination);
    }

    // --- berita berdasarkan Author / Penulis ---
    public function get_berita_by_author($data, $pagination)
    {
        return $this->select('berita.*, kategori.nm_kategori, kategori.id_kategori, kategori.kategori_seo')
            ->join('kategori', 'kategori.id_kategori=berita.id_kategori')
            ->like('berita.created_by', $data)
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate($pagination);
    }

    public function save_berita($data)
    {
        return $this->berita->insert($data);
    }

    public function update_berita($data, $id)
    {
        $builder = $this->berita;
        $builder->where('id_berita', $id);
        return $builder->update($data);
    }

    public function delete_berita($id)
    {
        $builder = $this->berita;
        $builder->where('id_berita', $id);
        return $builder->delete();
    }

    public function delete_berita_by_user($id, $user)
    {
        $builder = $this->berita;
        $builder->where('id_berita', $id);
        $builder->where('created_by', $user);
        return $builder->delete();
    }
}
