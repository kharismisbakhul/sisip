<?php namespace App\Models;

use CodeIgniter\Model;

class supervisor extends Model
{
    protected $table      = 'supervisor';
    protected $primaryKey = 'id_supervisor';

    protected $useTimestamps = false;
}