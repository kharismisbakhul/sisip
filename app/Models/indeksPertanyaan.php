<?php

namespace App\Models;

use CodeIgniter\Model;

class indeksPertanyaan extends Model
{
    protected $table      = 'indeks_pertanyaan';
    protected $primaryKey = 'id_pertanyaan';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_pertanyaan', 'pertanyaan', 'id_indeks'];

    public function getPertanyaan($id_indeks = false)
    {
        if ($id_indeks) {
            return $this->where(['id_indeks' => $id_indeks])->findAll();
        }
        return $this->findAll();
    }
}