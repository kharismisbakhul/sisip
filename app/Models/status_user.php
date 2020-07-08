<?php

namespace App\Models;

use CodeIgniter\Model;

class status_user extends Model
{
    protected $table      = 'status_user';
    protected $primaryKey = 'id_status_user';
    protected $useTimestamps = false;

    public function getStatusUser($id_status_user = false)
    {

        if ($id_status_user == false) {
            return $this->findAll();
        }

        return $this->where(['id_status_user' => $id_status_user])->first();
    }
}
