<?php namespace App\Models;

use CodeIgniter\Model;

class rancangan_per_tahun extends Model
{
    protected $table      = 'rancangan_per_tahun';
    protected $primaryKey = 'id_rancangan_per_tahun';

    protected $useTimestamps = false;
    
    protected $allowedFields = ['id_rancangan_per_tahun', 'id_rancangan_tugas', 'tahun', 'jumlah_total_tugas'];
    
}