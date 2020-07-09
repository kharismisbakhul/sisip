<?php namespace App\Models;

use CodeIgniter\Model;

class pesan extends Model
{
    protected $table      = 'pesan';
    protected $primaryKey = 'id_pesan';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_pesan', 'pesan', 'waktu', 'tanggal', 'user'
    ];
}