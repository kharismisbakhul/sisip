<?php namespace App\Models;

use CodeIgniter\Model;

class user extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'no_induk';

    protected $useTimestamps = false;
    protected $allowedFields = [
        'no_induk','password','nama', 'email', 'alamat', 'email', 'tahun_masuk', 'foto_profil', 'isPresensi',  'id_status_user', 'no_telepon'
    ];

    public function getUser($no_induk = false)
    {
        if ($no_induk == false) {
            return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->orderBy('user.no_induk', 'asc')->findAll();
            // return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->orderBy('user.no_induk', 'asc')->findAll();
        }

        return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->where(['no_induk' => $no_induk])->first();
    }

    public function getUserKepuasan()
    {
        return $this->join('status_user', 'user.id_status_user=status_user.id_status_user', 'left')->whereNotIn(
            'user.id_status_user',
            [1, 2]

        )->findAll();
    }
    public function getDaftarPekerjaanUser($no_induk)
    {

        $data = $this->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->first();
        switch ($data['kode_jabatan']) {
            case '3':
                return $this->select('d.nama')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();
                break;
            case '4':
                return $this->select('gm.nama')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('general_manager as gm', 'gm.id_general_manager=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();
                break;
            case '5':
                return $this->select('m.nama')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();
                break;
            case '6':
                return $this->select('s.nama')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();
                break;
            case '7':
                return $this->select('s.nama')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();
                break;

            default:
                return null;
                break;
        }
    }
}