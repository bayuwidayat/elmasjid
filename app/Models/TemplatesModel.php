<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplatesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->templates = $db->table('templates');
    }

    // --- templates ---
    public function get_templates()
    {
        $builder = $this->templates;
        $builder->select('*');
        $builder->orderBy('id_templates', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_templates_by_id($id)
    {
        $builder = $this->templates;
        $builder->select('*');
        $builder->where('id_templates', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function get_templates_aktif()
    {
        $builder = $this->templates;
        $builder->select('*');
        $builder->where('aktif', 'Y');
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function get_all_combobox_templates()
    {
        $data = $this->templates->orderBy('id_templates', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = '-- pilih templates --';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_templates']] = $row['nm_templates'];
            }
            return $result;
        }
    }

    public function save_templates($data)
    {
        return $this->templates->insert($data);
    }

    public function update_templates($data, $id)
    {
        $builder = $this->templates;
        $builder->where('id_templates', $id);
        return $builder->update($data);
    }

    public function nonaktifkan_templates($data, $id)
    {
        $builder = $this->templates;
        $builder->where('id_templates !=', $id);
        return $builder->update($data);
    }

    public function delete_templates($id)
    {
        $builder = $this->templates;
        $builder->where('id_templates', $id);
        return $builder->delete();
    }
}
