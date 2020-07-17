<?php

namespace App\Models;

use CodeIgniter\Model;

class pengumuman extends Model
{
    protected $table      = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_pengumuman', 'pengumuman', 'tanggal_pengumuman', 'waktu_pengumuman', 'publisher', 'status_pengumuman'];

    public function getPengumuman()
    {
        return $this->join('user as u', 'u.no_induk=pengumuman.publisher', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
    }
}
