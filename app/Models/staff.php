<?php namespace App\Models;

use CodeIgniter\Model;

class staff extends Model
{
    protected $table      = 'staff';
    protected $primaryKey = 'id_staff';

    protected $useTimestamps = false;
}