<?php

namespace App\Models;

use CodeIgniter\Model;

class feedback extends Model
{
    protected $table      = 'feedback';
    protected $primaryKey = 'id_feedback';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_feedback', 'feedback', 'no_induk', 'kategori_feedback', 'file_pendukung'
    ];

    public function getFeedback()
    {
        return $this->join('user', 'user.no_induk=feedback.no_induk', 'left')->join('kategori_feedback as kf', 'kf.id_kategori=feedback.kategori_feedback', 'left')->findAll();
    }
}
