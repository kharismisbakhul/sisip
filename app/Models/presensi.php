<?php namespace App\Models;

use CodeIgniter\Model;

class presensi extends Model
{
    protected $table      = 'presensi';
    protected $primaryKey = 'id_presensi';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_presensi', 'waktu_presensi_masuk', 'waktu_presensi_keluar', 'status_presensi', 'lokasi', 'status_tempat_kerja', 'id_riwayat_jabatan', 'tanggal_presensi'
    ];
}