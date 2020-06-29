<?php namespace App\Models;

use CodeIgniter\Model;

class feedback extends Model
{
    protected $table      = 'feedback';
    protected $primaryKey = 'id_feedback';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_feedback', 'feedback', 'no_induk', 'kategori_feedback', 'file_pendukung'
    ];
}