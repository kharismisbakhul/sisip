<?php namespace App\Models;

use CodeIgniter\Model;

class menu extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id_menu';

    protected $useTimestamps = false;
}