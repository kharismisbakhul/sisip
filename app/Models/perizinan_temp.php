<?php namespace App\Models;

use CodeIgniter\Model;

class perizinan_temp extends Model
{
    protected $table      = 'perizinan_temp';
    protected $primaryKey = 'id_perizinan';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_perizinan', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'bukti', 'no_induk', 'status_izin', 'kategori_izin', 'tanggal_izin', 'waktu_izin'
    ];
}