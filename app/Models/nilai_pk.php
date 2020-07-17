<?php

namespace App\Models;

use CodeIgniter\Model;

class nilai_pk extends Model
{
    protected $table      = 'nilai_pk';
    protected $primaryKey = 'id_nilai_pk';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_nilai', 'id_pertanyaan_pk', 'nilai', 'no_induk', 'id_pemberi_nilai'];
}
