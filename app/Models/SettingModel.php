<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->setting = $db->table('setting');
    }

    // --- setting ---
    public function get_setting()
    {
        $builder = $this->setting;
        $builder->select('*');
        $builder->where('id_setting', 2);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function update_setting($data, $id)
    {
        $builder = $this->setting;
        $builder->where('id_setting', $id);
        return $builder->update($data);
    }
}
