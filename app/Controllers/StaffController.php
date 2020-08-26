<?php 
namespace App\Controllers;
use App\Models\menu;
use App\Models\kategori_menu;
use App\Models\indeksKepuasan;
use App\Models\indeksPertanyaan;
use App\Models\indeksNilai;


class StaffController extends BaseController
{
    protected $indeksKepuasanModel;
    protected $indeksPertanyaanModel;
    protected $indeksNilaiModel;
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

    public function templateIzin(){
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
        $data = $this->initData();
        $jabatan = model('jabatan');
        $data['jabatan'] = $jabatan->getJabtan(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['atasan'] = $jabatan->getAtasanLangsung(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
        $perizinan_temp = model('perizinan_temp');
        $data['izin'] = $perizinan_temp->orderBy('waktu_izin', 'desc')->first();
        $num1 = date('N', strtotime($data['izin']['tanggal_mulai']));
        $num2 = date('N', strtotime($data['izin']['tanggal_selesai']));
        $data['hari_mulai'] = $hari[$num1];
        $data['hari_selesai'] = $hari[$num2];
        if($data['izin']['kategori_izin'] == 1){
            $data['izin']['kategori'] = "Izin";
        }else if($data['izin']['kategori_izin'] == 2){
            $data['izin']['kategori'] = "Sakit";
        }else{
            $data['izin']['kategori'] = "Cuti";
        }
        // $data['title'] = "Perizinan";
        // dd($data);
        return view('template_izin', $data);   
    }

    public function template_perizinan(){
        $perizinan_temp = model('perizinan_temp');
        $data = [
            'waktu_izin' => date("H:i:s"),
            'tanggal_izin' => date('Y-m-d'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'alasan' => $this->request->getVar('keterangan'),
            'kategori_izin' => $this->request->getVar('kategori_izin'),
            'no_induk' => session('no_induk'),
        ];

        $perizinan_temp->save($data);
        return redirect()->to(base_url().'/templateIzin');

    }
    
    public function index(){
        // date_default_timezone_set('Asia/Jakarta'); 
        $pengumuman = model('pengumuman');
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data = $this->initData();
        $data['title'] = "Dashboard Pegawai";
        $data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['jumlah_belum_validasi'] = count($tugas->where('status_tugas', 3)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->findAll());
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->where('pengumuman.status_pengumuman', 1)->findAll(); 
        // dd($data);
        return view('dashboard_pegawai', $data);
    }

    public function kinerjaApi(){
        $tugas = model('tugas');
        $data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->findAll());
        $data['jumlah_belum_validasi'] = count($tugas->where('status_tugas !=', 1)->findAll());
        $data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->findAll());
        echo json_encode($data);
    }

    public function tambahChat(){
        $pesan = model('pesan');
        $data = [
            'pesan' => $this->request->getVar('pesan'),
            'waktu' => date("H:i:s"),
            'tanggal' => date("Y-m-d"),
            'user' => session('no_induk'),
        ];
        $pesan->save($data);
        return redirect()->to(base_url(''));
    }

    public function ajukanIzin(){
        $perizinan = model('perizinan');
        $data = [
            'tanggal_izin' => date('Y-m-d'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'alasan' => $this->request->getVar('keterangan'),
            'kategori_izin' => $this->request->getVar('kategori_izin'),
            'no_induk' => session('no_induk'),
        ];
        $upload_image = $this->request->getFile('bukti');
        if ($upload_image->getClientName() != "") {
            $tujuan_upload = 'public/assets/images/izin/';
            $upload_image->move($tujuan_upload, $upload_image->getClientName());
            $nama_file = $upload_image->getClientName();
            $data['bukti'] = $nama_file;
        }

        $perizinan->save($data);
        return redirect()->to(base_url().'/staff/perizinan');

    }
    public function perizinan(){
        $data = $this->initData();
        $data['title'] = "Perizinan";
        $perizinan = model('perizinan');
        $data['perizinan'] = $perizinan->where('no_induk', session('no_induk'))->orderBy('tanggal_izin', 'desc')->findAll();
        return view('perizinan', $data);        
    }
    public function profil(){
        $data = $this->initData();
        $data['title'] = "Profil Pegawai";
        if (! $this->validate([
            'nama' => 'required',
            'nip'  => 'required',
            'email'  => 'required',
            'no_telepon'  => 'required',
            'alamat'  => 'required',
        ])){
            $tugas = model('tugas');
            $rancangan_tugas = model('rancangan_tugas');
            $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
            $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31'), 'tugas.id_rancangan_tugas !=' => 0, 'tugas.status_tugas' => 1] )->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
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
            if($data['user']['id_jabatan'] == 7){
                $data['user']['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
            }
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
            if(session('id_status_user') == 6){
                return redirect()->to(base_url().'/supervisor/profil');
            }else if(session('id_status_user') == 5){
                return redirect()->to(base_url().'/manager/profil');
            }else if(session('id_status_user') == 4){
                return redirect()->to(base_url().'/gm/profil');
            }else if(session('id_status_user') == 3){
                return redirect()->to(base_url().'/direksi/profil');
            }else{
                return redirect()->to(base_url().'/staff/profil');
            }
        }
    }

    public function ubahPassword(){
        $password_lama = $this->request->getVar('pass1');
        $password_baru = $this->request->getVar('pass2');
        $password_baru2 = $this->request->getVar('pass3');
        $login = [
            'no_induk' => session('no_induk'),
            'password' => $password_lama
        ];
        $user = model('user');
        $data = $user->asArray()->where($login)->first();
        if($data){
            if($password_baru == $password_baru2){
                $user->update(session('no_induk'), ['password' => $password_baru]);
                if(session('id_status_user') == 6){
                    return redirect()->to(base_url().'/supervisor/profil');
                }else if(session('id_status_user') == 5){
                    return redirect()->to(base_url().'/manager/profil');
                }else if(session('id_status_user') == 4){
                    return redirect()->to(base_url().'/gm/profil');
                }else if(session('id_status_user') == 3){
                    return redirect()->to(base_url().'/direksi/profil');
                }else{
                    return redirect()->to(base_url().'/staff/profil');
                }
            }else{

            }
        }else{

        }
    }
    public function ubahFoto(){
        $user = model('user');
        $data['user'] = $user->where('user.no_induk', session('no_induk'))->first();
        $upload_image = $this->request->getFile('foto');
        // dd($upload_image);
        // $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $tujuan_upload = 'public/assets/images/users/';
            $upload_image->move($tujuan_upload, $upload_image->getClientName());
            $nama_file = '/assets/images/users/'.$upload_image->getClientName();

            $old_images = $data['user']['foto_profil'];
            if ($old_images != 'assets/images/users/default.jpg') {
                unlink(FCPATH . 'public/'.$old_images);
            }
            $user->update(session('no_induk'), ['foto_profil' => $nama_file]);
            if(session('id_status_user') == 6){
                return redirect()->to(base_url().'/supervisor/profil');
            }else if(session('id_status_user') == 5){
                return redirect()->to(base_url().'/manager/profil');
            }else if(session('id_status_user') == 4){
                return redirect()->to(base_url().'/gm/profil');
            }else if(session('id_status_user') == 3){
                return redirect()->to(base_url().'/direksi/profil');
            }else{
                return redirect()->to(base_url().'/staff/profil');
            }
        }
    }

    public function presensi(){
        $data = $this->initData(); 
        $presensi = model('presensi');
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();

        if (! $this->validate([
            'status_kerja' => 'required',
            'lokasi' => 'required',
        ])){
            $data['title'] = "Presensi Pegawai";
           if($data['user']['id_jabatan'] == 7){
                $data['user']['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
            }
            $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->where('status_presensi', 0)->orderBy('tanggal_presensi', 'DESC')->findAll();
            // dd($data['semua_presensi']);
            for ($i=0; $i < count($data['semua_presensi']); $i++) { 
                $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
            };
            return view('presensi', $data);
        }else{
            if($data['presensi'] == null){
                // Absen Masuk
                $data = [
                    'waktu_presensi_masuk' => date("H:i:s"),
                    'tanggal_presensi' => date("Y-m-d"),
                    'lokasi' => $this->request->getPost('lokasi'), 
                    'status_tempat_kerja' => $this->request->getPost('status_kerja'), 
                    'id_riwayat_jabatan' => $this->request->getPost('user'),
                ];
                if($this->request->getPost('tanggal_presensi')){
                    $data['tanggal_presensi'] = $this->request->getPost('tanggal_presensi');
                }
            }else{
                // Absen Keluar
                $data = [
                    'id_presensi' => $data['presensi']['id_presensi'],
                    'waktu_presensi_keluar' => date("H:i:s"),
                    'lokasi_keluar' => $this->request->getPost('lokasi'), 
                    'status_tempat_kerja' => $this->request->getPost('status_kerja'), 
                    'id_riwayat_jabatan' => $this->request->getPost('user'),
                ];
                if($this->request->getPost('tanggal_presensi')){
                    $data['tanggal_presensi'] = $this->request->getPost('tanggal_presensi');
                }
            }
            $presensi->save($data);
            if(session('id_status_user') == 6){
                return redirect()->to(base_url().'/supervisor/presensi');
            }else if(session('id_status_user') == 5){
                return redirect()->to(base_url().'/manager/presensi');
            }else if(session('id_status_user') == 4){
                return redirect()->to(base_url().'/gm/presensi');
            }else if(session('id_status_user') == 3){
                return redirect()->to(base_url().'/direksi/presensi');
            }else{
                return redirect()->to(base_url().'/staff/presensi');
            }
        }
    }

    public function logbook(){
        $data = $this->initData();
        $data['title'] = "Logbook Pegawai";
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data['semua_presensi'] = $presensi->asArray()->where('id_riwayat_jabatan', $data['user']['id_riwayat_jabatan'])->orderBy('tanggal_presensi', 'DESC')->where('status_presensi', 0)->findAll();
        $data['presensi_hari_ini'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $data['tugas_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas !=', "0")->findAll();
        $data['tugas_tambahan_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas', 0)->findAll();
        for ($i=0; $i < count($data['semua_presensi']); $i++) { 
            $data['semua_presensi'][$i]['tanggal_bahasa'] = $this->getTanggal($data['semua_presensi'][$i]['tanggal_presensi']);
        };
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        
        return view('logbook', $data);
    }

    public function logbookApi($no_induk){
        $data = [];
        $tugas = model('tugas');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', $no_induk)->first();
        $data['tugas_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas !=', "0")->orderBy('id_rancangan_tugas', 'asc')->findAll();
        $data['tugas_tambahan_hari_ini'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d")])->where('tugas.id_rancangan_tugas', 0)->findAll();
        Header('Content-type: application/json');
        echo json_encode($data);
    }

    public function inputLogbookApi(){
        date_default_timezone_set('Asia/Jakarta'); 
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', $this->request->getPost('no_induk'))->first();
        if (! $this->validate([
            'id_rancangan_tugas' => 'required',
            'jumlah' => 'required',
        ])){

        }
        else{
            $tugas = model('tugas');
            // Tugas Utama
            if($this->request->getPost('id_rancangan_tugas') != 0){
                $rancangan_tugas = model('rancangan_tugas');
                $data_rt = $rancangan_tugas->asArray()->where('id_rancangan_tugas', $this->request->getPost('id_rancangan_tugas'))->first();
                $data_tugas = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d"), 'tugas.id_rancangan_tugas' => $this->request->getPost('id_rancangan_tugas')])->first();
                $data = [
                    'id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'],
                    'nama_tugas' => $data_rt['nama_tugas'], 
                    'tanggal_tugas' => date("Y-m-d"),
                    'periode' => $data_rt['periode'],
                    'jumlah_tugas' => $this->request->getPost('jumlah'),
                    'nomor_pekerjaan' => $data_rt['nomor_pekerjaan'],
                    'status_tugas' => 3,
                    'id_rancangan_tugas' => $data_rt['id_rancangan_tugas'],
                    'kode_tugas' => $data_rt['kode_tugas'],
                    'waktu' => date("H:i:s"),
                ];
                if($data_tugas != null){
                    $data['id_tugas'] = $data_tugas['id_tugas'];
                }
            }
            // Tugas Tambahan
            else{
                $data = [
                    'id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'],
                    'nama_tugas' => $this->request->getPost('nama_tugas_tambahan'), 
                    'tanggal_tugas' => date("Y-m-d"),
                    'periode' => $this->request->getPost('periode'),
                    'jumlah_tugas' => $this->request->getPost('jumlah'),
                    'nomor_pekerjaan' => 00,
                    'status_tugas' => 3,
                    'id_rancangan_tugas' => $this->request->getPost('id_rancangan_tugas'),
                    'kode_tugas' => bin2hex(random_bytes(3)),
                    'waktu' => date("H:i:s")
                ];
            }
            
            /* Status Tugas
                1 = Valid
                2 = Revisi
                3 = Baru Masuk
                4 = Klarifikasi
            */
           
            $tugas->save($data);
            echo json_encode("SUKSES");
        }
    }

    public function inputLogbook(){
        date_default_timezone_set('Asia/Jakarta'); 
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        if (! $this->validate([
            'id_rancangan_tugas' => 'required',
            'jumlah' => 'required',
        ])){
            return redirect()->to(base_url().'/staff/logbook');
        }
        else{
            $tugas = model('tugas');
            // Tugas Utama
            if($this->request->getPost('id_rancangan_tugas') != 0){
                $rancangan_tugas = model('rancangan_tugas');
                $data_rt = $rancangan_tugas->asArray()->where('id_rancangan_tugas', $this->request->getPost('id_rancangan_tugas'))->first();
                $data_tugas = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => date("Y-m-d"), 'tugas.id_rancangan_tugas' => $this->request->getPost('id_rancangan_tugas')])->first();
                $data = [
                    'id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'],
                    'nama_tugas' => $data_rt['nama_tugas'], 
                    'tanggal_tugas' => date("Y-m-d"),
                    'periode' => $data_rt['periode'],
                    'jumlah_tugas' => $this->request->getPost('jumlah'),
                    'nomor_pekerjaan' => $data_rt['nomor_pekerjaan'],
                    'status_tugas' => 3,
                    'id_rancangan_tugas' => $data_rt['id_rancangan_tugas'],
                    'kode_tugas' => $data_rt['kode_tugas'],
                ];
                if($data_tugas != null){
                    $data['id_tugas'] = $data_tugas['id_tugas'];
                }
            }
            // Tugas Tambahan
            else{
                $data = [
                    'id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'],
                    'nama_tugas' => $this->request->getPost('nama_tugas_tambahan'), 
                    'tanggal_tugas' => date("Y-m-d"),
                    'periode' => $this->request->getPost('periode'),
                    'jumlah_tugas' => $this->request->getPost('jumlah'),
                    'nomor_pekerjaan' => 00,
                    'status_tugas' => 3,
                    'kode_tugas' => "123dsa",
                    'id_rancangan_tugas' => $this->request->getPost('id_rancangan_tugas'),
                    'kode_tugas' => bin2hex(random_bytes(3))
                ];
                // dd($data);
            }
            
            /* Status Tugas
                1 = Valid
                2 = Revisi
                3 = Baru Masuk
                4 = Klarifikasi
            */
           
            $tugas->save($data);
            return redirect()->to(base_url().'/staff/logbook');
        }
    }

    public function selesaiInput($id_presensi){
        $presensi = model('presensi');
        $presensi->update($id_presensi, ['isi_logbook' => 1]);
        return redirect()->to(base_url().'/staff/logbook');
    }
    public function hapusTugasApi($id_tugas){
        $tugas = model('tugas');
        $tugas->delete(['id_tugas' => $id_tugas]);
        echo json_encode("SUKSES");
    }
    public function hapusTugas($id_tugas){
        $tugas = model('tugas');
        $tugas->delete(['id_tugas' => $id_tugas]);
        return redirect()->to(base_url().'/staff/logbook');
    }

    public function capaianKerja(){
        $data = $this->initData();
        $data['title'] = "Capaian Kerja Pegawai";
        $tugas = model('tugas');
        
        $thn = date('Y');
        // $bln = "01";
        // $tanggal_mulai = date('Y').'-01-01';
        // $tanggal_selesai = date('Y').'-12-31';
        if($this->request->getVar('tahun') != ""){
            $thn = $this->request->getVar('tahun');
            // $tanggal_mulai = $thn.'-'.$bln.'-01';
            // $tanggal_selesai = $thn.'-12-31';
        }
        // if($this->request->getVar('bulan') != ""){
        //     $bln = intval($this->request->getVar('bulan')) < 10 ? '0'.$this->request->getVar('bulan') : $this->request->getVar('bulan');
        //     $tanggal_mulai = $thn.'-'.$bln.'-01';
        //     $tanggal_selesai = $thn.'-'.$bln.'-31';
        // }
        // if($this->request->getVar('minggu-ke') != ""){
        //     $minggu = $this->request->getVar('minggu-ke');
        //     if($minggu == 1){
        //         $tanggal_mulai = $thn.'-'.$bln.'-'.'01';
        //         $tanggal_selesai = $thn.'-'.$bln.'-'.'07';
        //     }else if($minggu == 2){
        //         $tanggal_mulai = $thn.'-'.$bln.'-'.'08';
        //         $tanggal_selesai = $thn.'-'.$bln.'-'.'14';
        //     }else if($minggu == 3){
        //         $tanggal_mulai = $thn.'-'.$bln.'-'.'15';
        //         $tanggal_selesai = $thn.'-'.$bln.'-'.'21';
        //     }else if($minggu == 4){
        //         $tanggal_mulai = $thn.'-'.$bln.'-'.'22';
        //         $tanggal_selesai = $thn.'-'.$bln.'-'.'28';
        //     }
        // }
        $data['tahun'] = $thn;
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date($thn.'-01-01'), 'tugas.tanggal_tugas <=' => date($thn.'-12-31'), 'tugas.status_tugas' => 1])->groupBy("tugas.id_rancangan_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $data['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date($thn.'-01-01'), 'tugas.tanggal_tugas <=' => date($thn.'-12-31'), 'tugas.id_rancangan_tugas' => 0, 'tugas.status_tugas' => 1])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();

        for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
            $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
            for ($j=0; $j < count($data['tugas']); $j++) { 
                if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                    $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                } 
            }
        }
        $jumlah_tugas_tambahan = 0;
        for ($i=0; $i < count($data['tugas_tambahan']); $i++) { 
            $data['tugas_tambahan'][$i]['tanggal_tugas'] = $this->getTanggal($data['tugas_tambahan'][$i]['tanggal_tugas']);
            $jumlah_tugas_tambahan += intval($data['tugas_tambahan'][$i]['jumlah_tugas']);
        }
        $data['jumlah_tugas_tambahan'] = $jumlah_tugas_tambahan;
        $bulan = model('bulan');
        $data['bulan'] = $bulan->findAll();
        return view('capaian_kerja', $data);
    }

    public function exportCapaianKerja(){
        $data = $this->initData();
        $data['title'] = "Capaian Kerja Pegawai";
        $tugas = model('tugas');
        $tahun = $this->request->getVar('tahun');
        $data['tahun'] = $tahun;
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date($tahun.'-01-01'), 'tugas.tanggal_tugas <=' => date($tahun.'-12-31'), 'tugas.id_rancangan_tugas !=' => 0])->groupBy("tugas.id_rancangan_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $data['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date($tahun.'-01-01'), 'tugas.tanggal_tugas <=' => date($tahun.'-12-31'), 'tugas.id_rancangan_tugas' => 0])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();
        
        for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
            $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
            for ($j=0; $j < count($data['tugas']); $j++) { 
                if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                    $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                } 
            }
        }
        $jumlah_tugas_tambahan = 0;
        for ($i=0; $i < count($data['tugas_tambahan']); $i++) { 
            $data['tugas_tambahan'][$i]['tanggal_tugas'] = $this->getTanggal($data['tugas_tambahan'][$i]['tanggal_tugas']);
            $jumlah_tugas_tambahan += intval($data['tugas_tambahan'][$i]['jumlah_tugas']);
        }
        $data['jumlah_tugas_tambahan'] = $jumlah_tugas_tambahan;

        // $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date($tahun.'-01-01'), 'tugas.tanggal_tugas <=' => date($tahun.'-12-31')])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();

        $jabatan = model('jabatan');
        $data['jabatan'] = $jabatan->getJabtan(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['atasan'] = $jabatan->getAtasanLangsung(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
       
        return view('export_capaian_kerja', $data);
    }

    public function saran(){
        $data = $this->initData();
        if (! $this->validate([
            'feedback' => 'required',
            'kategori_saran'  => 'required',
        ])){
            $data['title'] = "Saran";
            $kategori_saran = model('kategori_feedback');
            $feedback = model('feedback');
            $data['kategori_saran'] = $kategori_saran->findAll();
            $data['feedback'] = $feedback->join('kategori_feedback', 'kategori_feedback.id_kategori = feedback.kategori_feedback')->where('no_induk', session('no_induk'))->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc')->findAll();
            for ($i=0; $i < count($data['feedback']); $i++) { 
                $data['feedback'][$i]['tanggal_bahasa'] = $this->getTanggal($data['feedback'][$i]['tanggal']);
            };

            return view('saran', $data);
        }else{
            $saran = model('feedback');
            $data = [
                'feedback' => $this->request->getPost('feedback'),
                'no_induk' => $this->request->getPost('user'),
                'kategori_feedback' => $this->request->getPost('kategori_saran'),
                'waktu' => date("H:i:s"),
                'tanggal' => date("Y-m-d")
            ];
            $upload_image = $this->request->getFile('file_pendukung');
            if ($upload_image->getClientName() != "") {
                $tujuan_upload = 'public/assets/images/file_pendukung/';
                $upload_image->move($tujuan_upload, $upload_image->getClientName());
                $nama_file = $upload_image->getClientName();
    
                $data['file_pendukung'] = $nama_file;
            }
            $saran->save($data);
            if(session('id_status_user') == 6){
                return redirect()->to(base_url().'/supervisor/saran');
            }else if(session('id_status_user') == 5){
                return redirect()->to(base_url().'/manager/saran');
            }else if(session('id_status_user') == 4){
                return redirect()->to(base_url().'/gm/saran');
            }else if(session('id_status_user') == 3){
                return redirect()->to(base_url().'/direksi/saran');
            }else{
                return redirect()->to(base_url().'/staff/saran');
            }
        }
        
    }

    

    public function klarifikasi(){
        $data = $this->initData();
        $data['title'] = "Klarifikasi Tugas";
        $tugas = model('tugas');
        $data['tugas_revisi'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.status_tugas' => 2])->findAll();
        
        return view('klarifikasi', $data);
    }

    public function klarifikasiTugas(){
        $tugas = model('tugas');
        $id_tugas = $this->request->getVar('id_tugas');
        $data = [
            'status_tugas' => 4, 
            'catatan' => $this->request->getVar('alasan-klarifikasi')
        ];
        $upload_image = $this->request->getFile('bukti-klarifikasi');
        if ($upload_image->getClientName() != "") {
            $tujuan_upload = 'public/assets/images/bukti_klarifikasi/';
            $upload_image->move($tujuan_upload, $upload_image->getClientName());
            $nama_file = $upload_image->getClientName();
            $data['bukti'] = $nama_file;
        }

        $tugas->update($id_tugas, $data);
        if(session('id_status_user') == 6){
            return redirect()->to(base_url().'/supervisor/klarifikasi');
        }else if(session('id_status_user') == 5){
            return redirect()->to(base_url().'/manager/klarifikasi');
        }else if(session('id_status_user') == 4){
            return redirect()->to(base_url().'/gm/klarifikasi');
        }else if(session('id_status_user') == 3){
            return redirect()->to(base_url().'/direksi/klarifikasi');
        }else{
            return redirect()->to(base_url().'/staff/klarifikasi');
        }
    }

    public function indeksKepuasan(){
        $data = $this->initData();
        $data['title'] = "Indeks Kepuasan Pegawai";
        
        $cek = $this->indeksKepuasanModel->cekIndeksKepuasan(session('no_induk'));
        if ($cek) {
            $data['pesan'] = 'Terimakasih, Anda sudah melakukan pengisian indeks kepuasan pegawai';
            $data['pertanyaan'] = null;
        } else {
            $id = $this->indeksKepuasanModel->where('status', 1)->first();
            $data['pesan'] = 'Anda belum melakukan pengisian indeks kepuasan pegawai. Silahkan melakukan pengisian indeks kepuasan pegawai';
            $data['pertanyaan'] = $this->indeksPertanyaanModel->getPertanyaan($id['id']);
        }
        return view('indeks_kepuasan', $data);
    }

    public function saveIndeksKepuasan()
    {
        $pertanyaan = $this->indeksPertanyaanModel->getPertanyaan($this->request->getVar('id_indeks'));
        $dataPertanyaan  = [];
        for ($i = 0; $i < count($pertanyaan); $i++) {
            if ($this->request->getVar('q' . $pertanyaan[$i]['id_pertanyaan']) == 0) {
                session()->setFlashdata('pesan', '<span class="text-danger">Semua pertanyaan harus diisi !</span>');
                return redirect()->to('/staff/indeksKepuasan');
            }
            $dataPertanyaan[$i] = [
                'id_pertanyaan' => $pertanyaan[$i]['id_pertanyaan'],
                'nilai' => $this->request->getVar('q' . $pertanyaan[$i]['id_pertanyaan']),
                'no_induk' => $this->request->getVar('no_induk'),
            ];
        }
        $this->indeksNilaiModel->insertBatch($dataPertanyaan);
        session()->setFlashdata('pesan', 'Data indeks kepuasan pegawai berhasil ditambah');
        return redirect()->to(base_url().'/staff/indeksKepuasan');
    }

    public function detailTugas($id_presensi){
        $data = $this->initData();
        $data['title'] = "Detail Tugas Pegawai";
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data['presensi'] = $presensi->where('id_presensi',$id_presensi)->first();
        $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas' => $data['presensi']['tanggal_presensi']])->orderBy('id_rancangan_tugas', 'DESC')->findAll();
        $data['presensi']['tanggal_bahasa'] = $this->getTanggal($data['presensi']['tanggal_presensi']);
       
        return view('detail_tugas', $data);
    }

    public function laporanKinerja(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data = $this->initData();
        $data['title'] = "Laporan Kinerja";
        $bulan = model('bulan');
        $user = model('user');
        $nilai_pk = model('nilai_pk');
        $penilaian_kinerja = model('penilaian_kinerja');
        $pertanyaan_pk = model('pertanyaan_pk');
        $data['bulan'] = $bulan->findAll();
        $data['nilai_pk'] = $nilai_pk->where('no_induk', session('no_induk'))->join('pertanyaan_pk', 'pertanyaan_pk.id_pertanyaan_pk = nilai_pk.id_pertanyaan_pk')->join('penilaian_kinerja', 'penilaian_kinerja.id_pk = pertanyaan_pk.id_pk')->findAll();
        $data['penilaian_kinerja'] = $penilaian_kinerja->findAll();
        $data['pertanyaan_pk'] = $pertanyaan_pk->findAll();
        dd($data['nilai_pk']);
        for ($i=0; $i < $data['penilaian_kinerja']; $i++) { 
            $data['penilaian_kinerja'][$i]['pertanyaan_pk'] = $pertanyaan_pk->where('id_pk', $data['penilaian_kinerja'][$i]['id_pk'])->findAll();
        }
        return view('laporan/laporan_kinerja', $data);
    }
    public function laporanEvaluasi(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $jabatan = model('jabatan');
        $data = $this->initData();
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas !=' => 0, 'tugas.status_tugas' => 1])->groupBy("tugas.id_rancangan_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $data['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0, 'tugas.status_tugas' => 1])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();
        for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
            $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
            for ($j=0; $j < count($data['tugas']); $j++) { 
                if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                    $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                } 
            }
        }
        $jumlah_tugas_tambahan = 0;
        for ($i=0; $i < count($data['tugas_tambahan']); $i++) { 
            $jumlah_tugas_tambahan += intval($data['tugas_tambahan'][$i]['jumlah_tugas']);
        }
        $data['jumlah_tugas_tambahan'] = $jumlah_tugas_tambahan;
        $data['title'] = "Laporan Evaluasi dan Monitoring";
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $bulan = model('bulan');
        $data['bulan'] = $bulan->findAll();
        if($data['user']['id_jabatan'] == 7){
            $data['user']['nama_jabatan'] = "Staff";
            $jabatan = model('staff');
            $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
        }
        return view('laporan/laporan_evaluasi', $data);
    }
    public function exportLaporanEvaluasi(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $data = $this->initData();
        $data['title'] = "Laporan Evaluasi dan Monitoring";
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        // $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan']])->groupBy('tugas.kode_tugas')->orderBy('tugas.id_rancangan_tugas', 'desc')->orderBy('tanggal_tugas', 'asc')->findAll();
        $rancangan_tugas = model('rancangan_tugas');
        $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas !=' => 0, 'tugas.status_tugas' => 1])->groupBy("tugas.id_rancangan_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $data['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0, 'tugas.status_tugas' => 1])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();
        for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
            $data['rancangan_tugas'][$i]['jumlah_tugas'] = 0;
            for ($j=0; $j < count($data['tugas']); $j++) { 
                if($data['rancangan_tugas'][$i]['kode_tugas'] == $data['tugas'][$j]['kode_tugas']){
                    $data['rancangan_tugas'][$i]['jumlah_tugas'] += intval($data['tugas'][$j]['jumlah_tugas']);
                } 
            }
        }
        $jumlah_tugas_tambahan = 0;
        for ($i=0; $i < count($data['tugas_tambahan']); $i++) { 
            $jumlah_tugas_tambahan += intval($data['tugas_tambahan'][$i]['jumlah_tugas']);
        }
        $data['jumlah_tugas_tambahan'] = $jumlah_tugas_tambahan;
        $bulan = model('bulan');
        $data['bulan'] = $bulan->findAll();
        if($data['user']['id_jabatan'] == 7){
            $data['user']['nama_jabatan'] = "Staff";
            $jabatan = model('staff');
            $data['user']['jabatan'] = $jabatan->where('id_staff', $data['user']['detail_jabatan'])->first();
        }
        $jabatan = model('jabatan');
        $data['jabatan'] = $jabatan->getJabtan(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['atasan'] = $jabatan->getAtasanLangsung(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
        // dd($data);
        return view('export_laporan_evaluasi', $data);
    }
    public function laporanKeaktifan(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $bulan = model('bulan');
        $jabatan = model('jabatan');
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
        $data['t'] = $thn;
        $data['bb'] = $bln;
        // DB
        // $data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        // Manual
        $tanggal_mulai = $thn.'-'.$bln.'-01';
        $batas = date('t', strtotime($thn.'-'.$bln.'-01'));
        $data['jumlah_tanggal'] = intval($batas);

        // Weekend
        $weekend = [];
        $sabtu_pertama = date('Y-m-d', strtotime('first saturday '.$thn.'-'.$bln.'-00'));
        $minggu_pertama = date('Y-m-d', strtotime('first sunday '.$thn.'-'.$bln.'-00'));
        $sabtu = $sabtu_pertama;
        $minggu = $minggu_pertama;
        array_push($weekend, $sabtu);
        array_push($weekend, $minggu);
        for ($i=0; $i < 4; $i++) { 
            $sabtu_selanjutnya = date('Y-m-d', strtotime('next saturday '.$sabtu));
            $minggu_selanjutnya = date('Y-m-d', strtotime('next sunday '.$minggu));
            array_push($weekend, $sabtu_selanjutnya);
            array_push($weekend, $minggu_selanjutnya);
            $sabtu = $sabtu_selanjutnya;
            $minggu = $minggu_selanjutnya;
        }
        
        // dd($weekend);
        $data['weekend'] = $weekend;

        $data['tahun'] = $thn;
        $temp_bulan = $bulan->where('id_bulan', intval($bln))->first();
        $data['bln'] = $temp_bulan['nama_bulan'];
        $data['jabatan'] = $jabatan->getJabtan(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
        // dd($data);
        return view('laporan/laporan_keaktifan', $data);
    }
    public function exportLaporanKeaktifan(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $bulan = model('bulan');
        $jabatan = model('jabatan');
        $batas_penanggalan = model('batas_penanggalan');
        $data = $this->initData();
        $thn = $this->request->getVar('tahun');
        $bln = intval($this->request->getVar('bulan'));
        if(intval($bln) < 10){
            $bln = '0'.$bln;   
        }
        $data['title'] = "Laporan Keaktifan Pegawai";
        $data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tanggal_presensi >=' => $thn.'-'.$bln.'-01', 'tanggal_presensi <=' => $thn.'-'.$bln.'-31'])->findAll();
        $data['bulan'] = $bulan->findAll();
        $data['t'] = $thn;
        $data['bb'] = $bln;
        // DB
        // $data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        // Manual
        $tanggal_mulai = $thn.'-'.$bln.'-01';
        $batas = date('t', strtotime($thn.'-'.$bln.'-01'));
        $data['jumlah_tanggal'] = intval($batas);

        // Weekend
        $weekend = [];
        $sabtu_pertama = date('Y-m-d', strtotime('first saturday '.$thn.'-'.$bln.'-00'));
        $minggu_pertama = date('Y-m-d', strtotime('first sunday '.$thn.'-'.$bln.'-00'));
        $sabtu = $sabtu_pertama;
        $minggu = $minggu_pertama;
        array_push($weekend, $sabtu);
        array_push($weekend, $minggu);
        for ($i=0; $i < 4; $i++) { 
            $sabtu_selanjutnya = date('Y-m-d', strtotime('next saturday '.$sabtu));
            $minggu_selanjutnya = date('Y-m-d', strtotime('next sunday '.$minggu));
            array_push($weekend, $sabtu_selanjutnya);
            array_push($weekend, $minggu_selanjutnya);
            $sabtu = $sabtu_selanjutnya;
            $minggu = $minggu_selanjutnya;
        }
        
        // dd($weekend);
        $data['weekend'] = $weekend;

        $data['tahun'] = $thn;
        $temp_bulan = $bulan->where('id_bulan', intval($bln))->first();
        $data['bln'] = $temp_bulan['nama_bulan'];
        $data['jabatan'] = $jabatan->getJabtan(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['atasan'] = $jabatan->getAtasanLangsung(session('id_status_user'), $data['user']['detail_jabatan']);
        $data['unit_kerja'] = $jabatan->getUnitKerja(session('id_status_user'), $data['user']['detail_jabatan']);
        // dd($data);
        return view('export_laporan_keaktifan', $data);
    }
}