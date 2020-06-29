<?php namespace App\Models;

use CodeIgniter\Model;

class penilaian_kinerja extends Model
{
    protected $table      = 'penilaian_kinerja';
    protected $primaryKey = 'id_penilaian_kinerja';

    protected $useTimestamps = false;
}