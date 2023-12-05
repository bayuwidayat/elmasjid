<?php

namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->menus = $db->table('menus');
    }

    // --- menus ---
    public function get_menus()
    {
        $builder = $this->menus;
        $builder->select('*');
        $builder->orderBy('id_menus', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_menus_utama($aktif = NULL)
    {
        $builder = $this->menus;
        $builder->select('*');
        $builder->where('parent_id', '0');
        if ($aktif != NULL) {
            $builder->where('aktif', $aktif);
        }
        $builder->orderBy('urutan', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_sub_menus($id, $aktif = NULL)
    {
        $builder = $this->menus;
        $builder->select('*');
        $builder->where('parent_id', $id);
        if ($aktif != NULL) {
            $builder->where('aktif', $aktif);
        }
        $builder->orderBy('urutan', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_menus_by_like($data)
    {
        $builder = $this->menus;
        $builder->select('*');
        $builder->like($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_menus_by_id($id)
    {
        $builder = $this->menus;
        $builder->select('*');
        $builder->where('id_menus', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function get_all_combobox_menus()
    {
        $data = $this->menus->orderBy('id_menus', 'ASC')->get();
        $numrows = count($data->getResult());

        $result[''] = 'Menu Utama';
        if ($numrows > 0) {
            foreach ($data->getResultArray() as $row) {
                $result[$row['id_menus']] = $row['nm_menus'];
            }
            return $result;
        }
    }

    public function save_menus($data)
    {
        return $this->menus->insert($data);
    }

    public function update_menus($data, $id)
    {
        $builder = $this->menus;
        $builder->where('id_menus', $id);
        return $builder->update($data);
    }

    public function delete_menus($id)
    {
        $builder = $this->menus;
        $builder->where('id_menus', $id);
        return $builder->delete();
    }
}
