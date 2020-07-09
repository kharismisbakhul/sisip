<?php

namespace App\Models;

use CodeIgniter\Model;

class indeksNilai extends Model
{
    protected $table      = 'indeks_nilai';
    protected $primaryKey = 'id_nilai';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_nilai', 'id_pertanyaan', 'nilai', 'no_induk'];


    public function getJumlahUser($id_pertanyaa, $nilai)
    {
        return $this->where(['id_pertanyaan' => $id_pertanyaa, 'nilai' => $nilai])->findAll();
    }
}