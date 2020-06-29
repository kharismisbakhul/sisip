<?php namespace App\Models;

use CodeIgniter\Model;

class status_user extends Model
{
    protected $table      = 'status_user';
    protected $primaryKey = 'id_status_user';

    protected $useTimestamps = false;
}