<?php 
namespace App\Controllers;

class SupervisorController extends BaseController
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
        $data['title'] = "Dashboard Atasan";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $pengumuman = model('pengumuman');
        $presensi = model('presensi');
        $user = model('user');
        $tugas = model('tugas');
        $staff = model('staff');
        $jabatan = model('jabatan');
        $riwayat_jabatan = model('riwayat_jabatan');
        $data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->findAll());
        $data['jumlah_belum_validasi'] = count($tugas->where('status_tugas', 0)->findAll());
        $data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->findAll());
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $kode_bawahan = $staff->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
        $jumlah_bawahan = 0;
        for ($i=0; $i < count($kode_bawahan); $i++) { 
            $temp_jabatan = $jabatan->where('kode_jabatan', 6)->where('detail_jabatan', $kode_bawahan[$i]['id_staff'])->first();
            $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
            $jumlah_bawahan += $temp;
        }
        $data['jumlah_bawahan'] = $jumlah_bawahan;
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->findAll();
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
            $rancangan_tugas = model('rancangan_tugas');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
            $jumlah_tugas_berlangsung = 0;
            $jumlah_total_tugas = 0;
            for ($i=0; $i < count($data['rancangan_tugas']); $i++) { 
                $jumlah_total_tugas += intval($data['rancangan_tugas'][$i]['jumlah_total_tugas']);
            }
            $data['jumlah_total_tugas'] =  $jumlah_total_tugas;
            $data['jumlah_tugas_berlangsung'] = $jumlah_tugas_berlangsung;
            if($data['user']['id_jabatan'] == 6){
                $data['user']['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $data['user']['jabatan'] = $jabatan->where('id_supervisor', $data['user']['detail_jabatan'])->first();
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
            if($data['user']['id_jabatan'] == 6){
                $data['user']['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $data['user']['jabatan'] = $jabatan->where('id_supervisor', $data['user']['detail_jabatan'])->first();
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
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        // $data['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31')])->findAll();
        $data['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => date(date("Y").'-01-01'), 'tugas.tanggal_tugas <=' => date(date("Y").'-12-31')])->groupBy("tugas.id_rancangan_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        // dd($data['tugas']);
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
        return view('indeks_kepuasan', $data);
    }

    public function validasi(){
        $data['title'] = "Validasi Logbook";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $staff = model('staff');
        $jabatan = model('jabatan');
        $tugas = model('tugas');
        $presensi = model('presensi');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data_id_staff = $staff->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
        $id_staff = [];
        for ($i=0; $i < count($data_id_staff); $i++) { 
            array_push($id_staff, $data_id_staff[$i]['id_staff']);
        }
        $data_jabatan = $jabatan->where('kode_jabatan', 7)->whereIn('detail_jabatan', $id_staff)->findAll();
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
            $data['presensi_bawahan'][$i]['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $data['presensi_bawahan'][$i]['id_riwayat_jabatan'], 'tanggal_tugas' => $data['presensi_bawahan'][$i]['tanggal_presensi'], 'status_tugas' => 3])->findAll();
            $data['presensi_bawahan'][$i]['jumlah_tugas_validasi'] = count($data['presensi_bawahan'][$i]['tugas']);
        }
        // dd($data['presensi_bawahan']);
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $pesan = model('pesan');
        $data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

        return view('validasi', $data);
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
}