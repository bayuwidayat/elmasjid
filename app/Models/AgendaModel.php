<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table   = 'agenda';

    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->agenda = $db->table('agenda');
    }

    // --- agenda ---
    public function get_agenda($limit = NULL)
    {
        $builder = $this->agenda;
        $builder->select('*');
        $builder->orderBy('id_agenda', 'DESC');
        if ($limit != NULL) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_agenda_by_id($id, $user = NULL)
    {
        $builder = $this->agenda;
        $builder->select('*');
        $builder->where('id_agenda', $id);
        if ($user != NULL) {
            $builder->where('created_by', $user);
        }
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_agenda_detail($data)
    {
        $builder = $this->agenda;
        $builder->select('agenda.*, users.username, users.nama_lengkap, users.keterangan, users.foto');
        $builder->join('users', 'users.username=agenda.created_by', 'left');
        $builder->where($data);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_agenda($data)
    {
        return $this->agenda->insert($data);
    }

    public function update_agenda($data, $id)
    {
        $builder = $this->agenda;
        $builder->where('id_agenda', $id);
        return $builder->update($data);
    }

    public function delete_agenda($id)
    {
        $builder = $this->agenda;
        $builder->where('id_agenda', $id);
        return $builder->delete();
    }
}
