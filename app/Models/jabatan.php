<?php namespace App\Models;

use CodeIgniter\Model;

class jabatan extends Model
{
    protected $table      = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_jabatan', 'kode_jabatan', 'detail_jabatan'];

    public function getUnitKerja($kode_jabatan, $detail_jabatan){
        switch ($kode_jabatan) {
            case '3':
                $direktur = model('direktur');
                return $direktur->select('nama')->where('id_direktur', $detail_jabatan)->first();
                break;
            case '4':
                $gm = model('general_manager');
                $data_gm = $gm->where('id_gm', $detail_jabatan)->first();
                $direktur = model('direktur');
                return $direktur->select('nama')->where('id_direktur', $data_gm['id_direktur'])->first();
                break;
            case '5':
                $manager = model('manager');
                $data_m = $manager->where('id_manager', $detail_jabatan)->first();
                $gm = model('general_manager');
                $data_gm = $gm->where('id_gm', $data_m['id_gm'])->first();
                $direktur = model('direktur');
                return $direktur->select('nama')->where('id_direktur', $data_gm['id_direktur'])->first();
                break;
            case '6':
                $supervisor = model('supervisor');
                $data_sp = $supervisor->where('id_supervisor', $detail_jabatan)->first();
                $manager = model('manager');
                $data_m = $manager->where('id_manager', $data_sp['id_manager'])->first();
                $gm = model('general_manager');
                $data_gm = $gm->where('id_gm', $data_m['id_gm'])->first();
                $direktur = model('direktur');
                return $direktur->select('nama')->where('id_direktur', $data_gm['id_direktur'])->first();
                break;
            case '7':
                $staff = model('staff');
                $data_s = $staff->where('id_staff', $detail_jabatan)->first();
                $supervisor = model('supervisor');
                $data_sp = $supervisor->where('id_supervisor', $data_s['id_supervisor'])->first();
                $manager = model('manager');
                $data_m = $manager->where('id_manager', $data_sp['id_manager'])->first();
                $gm = model('general_manager');
                $data_gm = $gm->where('id_gm', $data_m['id_gm'])->first();
                $direktur = model('direktur');
                return $direktur->select('nama')->where('id_direktur', $data_gm['id_direktur'])->first();
                break;
            default:
                return null;
                break;
        }
    }
    public function getAtasanLangsung($kode_jabatan, $detail_jabatan){
        switch ($kode_jabatan) {
            case '4':
                $gm = model('general_manager');
                $data = $gm->where('id_gm', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, u.nama as nama_user, u.no_induk, d.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 3)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $data['id_direktur'])->join('riwayat_jabatan as rj', 'rj.id_jabatan=jabatan.id_jabatan')->where('rj.status_aktif', 1)->join('user as u', 'u.no_induk=rj.no_induk')->first();
                break;
            case '5':
                $manager = model('manager');
                $data = $manager->where('id_manager', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, u.nama as nama_user, u.no_induk, gm.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 4)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->where('gm.id_gm', $data['id_gm'])->join('riwayat_jabatan as rj', 'rj.id_jabatan=jabatan.id_jabatan')->where('rj.status_aktif', 1)->join('user as u', 'u.no_induk=rj.no_induk')->first();
                break;
            case '6':
                $supervisor = model('supervisor');
                $data = $supervisor->where('id_supervisor', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, u.nama as nama_user, u.no_induk, m.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 5)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $data['id_manager'])->join('riwayat_jabatan as rj', 'rj.id_jabatan=jabatan.id_jabatan')->where('rj.status_aktif', 1)->join('user as u', 'u.no_induk=rj.no_induk')->first();
                break;
            case '7':
                $staff = model('staff');
                $data = $staff->where('id_staff', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, u.nama as nama_user, u.no_induk, s.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 6)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->where('s.id_supervisor', $data['id_supervisor'])->join('riwayat_jabatan as rj', 'rj.id_jabatan=jabatan.id_jabatan')->where('rj.status_aktif', 1)->join('user as u', 'u.no_induk=rj.no_induk')->first();
                break;

            default:
                return null;
                break;
        }
    }
    public function getAtasanJabatan($kode_jabatan, $detail_jabatan){
        switch ($kode_jabatan) {
            case '4':
                $gm = model('general_manager');
                $data = $gm->where('id_gm', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, d.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 3)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $data['id_direktur'])->first();
                break;
            case '5':
                $manager = model('manager');
                $data = $manager->where('id_manager', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, gm.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 4)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->where('gm.id_gm', $data['id_gm'])->first();
                break;
            case '6':
                $supervisor = model('supervisor');
                $data = $supervisor->where('id_supervisor', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, m.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 5)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $data['id_manager'])->first();
                break;
            case '7':
                $staff = model('staff');
                $data = $staff->where('id_staff', $detail_jabatan)->first();
                return $this->select('su.nama_status_user, s.nama as nama_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 6)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->where('s.id_supervisor', $data['id_supervisor'])->first();
                break;

            default:
                return null;
                break;
        }
    }
    public function getListAtasan($kode_jabatan)
    {
        switch ($kode_jabatan) {
            case '4':
                return $this->select('d.nama as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 3)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '5':
                return $this->select('gm.nama as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_gm as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 4)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '6':
                return $this->select('m.nama as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 5)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '7':
                return $this->select('s.nama, su.nama_status_user,jabatan.id_jabatan,s.id_supervisor as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', 6)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->findAll();
                break;

            default:
                return null;
                break;
        }
    }
    public function getJabtan($kode_jabatan, $detail_jabatan)
    {
        switch ($kode_jabatan) {
            case '3':
                return $this->select('d.nama as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->where('d.id_direktur', $detail_jabatan)->first();
                break;
            case '4':
                return $this->select('gm.nama as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_gm as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->where('gm.id_gm', $detail_jabatan)->first();
                break;
            case '5':
                return $this->select('m.nama as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->where('m.id_manager', $detail_jabatan)->first();
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
                return $this->select('d.nama as nama, su.nama_status_user,jabatan.id_jabatan,d.id_direktur as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('direktur as d', 'd.id_direktur=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '4':
                return $this->select('gm.nama as nama, su.nama_status_user,jabatan.id_jabatan,gm.id_gm as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->findAll();
                break;
            case '5':
                return $this->select('m.nama as nama, su.nama_status_user,jabatan.id_jabatan,m.id_manager as id,jabatan.kode_jabatan')->join('status_user as su', 'su.id_status_user=jabatan.kode_jabatan', 'left')->where('su.id_status_user', $kode_jabatan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->findAll();
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