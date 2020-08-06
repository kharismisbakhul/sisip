<?php namespace App\Models;

use CodeIgniter\Model;

class rancangan_tugas extends Model
{
    protected $table      = 'rancangan_tugas';
    protected $primaryKey = 'id_rancangan_tugas';

    protected $useTimestamps = false;
    
    protected $allowedFields = ['id_rancangan_tugas', 'id_jabatan', 'nama_tugas', 'periode', 'jumlah_total_tugas', 'nomor_pekerjaan', 'status_tugas', 'kode_tugas'];
    
    public function getLastID()
    {
        return $this->selectMax('id_rancangan_tugas')->first();
    }
}