<?php namespace App\Models;

use CodeIgniter\Model;

class tugas extends Model
{
    protected $table      = 'tugas';
    protected $primaryKey = 'id_tugas';

    protected $useTimestamps = false;
}