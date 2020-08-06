<?php namespace App\Models;

use CodeIgniter\Model;

class perizinan extends Model
{
    protected $table      = 'perizinan';
    protected $primaryKey = 'id_perizinan';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_perizinan', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'bukti', 'no_induk', 'status_izin', 'kategori_izin', 'tanggal_izin'
    ];
}