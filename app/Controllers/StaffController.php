<?php 
namespace App\Controllers;
use App\Models\menu;
use App\Models\kategori_menu;

class StaffController extends BaseController
{
    function getTanggal($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    
    public function index(){
        $data['title'] = "Dashboard Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $pengumuman = model('pengumuman');
        $presensi = model('presensi');
        $user = model('user');
        $tugas = model('tugas');
        $data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->findAll());
        $data['jumlah_belum_validasi'] = count($tugas->where('status_tugas', 0)->findAll());
        $data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->findAll());
        $data['user'] = $user->where('no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->findAll();
        
        return view('dashboard_pegawai', $data);
    }

    public function profil(){
        $data['title'] = "Profil Pegawai";
        if (! $this->validate([
            'nama' => 'required',
            'nip'  => 'required',
            'email'  => 'required',
            'no_telepon'  => 'required',
            'alamat'  => 'required',
        ])){
            $menu = model('menu');
            $kategori = model('kategori_menu');
            $user = model('user');
            $rancangan_tugas = model('rancangan_tugas');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
            $jumlah_tugas_berlangsung = 0;
            $jumlah_total_tugas = 0;
            for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
                $jumlah_total_tugas += intval($data['rancangan_tugas'][$i]['jumlah_tugas']);
            }
            $data['jumlah_total_tugas'] =  $jumlah_total_tugas;
            $data['jumlah_tugas_berlangsung'] = $jumlah_tugas_berlangsung;
            if($data['user']['id_jabatan'] == 7){
                $data['user']['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
            }
            // dd($data['user']);
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            return view('profil', $data);
        }
        else{
            $no_induk = $this->request->getPost('nip');
            $profil = [
                'nama' => $this->request->getPost('nama'),
                'email'  => $this->request->getPost('email'),
                'no_telepon'  => $this->request->getPost('no_telepon'),
                'alamat'  => $this->request->getPost('alamat'),
            ];
            $user = model('user');
            $user->update($no_induk, $profil);
            return redirect()->to(base_url().'/staff/profil');
        }
        
    }

    public function presensi(){
        $user = model('user');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        // dd($dta['presensi']);a
        if (! $this->validate([
            'status_kerja' => 'required',
            'lokasi' => 'required',
        ])){
            $data['title'] = "Presensi Pegawai";
            $menu = model('menu');
            $kategori = model('kategori_menu');
           if($data['user']['id_jabatan'] == 7){
                $data['user']['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
            }
            $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll();
            for ($i=0; $i < count($data['semua_presensi']); $i++) { 
                $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
            };
            // dd($data['semua_presensi']);
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            return view('presensi', $data);
        }else{
            // $presensi = model('presensi');
            // $data_presensi = $presensi->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => "2020-06-29"])->findAll();
            if($data['presensi'] == null){
                // Absen Masuk
                $data = [
                    'waktu_presensi_masuk' => date("h:i:sa"),
                    'tanggal_presensi' => date("Y-m-d"),
                    'lokasi' => $this->request->getPost('lokasi'), 
                    'status_tempat_kerja' => $this->request->getPost('status_kerja'), 
                    'id_riwayat_jabatan' => $this->request->getPost('user'),
                ];
            }else{
                // Absen Keluar
                $data = [
                    'id_presensi' => $data['presensi']['id_presensi'],
                    'waktu_presensi_keluar' => date("h:i:sa"),
                    'status_tempat_kerja' => $this->request->getPost('status_kerja'), 
                    'id_riwayat_jabatan' => $this->request->getPost('user'),
                ];
            }
            $presensi->save($data);

            // $user = model('user');
            // $no_induk = $this->request->getPost('no_induk');
            // $data = [
            //     'isPresensi' => 1,
            // ];
            // $user->update($no_induk, $data);
            return redirect()->to(base_url().'/staff/presensi');
        }
    }

    public function logbook(){
        $data['title'] = "Logbook Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll();
        for ($i=0; $i < count($data['semua_presensi']); $i++) { 
            $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
        };
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('logbook', $data);
    }

    public function capaianKerja(){
        $data['title'] = "Capaian Kerja Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('capaian_kerja', $data);
    }

    public function saran(){
        if (! $this->validate([
            'feedback' => 'required',
            'kategori_saran'  => 'required',
        ])){
            $data['title'] = "Saran";
            $menu = model('menu');
            $kategori = model('kategori_menu');
            $kategori_saran = model('kategori_feedback');
            $user = model('user');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $data['kategori_saran'] = $kategori_saran->findAll();
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            return view('saran', $data);
        }else{
            $saran = model('feedback');
            $data = [
                'feedback' => $this->request->getPost('feedback'),
                'no_induk' => $this->request->getPost('user'),
                'kategori_feedback' => $this->request->getPost('kategori_saran'),
            ];
            // dd($data);
            $saran->save($data);
            return redirect()->to(base_url().'/staff/saran');
        }
        
    }

    public function klarifikasi(){
        $data['title'] = "Klarifikasi Tugas";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('klarifikasi', $data);
    }

    public function indeksKepuasan(){
        $data['title'] = "Indeks Kepuasan Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('indeks_kepuasan', $data);
    }

    public function detailTugas($id_presensi){
        $data['title'] = "Detail Tugas Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['presensi'] = $presensi->where('id_presensi',$id_presensi)->first();
        $data['presensi']['tanggal_bahasa'] = $this->getTanggal($data['presensi']['tanggal_presensi']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('detail_tugas', $data);
    }
}