<?php namespace App\Models;

use CodeIgniter\Model;

class pengumuman extends Model
{
    protected $table      = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $useTimestamps = false;
}