<?php 
namespace App\Controllers;
use CodeIgniter\HTTP\Request;

class AuthController extends BaseController
{    
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta'); 
    }

    public function login(){
        if (session()->has('no_induk')) {
            if (session('id_status_user') == 1) {
                return redirect()->to(base_url().'/admin');
            } else if (session('id_status_user') == 2) {
                return redirect()->to(base_url().'/operator');
            } else if (session('id_status_user') == 3) {
                return redirect()->to(base_url().'/direktur');
            } else if (session('id_status_user') == 4) {
                return redirect()->to(base_url().'/gm');
            } else if (session('id_status_user') == 5) {
                return redirect()->to(base_url().'/manager');
            } else if (session('id_status_user') == 6) {
                return redirect()->to(base_url().'/supervisor');
            } else {
                return redirect()->to(base_url().'/staff');
            }
        }

        if (! $this->validate([
            'username' => 'required',
            'password'  => 'required'
        ])){
            return view('login');
        }
        else{
            $login = [
                'no_induk' => $this->request->getPost('username') ,
                'password' => $this->request->getPost('password')
            ];
            $user = model('user');
            $data = $user->asArray()->where($login)->first();
            if($data == null){
                session()->setFlashdata('eror', 'Login gagal, Username / Password tidak sesuai');
                return redirect()->to(base_url());
            }
            session()->set($data);
            // dd(session('no_induk'));
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url())->with('statusLogout', 'Logout Sukses');
    }

    public function daftarHadir()
    {
        date_default_timezone_set('Asia/Jakarta'); 
        $data['title'] = 'Daftar Hadir Pegawai';
        $user = model('user');
        $presensi = model('presensi');
        $data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        // $data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->paginate(3, 'daftar_hadir');
        // $data['pager'] = $user->pager;
        for ($i=0; $i < count($data['pegawai']); $i++) { 
            $data['pegawai'][$i]['presensi'] = $presensi->where(['id_riwayat_jabatan' => $data['pegawai'][$i]['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
            if($data['pegawai'][$i]['id_status_user'] == 3){
                $data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_status_user'] == 4){
                $data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_status_user'] == 5){
                $data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_status_user'] == 6){
                $data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_status_user'] == 7){
                $data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $data['pegawai'][$i]['jabatan']['nama'] = "";
            }
        }
        // dd($data);
        return view('daftar_hadir', $data);
    }
    
    public function geolokasi(){
        $myfile = fopen(base_url('/assets/images/bukti_klarifikasi/ERD.png'), "r") or die("Unable to open file!");
        echo fgets($myfile);
        fclose($myfile);
        // echo readfile(base_url('/assets/images/bukti_klarifikasi/ERD.png'));
        // return view('geolokasi');
    }

    public function tambahChat(){
        $pesanModel = model('pesan');
        $no_induk = $this->request->getVar('username');
        $pesan = $this->request->getVar('pesan');
        $pesan_fix = str_replace("+"," ",$pesan);
        if($pesan != null){
            $data = [
                'pesan' => $pesan_fix,
                'waktu' => date("H:i:s"),
                'tanggal' => date("Y-m-d"),
                'user' => $no_induk,
            ];
            $pesanModel->save($data);
            $chat  = $pesanModel->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc')->findAll();
            echo json_encode($chat);
        }
    }

}