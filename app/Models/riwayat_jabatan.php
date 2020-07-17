<?php

namespace App\Models;

use CodeIgniter\Model;

class riwayat_jabatan extends Model
{
    protected $table      = 'riwayat_jabatan';
    protected $primaryKey = 'id_riwayat_jabatan';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_riwayat_jabatan', 'no_induk', 'id_jabatan', 'status_aktif', 'periode_mulai_jabatan', 'periode_akhir_jabatan'];


    public function getRiwayatJabatan($no_induk)
    {
        $jabatan = [];
        $data = $this->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.no_induk', $no_induk)->findAll();

        $i = 0;
        foreach ($data as $d) {
            switch ($d['kode_jabatan']) {
                case '3':
                    $jabatan[$i++] = $this->select('d.nama_direktur as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan,riwayat_jabatan.status_aktif,riwayat_jabatan.periode_mulai_jabatan,riwayat_jabatan.periode_akhir_jabatan,riwayat_jabatan.id_riwayat_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.id_riwayat_jabatan', $d['id_riwayat_jabatan'])->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $d['detail_jabatan'])->first();
                    break;
                case '4':
                    $jabatan[$i++] = $this->select('gm.nama_general_manager as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_general_manager as id,jabatan.kode_jabatan,riwayat_jabatan.status_aktif,riwayat_jabatan.periode_mulai_jabatan,riwayat_jabatan.periode_akhir_jabatan,riwayat_jabatan.id_riwayat_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.id_riwayat_jabatan', $d['id_riwayat_jabatan'])->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('general_manager as gm', 'gm.id_general_manager=jabatan.detail_jabatan', 'left')->where('gm.id_general_manager', $d['detail_jabatan'])->first();
                    break;
                case '5':
                    $jabatan[$i++] = $this->select('m.nama_manager as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan,riwayat_jabatan.status_aktif,riwayat_jabatan.periode_mulai_jabatan,riwayat_jabatan.periode_akhir_jabatan,riwayat_jabatan.id_riwayat_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.id_riwayat_jabatan', $d['id_riwayat_jabatan'])->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $d['detail_jabatan'])->first();
                    break;
                case '6':
                    $jabatan[$i++] = $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_supervisor as id,jabatan.kode_jabatan,riwayat_jabatan.status_aktif,riwayat_jabatan.periode_mulai_jabatan,riwayat_jabatan.periode_akhir_jabatan,riwayat_jabatan.id_riwayat_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.id_riwayat_jabatan', $d['id_riwayat_jabatan'])->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->where('s.id_supervisor', $d['detail_jabatan'])->first();
                    break;
                case '7':
                    $jabatan[$i++] = $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_staff as id,jabatan.kode_jabatan,riwayat_jabatan.status_aktif,riwayat_jabatan.periode_mulai_jabatan,riwayat_jabatan.periode_akhir_jabatan,riwayat_jabatan.id_riwayat_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('riwayat_jabatan.id_riwayat_jabatan', $d['id_riwayat_jabatan'])->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('s.id_staff', $d['detail_jabatan'])->first();
                    break;
                default:
                    $jabatan[$i++] = null;
                    break;
            }
        }

        return $jabatan;
    }
}
