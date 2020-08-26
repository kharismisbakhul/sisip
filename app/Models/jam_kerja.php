<?php namespace App\Models;

use CodeIgniter\Model;

class jam_kerja extends Model
{
    protected $table      = 'jam_kerja';
    protected $primaryKey = 'id_jam_kerja';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_jam_kerja', 'jam_kerja_masuk', 'jam_kerja_keluar', 'id_jabatan', 'status_aktif', 'status_jam_kerja'];

    public function getJamKerja()
    {

        $data = $this->join('jabatan', 'jam_kerja.id_jabatan = jabatan.id_jabatan')->findAll();
        $i = 0;
        // dd($data);
        $temp = [];
        foreach ($data as $d) {
            switch ($d['kode_jabatan']) {
                case '3':
                    $temp[$i] = $this->select('jabatan.*,jam_kerja.*,su.*,d.nama as nama')->join('jabatan', 'jabatan.id_jabatan=jam_kerja.id_jabatan', 'left')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $d['detail_jabatan'])->first();
                    break;
                case '4':
                    $temp[$i] = $this->join('jabatan', 'jabatan.id_jabatan=jam_kerja.id_jabatan', 'left')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->where('gm.id_gm', $d['detail_jabatan'])->first();
                    break;
                case '5':
                    $temp[$i] = $this->join('jabatan', 'jabatan.id_jabatan=jam_kerja.id_jabatan', 'left')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $d['detail_jabatan'])->first();
                    break;
                case '6':
                    $temp[$i] = $this->join('jabatan', 'jabatan.id_jabatan=jam_kerja.id_jabatan', 'left')->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->where('s.id_supervisor', $d['detail_jabatan'])->first();
                    break;
                case '7':
                    $temp[$i] = $this->join('jabatan', 'jabatan.id_jabatan=jam_kerja.id_jabatan', 'left')->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $d['kode_jabatan'])->where('s.id_staff', $d['detail_jabatan'])->first();
                    break;
                default:
                    $temp[$i] = null;
                    break;
            }
            $i++;
        }
        return $temp;
    }
}