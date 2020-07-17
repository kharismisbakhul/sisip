<?php

namespace App\Models;

use CodeIgniter\Model;

class jabatan extends Model
{
    protected $table      = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $useTimestamps = false;

    public function getJabtan($kode_jabatan, $detail_jabatan)
    {
        switch ($kode_jabatan) {
            case '3':
                return $this->select('d.nama_direktur as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $detail_jabatan)->first();
                break;
            case '4':
                return $this->select('gm.nama_general_manager as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_general_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('general_manager as gm', 'gm.id_general_manager=jabatan.detail_jabatan', 'left')->where('gm.id_general_manager', $detail_jabatan)->first();
                break;
            case '5':
                return $this->select('m.nama_manager as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $detail_jabatan)->first();
                break;
            case '6':
                return $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_supervisor as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->where('s.id_supervisor', $detail_jabatan)->first();
                break;
            case '7':
                return $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_staff as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('s.id_staff', $detail_jabatan)->first();
                break;

            default:
                return null;
                break;
        }
    }

    public function getDaftarJabatan($kode_jabatan)
    {
        switch ($kode_jabatan) {
            case '3':
                return $this->select('d.nama_direktur as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '4':
                return $this->select('gm.nama_general_manager as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_general_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('general_manager as gm', 'gm.id_general_manager=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '5':
                return $this->select('m.nama_manager as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '6':
                return $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_supervisor as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '7':
                return $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_staff as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->findAll();
                break;
            default:
                return null;
                break;
        }
    }
}
