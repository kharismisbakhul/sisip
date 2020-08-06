<?php 
namespace App\Controllers;

use PDO;
use App\Models\nilai_pk;
use App\Models\menu;
use App\Models\kategori_menu;
use App\Models\indeksKepuasan;
use App\Models\indeksPertanyaan;
use App\Models\indeksNilai;

class ManagerController extends BaseController
{
    protected $indeksKepuasanModel;
    protected $indeksPertanyaanModel;
    protected $indeksNilaiModel;
    protected $nilaipkModel;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta'); 
        $this->indeksKepuasanModel = new indeksKepuasan();
        $this->indeksPertanyaanModel = new indeksPertanyaan();
        $this->indeksNilaiModel = new indeksNilai();
    }

    public function initData(){
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $pesan = model('pesan');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->where('riwayat_jabatan.status_aktif', 1)->first();
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc')->findAll();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return $data;
    }

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
        $data['title'] = "Dashboard Atasan";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $pengumuman = model('pengumuman');
        $presensi = model('presensi');
        $user = model('user');
        $tugas = model('tugas');
        $supervisor = model('supervisor');
        $jabatan = model('jabatan');
        $riwayat_jabatan = model('riwayat_jabatan');
        $data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['jumlah_belum_validasi'] = count($tugas->where('status_tugas', 0)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        
        $kode_bawahan = $supervisor->where('id_manager', $data['user']['detail_jabatan'])->findAll();
        $jumlah_bawahan = 0;
        for ($i=0; $i < count($kode_bawahan); $i++) { 
            $temp_jabatan = $jabatan->where('kode_jabatan', 5)->where('detail_jabatan', $kode_bawahan[$i]['id_supervisor'])->first();
            $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
            $jumlah_bawahan += $temp;
        }
        $data['staff_bawahan'] = $riwayat_jabatan->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('jabatan.id_jabatan', 6)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('id_supervisor', $data['user']['detail_jabatan'])->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->findAll();
        $jumlah_bawahan = count($data['staff_bawahan']);
        $data['jumlah_bawahan'] = $jumlah_bawahan;

        for ($i=0; $i < count($data['staff_bawahan']); $i++) { 
            $data['staff_bawahan'][$i]['presensi'] = $presensi->where(['id_riwayat_jabatan' => $data['staff_bawahan'][$i]['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        }

        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->where('pengumuman.status_pengumuman', 1)->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        
        return view('dashboard_atasan', $data);
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
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $tugas = model('tugas');
            $rancangan_tugas = model('rancangan_tugas');
            $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
            $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31'), 'tugas.id_rancangan_tugas !=' => 0])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
            $jumlah_tugas_berlangsung = 0;
            $jumlah_total_tugas = 0;
            for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
                $jumlah_total_tugas += intval($data['rancangan_tugas'][$i]['jumlah_total_tugas']);
                $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
                for ($j=0; $j < count($data['tugas']); $j++) { 
                    if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                        $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                    } 
                }
            }
            for ($i=0; $i < count($data['tugas']); $i++) { 
                $jumlah_tugas_berlangsung += intval($data['tugas'][$i]['jumlah_tugas']);
            }
            $data['jumlah_total_tugas'] =  $jumlah_total_tugas;
            $data['jumlah_tugas_berlangsung'] = $jumlah_tugas_berlangsung;
            if($data['user']['id_jabatan'] == 5){
                $data['user']['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $data['user']['jabatan'] = $jabatan->where('id_manager', $data['user']['detail_jabatan'])->first();
            }
            // dd($data['user']);
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            $pesan = model('pesan');
            $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

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
            return redirect()->to(base_url().'/supervisor/profil');
        }
        
    }
    public function presensi(){
        date_default_timezone_set('Asia/Jakarta'); 
        $user = model('user');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();

        if (! $this->validate([
            'status_kerja' => 'required',
            'lokasi' => 'required',
        ])){
            $data['title'] = "Presensi Pegawai";
            $menu = model('menu');
            $kategori = model('kategori_menu');
            if($data['user']['id_jabatan'] == 5){
                $data['user']['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $data['user']['jabatan'] = $jabatan->where('id_manager', $data['user']['detail_jabatan'])->first();
            }
            $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll();
            for ($i=0; $i < count($data['semua_presensi']); $i++) { 
                $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
            };
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            $pesan = model('pesan');
            $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

            return view('presensi', $data);
        }else{
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

            return redirect()->to(base_url().'/supervisor/presensi');
        }
    }

    public function logbook(){
        date_default_timezone_set('Asia/Jakarta'); 
        $data['title'] = "Logbook Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll();
        $data['presensi_hari_ini'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $data['tugas_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas !=', "0")->findAll();
        $data['tugas_tambahan_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas', 0)->findAll();
        for ($i=0; $i < count($data['semua_presensi']); $i++) { 
            $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
        };
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        // dd($data['tugas_hari_ini']);
        return view('logbook', $data);
    }

    public function capaianKerja(){
        date_default_timezone_set('Asia/Jakarta'); 
        $data['title'] = "Capaian Kerja Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $tugas = model('tugas');
        $pk = model('penilaian_kinerja');
        $riwayat_jabatan = model('riwayat_jabatan');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        // $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31')])->findAll();
        $tugas = model('tugas');
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31'), 'tugas.id_rancangan_tugas !=' => 0])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $jumlah_tugas_berlangsung = 0;
        $jumlah_total_tugas = 0;
        for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
            $jumlah_total_tugas += intval($data['rancangan_tugas'][$i]['jumlah_total_tugas']);
            $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
            for ($j=0; $j < count($data['tugas']); $j++) { 
                if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                    $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                } 
            }
        }
        for ($i=0; $i < count($data['tugas']); $i++) { 
            $jumlah_tugas_berlangsung += intval($data['tugas'][$i]['jumlah_tugas']);
        }
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();
        $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,s.nama as nama_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('jabatan.id_jabatan', 6)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('id_supervisor', $data['user']['detail_jabatan'])->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->findAll();
        
        $data['penilaian_kinerja'] = $pk->where('status_pk', 1)->first();
        // dd($data['tugas']);
        return view('capaian_kerja_atasan', $data);
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
            $saran = model('feedback');
            $user = model('user');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $data['feedback'] = $saran->where('no_induk', session('no_induk'))->findAll();
            $data['kategori_saran'] = $kategori_saran->findAll();
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            $pesan = model('pesan');
            $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

            return view('saran', $data);
        }else{
            $saran = model('feedback');
            $data = [
                'feedback' => $this->request->getPost('feedback'),
                'no_induk' => $this->request->getPost('user'),
                'kategori_feedback' => $this->request->getPost('kategori_saran'),
            ];
            $upload_image = $this->request->getFile('file_pendukung');
            if ($upload_image->getClientName() != "") {
                $tujuan_upload = 'assets/images/file_pendukung/';
                $upload_image->move($tujuan_upload, $upload_image->getClientName());
                $nama_file = $upload_image->getClientName();
    
                $data['file_pendukung'] = $nama_file;
            }
            $saran->save($data);
            return redirect()->to(base_url().'/staff/saran');
        }
    }

    public function klarifikasi(){
        $data['title'] = "Klarifikasi Tugas";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $tugas = model('tugas');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['tugas_revisi'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.status_tugas' => 2])->findAll();
        // dd($data['tugas_revisi']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

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
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();
        
        $cek = $this->indeksKepuasanModel->cekIndeksKepuasan(session('no_induk'));
        if ($cek) {
            $data['pesan'] = 'Terimakasih, Anda sudah melakukan pengisian indeks kepuasan pegawai';
            $data['pertanyaan'] = null;
        } else {
            $id = $this->indeksKepuasanModel->where('status', 1)->first();
            $data['pesan'] = 'Anda belum melakukan pengisian indeks kepuasan pegawai. Silahkan melakukan pengisian indeks kepuasan pegawai';
            $data['pertanyaan'] = $this->indeksPertanyaanModel->getPertanyaan($id['id']);
        }
        // dd($data);
        return view('indeks_kepuasan', $data);
    }

    public function validasi(){
        $data['title'] = "Validasi Logbook";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $supervisor = model('supervisor');
        $jabatan = model('jabatan');
        $tugas = model('tugas');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data_id_supervisor = $supervisor->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
        $id_supervisor = [];
        for ($i=0; $i < count($data_id_supervisor); $i++) { 
            array_push($id_supervisor, $data_id_supervisor[$i]['id_supervisor']);
        }
        $data_jabatan = $jabatan->where('kode_jabatan', 6)->whereIn('detail_jabatan', $id_supervisor)->findAll();
        $id_jabatan_bawahan = [];
        for ($i=0; $i < count($data_jabatan); $i++) { 
            array_push($id_jabatan_bawahan, $data_jabatan[$i]['id_jabatan']);
        }
        $user_bawahan = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereIn('riwayat_jabatan.id_jabatan', $id_jabatan_bawahan)->findAll();
        $id_riwayat_jabatan_bawahan = [];
        for ($i=0; $i < count($user_bawahan); $i++) { 
            array_push($id_riwayat_jabatan_bawahan, $user_bawahan[$i]['id_riwayat_jabatan']);
        }
        // $data['tugas_bawahan'] = $tugas->asArray()->join('riwayat_jabatan', 'riwayat_jabatan.id_riwayat_jabatan = tugas.id_riwayat_jabatan')->join('user', 'riwayat_jabatan.no_induk = user.no_induk')->whereIn('tugas.id_riwayat_jabatan', $id_riwayat_jabatan_bawahan)->where('status_tugas', 3)->findAll();
        $data['presensi_bawahan'] = $presensi->asArray()->join('riwayat_jabatan', 'riwayat_jabatan.id_riwayat_jabatan = presensi.id_riwayat_jabatan')->join('user', 'riwayat_jabatan.no_induk = user.no_induk')->whereIn('presensi.id_riwayat_jabatan', $id_riwayat_jabatan_bawahan)->findAll();
        
        for ($i=0; $i < count($data['presensi_bawahan']); $i++) { 
            $data['presensi_bawahan'][$i]['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['presensi_bawahan'][$i]['id_riwayat_jabatan'], 'tanggal_tugas' => $data['presensi_bawahan'][$i]['tanggal_presensi']])->whereIn('status_tugas', [2,3,4])->findAll();
            $data['presensi_bawahan'][$i]['jumlah_tugas_validasi'] = count($data['presensi_bawahan'][$i]['tugas']);
        }
        // dd($data['presensi_bawahan']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        return view('validasi', $data);
    }

    public function perizinan(){
        $data['title'] = "Perizinan Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $supervisor = model('supervisor');
        $jabatan = model('jabatan');
        $tugas = model('tugas');
        $presensi = model('presensi');
        $perizinan = model('perizinan');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data_id_supervisor = $supervisor->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
        $id_supervisor = [];
        for ($i=0; $i < count($data_id_supervisor); $i++) { 
            array_push($id_supervisor, $data_id_supervisor[$i]['id_supervisor']);
        }
        $data_jabatan = $jabatan->where('kode_jabatan', 6)->whereIn('detail_jabatan', $id_supervisor)->findAll();
        $id_jabatan_bawahan = [];
        for ($i=0; $i < count($data_jabatan); $i++) { 
            array_push($id_jabatan_bawahan, $data_jabatan[$i]['id_jabatan']);
        }
        $user_bawahan = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereIn('riwayat_jabatan.id_jabatan', $id_jabatan_bawahan)->findAll();
        
        $id_riwayat_jabatan_bawahan = [];
        $no_induk_bawahan = [];
        for ($i=0; $i < count($user_bawahan); $i++) { 
            array_push($id_riwayat_jabatan_bawahan, $user_bawahan[$i]['id_riwayat_jabatan']);
            array_push($no_induk_bawahan, $user_bawahan[$i]['no_induk']);
        }
        // $data['tugas_bawahan'] = $tugas->asArray()->join('riwayat_jabatan', 'riwayat_jabatan.id_riwayat_jabatan = tugas.id_riwayat_jabatan')->join('user', 'riwayat_jabatan.no_induk = user.no_induk')->whereIn('tugas.id_riwayat_jabatan', $id_riwayat_jabatan_bawahan)->where('status_tugas', 3)->findAll();
        $data['presensi_bawahan'] = $presensi->asArray()->join('riwayat_jabatan', 'riwayat_jabatan.id_riwayat_jabatan = presensi.id_riwayat_jabatan')->join('user', 'riwayat_jabatan.no_induk = user.no_induk')->whereIn('presensi.id_riwayat_jabatan', $id_riwayat_jabatan_bawahan)->findAll();
        $data['perizinan_bawahan'] = $perizinan->asArray()->join('user', 'perizinan.no_induk = user.no_induk')->whereIn('perizinan.no_induk', $no_induk_bawahan)->findAll();
        
        for ($i=0; $i < count($data['presensi_bawahan']); $i++) { 
            $data['presensi_bawahan'][$i]['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['presensi_bawahan'][$i]['id_riwayat_jabatan'], 'tanggal_tugas' => $data['presensi_bawahan'][$i]['tanggal_presensi']])->whereIn('status_tugas', [2,3,4])->findAll();
            $data['presensi_bawahan'][$i]['jumlah_tugas_validasi'] = count($data['presensi_bawahan'][$i]['tugas']);
        }
        // dd($data['presensi_bawahan']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        return view('validasi_izin', $data);
    }

    public function detailValidasi($id_presensi){
        date_default_timezone_set('Asia/Jakarta'); 
        $data['title'] = "Detail Validasi";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data['presensi'] = $presensi->where('id_presensi',$id_presensi)->first();
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['user_bawahan'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->where('riwayat_jabatan.id_riwayat_jabatan', $data['presensi']['id_riwayat_jabatan'])->first();
        $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['presensi']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => $data['presensi']['tanggal_presensi']])->orderBy('id_rancangan_tugas', 'DESC')->findAll();
        $data['presensi']['tanggal_bahasa'] = $this->getTanggal($data['presensi']['tanggal_presensi']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        // dd($data['tugas']);
        return view('detail_validasi', $data);
    }

    public function valid($id_tugas, $id_presensi){
        $tugas = model('tugas');
        $tugas->update($id_tugas, ['status_tugas' => 1]);
        return redirect()->to(base_url().'/supervisor/detailValidasi/'.$id_presensi);
    }
    public function terimaIzin($id_perizinan){
        $perizinan = model('perizinan');
        $perizinan->update($id_perizinan, ['status_izin' => 1]);
        return redirect()->to(base_url().'/supervisor/perizinan');
    }
    public function tolakIzin($id_perizinan){
        $perizinan = model('perizinan');
        $perizinan->update($id_perizinan, ['status_izin' => 2]);
        return redirect()->to(base_url().'/supervisor/perizinan');
    }
    public function tolak($id_tugas, $id_presensi){
        $tugas = model('tugas');
        $tugas->update($id_tugas, ['status_tugas' => 5]);
        return redirect()->to(base_url().'/supervisor/detailValidasi/'.$id_presensi);
    }
    public function revisiTugas(){
        $tugas = model('tugas');
        $id_tugas = $this->request->getVar('id_tugas');
        $id_presensi = $this->request->getVar('id_presensi');
        $catatan = $this->request->getVar('catatan');
        $tugas->update($id_tugas, ['status_tugas' => 2, 'catatan' => $catatan]);
        return redirect()->to(base_url().'/supervisor/detailValidasi/'.$id_presensi);
    }
    public function validasiSemua($id_presensi){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data['presensi'] = $presensi->where('id_presensi',$id_presensi)->first();
        $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['presensi']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => $data['presensi']['tanggal_presensi']])->orderBy('id_rancangan_tugas', 'DESC')->findAll();
        $array = [];
        for ($i=0; $i < count($data['tugas']); $i++) { 
            array_push($array, ['id_tugas' => $data['tugas'][$i]['id_tugas'], 'status_tugas' => 1]);
        }
        // dd($array);
        $tugas->updateBatch($array, 'id_tugas');
        return redirect()->to(base_url().'/supervisor/detailValidasi/'.$id_presensi);
    }

    public function daftarPenilaian($no_induk)
    {
        $data['title'] = "Capaian Kerja Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $pk = model('penilaian_kinerja');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();


        $data['staff'] = $user->select('user.*,s.nama as nama_jabatan')->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('user.no_induk', $no_induk)->first();

        $cek_pk = $pk->select('penilaian_kinerja.*,p.id_pertanyaan_pk,p.pertanyaan_pk,n.no_induk')->where('status_pk', 1)->join('pertanyaan_pk as p', 'penilaian_kinerja.id_pk=p.id_pk', 'left')->join('nilai_pk as n', 'n.id_pertanyaan_pk=p.id_pertanyaan_pk', 'left')->where('n.no_induk', $no_induk)->findAll();


        if ($cek_pk == null) {
            $data['info'] = 'Anda belum melakukan pemberian nilai kinerja ';
            $data['pertanyaan'] = $pk->select('penilaian_kinerja.*,p.id_pertanyaan_pk,p.pertanyaan_pk,n.no_induk')->where('status_pk', 1)->join('pertanyaan_pk as p', 'penilaian_kinerja.id_pk=p.id_pk', 'left')->join('nilai_pk as n', 'n.id_pertanyaan_pk=p.id_pertanyaan_pk', 'left')->findAll();
            $data['hasil'] = null;
        } else {
            $data['info'] = 'Anda sudah melakukan pemberian nilai kinerja ' . $cek_pk[0]['nama_pk'];
            $data['pertanyaan'] = null;
            $data['hasil'] = $pk->select('penilaian_kinerja.*,p.id_pertanyaan_pk,p.pertanyaan_pk,n.no_induk,n.nilai')->where('status_pk', 1)->join('pertanyaan_pk as p', 'penilaian_kinerja.id_pk=p.id_pk', 'left')->join('nilai_pk as n', 'n.id_pertanyaan_pk=p.id_pertanyaan_pk', 'left')->where('n.no_induk', $no_induk)->findAll();
        }
        return view('penilaian_kinerja_pegawai', $data);
    }

    public function savePertanyaanPenilaian($no_induk)
    {
        $pk = model('penilaian_kinerja');
        $nilai_pk = new nilai_pk();
        $pertanyaan = $pk->select('penilaian_kinerja.*,p.id_pertanyaan_pk,p.pertanyaan_pk,n.no_induk')->where('status_pk', 1)->join('pertanyaan_pk as p', 'penilaian_kinerja.id_pk=p.id_pk', 'left')->join('nilai_pk as n', 'n.id_pertanyaan_pk=p.id_pertanyaan_pk', 'left')->findAll();
        $data = [];
        $i = 0;
        foreach ($pertanyaan as $p) {
            $data[$i++] = [
                'id_pertanyaan_pk' => $p['id_pertanyaan_pk'],
                'nilai' => $this->request->getVar('nilai' . $p['id_pertanyaan_pk']),
                'no_induk' => $no_induk,
                'id_pemberi_nilai' => session('no_induk'),
            ];
        }

        $nilai_pk->insertBatch($data);
        session()->setFlashdata('pesan', 'Data penilaian kinerja berhasil ditambah');
        return redirect()->to('/supervisor/daftarPenilaian/' . $no_induk);
    }
    
    public function laporanEvaluasi(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data = $this->initData();
        $data['title'] = "Laporan Evaluasi dan Monitoring";
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan']])->groupBy('tugas.kode_tugas')->orderBy('tugas.id_rancangan_tugas', 'desc')->orderBy('tanggal_tugas', 'asc')->findAll();
        $bulan = model('bulan');
        $data['bulan'] = $bulan->findAll();
        if($data['user']['id_jabatan'] == 5){
            $data['user']['nama_jabatan'] = "Manager";
            $jabatan = model('manager');
            $data['user']['jabatan'] = $jabatan->where('id_manager', $data['user']['detail_jabatan'])->first();
        }
        // dd($data);
        return view('laporan/laporan_evaluasi', $data);
    }
    public function laporanKeaktifan(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $bulan = model('bulan');
        $batas_penanggalan = model('batas_penanggalan');
        $data = $this->initData();
        $thn = date('Y');
        $bln = date('m');
        if($this->request->getVar('tahun') != "" && $this->request->getVar('bulan') != ""){
            $thn = $this->request->getVar('tahun');
            $bln = $this->request->getVar('bulan');
            if(intval($bln) < 10){
                $bln = '0'.$bln;
            }
        }
        $data['title'] = "Laporan Keaktifan Pegawai";
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tanggal_presensi >=' => $thn.'-'.$bln.'-01', 'tanggal_presensi <=' => $thn.'-'.$bln.'-31'])->findAll();
        $data['bulan'] = $bulan->findAll();
        $data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        $data['tahun'] = $thn;
        $temp_bulan = $bulan->where('id_bulan', intval($bln))->first();
        $data['bln'] = $temp_bulan['nama_bulan'];
        // dd($data);
        return view('laporan/laporan_keaktifan', $data);
    }
}