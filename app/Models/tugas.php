<?php namespace App\Models;

use CodeIgniter\Model;

class tugas extends Model
{
    protected $table      = 'tugas';
    protected $primaryKey = 'id_tugas';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_tugas', 'id_riwayat_jabatan', 'nama_tugas', 'tanggal_tugas', 'periode', 'jumlah_tugas', 'nomor_pekerjaan', 'status_tugas', 'kode_tugas', 'id_rancangan_tugas', 'catatan', 'bukti', 'waktu'
    ];
}