<?php namespace App\Models;

use CodeIgniter\Model;

class user extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'no_induk';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'nama', 'email', 'no_telepon', 'alamat', 'isPresensi'
    ];
}