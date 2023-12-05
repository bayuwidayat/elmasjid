<?php

namespace App\Models;

use CodeIgniter\Model;

class ModulModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->modul = $db->table('modul');
    }

    // --- modul ---
    public function get_modul()
    {
        $builder = $this->modul;
        $builder->select('*');
        $builder->orderBy('id_modul', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_modul_by_id($id)
    {
        $builder = $this->modul;
        $builder->select('*');
        $builder->where('id_modul', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function get_all_combobox_modul()
    {
        $data = $this->modul->orderBy('id_modul', 'ASC')->get();
        $numrows = count($data->getResult());

        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_modul']] = $row['nm_modul'];
            }
            return $result;
        }
    }

    public function save_modul($data)
    {
        return $this->modul->insert($data);
    }

    public function update_modul($data, $id)
    {
        $builder = $this->modul;
        $builder->where('id_modul', $id);
        return $builder->update($data);
    }

    public function delete_modul($id)
    {
        $builder = $this->modul;
        $builder->where('id_modul', $id);
        return $builder->delete();
    }
}
