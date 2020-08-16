<?php namespace App\Models;

use CodeIgniter\Model;

class manager extends Model
{
    protected $table      = 'manager';
    protected $primaryKey = 'id_manager';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_manager', 'nama', 'id_gm'];
}