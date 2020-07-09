<?php namespace App\Models;

use CodeIgniter\Model;

class user extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'no_induk';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'no_induk','password','nama', 'email', 'alamat', 'email', 'tahun_masuk', 'foto_profil', 'isPresensi',  'id_status_user'
    ];

    public function getUser($no_induk = false)
    {
        if ($no_induk == false) {
            return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->findAll();
        }

        return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->where(['no_induk' => $no_induk])->first();
    }

    public function getUserKepuasan()
    {
        return $this->whereNotIn(
            'id_status_user',
            [1, 2]

        )->findAll();
    }
}