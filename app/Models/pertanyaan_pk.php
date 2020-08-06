<?php

namespace App\Models;

use CodeIgniter\Model;

class pertanyaan_pk extends Model
{
    protected $table      = 'pertanyaan_pk';
    protected $primaryKey = 'id_pertanyaan_pk';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_pk', 'id_pertanyaan_pk', 'pertanyaan_pk', 'aspek_pk'];

    public function getPertanyaanpk($id_pk)
    {
        return $this->where(['id_pk' => $id_pk])->findAll();
    }

    public function getLastID()
    {
        return $this->selectMax('id_pertanyaan_pk')->first();
    }
}
