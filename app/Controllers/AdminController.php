<?php

namespace App\Controllers;

use App\Models\user;
use App\Models\status_user;
use App\Models\feedback;
use App\Models\indeksKepuasan;
use App\Models\indeksPertanyaan;
use App\Models\indeksNilai;
use App\Models\penilaian_kinerja;
use App\Models\nilai_pk;
use App\Models\pertanyaan_pk;
use App\Models\pengumuman;
use App\Models\rancangan_tugas;
use App\Models\jabatan;
use App\Models\riwayat_jabatan;
use App\Models\jam_kerja;

class AdminController extends BaseController
{

    protected $userModel;
    protected $statusUserModel;
    protected $feedbackUserModel;
    protected $indeksModel;
    protected $indeksPertanyaanModel;
    protected $indeksNilaiModel;
    protected $penilaianKinerjaModel;
    protected $nilaipkModel;
    protected $pertanyaanpkModel;
    protected $pengumumanModel;
    protected $rancanganTugasModel;
    protected $jabatanModel;
    protected $riwayatJabatanModel;
    protected $jamKerjaModel;
    protected $data = [];

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta'); 
        $this->userModel = new user();
        $this->statusUserModel = new status_user();
        $this->feedbackUserModel = new feedback();
        $this->indeksModel = new indeksKepuasan();
        $this->indeksPertanyaanModel = new indeksPertanyaan();
        $this->indeksNilaiModel = new indeksNilai();
        $this->penilaianKinerjaModel = new penilaian_kinerja();
        $this->nilaipkModel = new nilai_pk();
        $this->pertanyaanpkModel = new pertanyaan_pk();
        $this->pengumumanModel = new pengumuman();
        $this->rancanganTugasModel = new rancangan_tugas();
        $this->jabatanModel = new jabatan();
        $this->riwayatJabatanModel = new riwayat_jabatan();
        $this->jamKerjaModel = new jam_kerja();
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $pesan = model('pesan');
        $this->data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $this->data['kategori_menu'] = $kategori->findAll();
        $this->data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();
        $this->data['user'] = $this->userModel->getUser(session('no_induk'));
        $this->data['validation'] =  \Config\Services::validation();
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

    public function index()
    {
        $pengumuman = model('pengumuman');
        $tugas = model('tugas');
        $user = model('user');
        $this->data['title'] =  'Dashboard Admin';
        $this->data['jumlah_validasi'] = count($tugas->where('status_tugas', 1)->findAll());
        $this->data['jumlah_belum_validasi'] = count($tugas->where('status_tugas !=', 1)->findAll());
        $this->data['jumlah_revisi'] = count($tugas->where('status_tugas', 2)->findAll());
        $this->data['jumlah_pegawai'] = count($user->where('no_induk !=', session('no_induk'))->whereNotIn('id_status_user', [1,2])->findAll());
        $this->data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->where('pengumuman.status_pengumuman', 1)->findAll(); 

        $presensi = model('presensi');
        $data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        for ($i=0; $i < count($data['pegawai']); $i++) { 
            $data['pegawai'][$i]['presensi'] = $presensi->where(['id_riwayat_jabatan' => $data['pegawai'][$i]['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
            if($data['pegawai'][$i]['id_jabatan'] == 3){
                $data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_jabatan'] == 4){
                $data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_jabatan'] == 5){
                $data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_jabatan'] == 6){
                $data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($data['pegawai'][$i]['id_jabatan'] == 7){
                $data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $data['pegawai'][$i]['detail_jabatan'])->first();
            }
            $jabatan_a = model('jabatan');
            $data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($data['pegawai'][$i]['id_status_user'], $data['pegawai'][$i]['detail_jabatan']);
        }
        $this->data['pegawai'] = $data['pegawai'];
        return view('dashboard_admin', $this->data);
    }

    public function managementUsers()
    {
        $jabatan = model('jabatan');
        $this->data['title'] =  'Management Users';
        $this->data['users'] = $this->userModel->getUser();

        return view('admin/managementUsers', $this->data);
    }

    public function tambahUser()
    {
        $this->data['title'] =  'Tambah Users';
        $this->data['status_user'] = $this->statusUserModel->getStatusUser();
        $this->data['validation'] = \Config\Services::validation();

        return view('admin/tambahUser', $this->data);
    }

    public function saveUser()
    {
        // In the controller
        if (!$this->validate([
            'nama' => 'required',
            'no_induk' => [
                'rules' => 'required|is_unique[user.no_induk]',
                'errors' => [
                    'required' => 'No induk harus diisi',
                    'is_unique' => 'No induk sudah terdaftar',
                ]
            ],
            'tahun_masuk' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'status_user' => 'required',
            'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,png]'
        ])) {
            // // dd($this->data['validation']);
            // session()->setFlashdata('pesan', '<span class="text-danger">Data gagal ditambahkan!</span>');
            $this->data['validation'] = \Config\Services::validation();

            return redirect()->to('/admin/tambahUser')->withInput()->with('test', 'cel');
        }

        $file = $this->request->getFile('foto_profil');
        if ($file->move(FCPATH . 'public/assets/images/users/')) {
            $name_file = '/assets/images/users/' . $file->getName();
        } else {
            $name_file = null;
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'password' => '123',
            'no_induk' => $this->request->getVar('no_induk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'id_status_user' => $this->request->getVar('status_user'),
            'foto_profil' => $name_file,
        ];
        $this->userModel->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to(base_url().'/admin/managementUsers');
    }

    public function deleteUser($no_induk)
    {
        $this->userModel->delete($no_induk);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url().'/admin/managementUsers');
    }

    public function ubahUser($no_induk)
    {
        $this->data['title'] =  'Ubah Users';
        $this->data['status_user'] = $this->statusUserModel->getStatusUser();
        $this->data['validation'] =  \Config\Services::validation();
        $this->data['u'] = $this->userModel->getUser($no_induk);

        return view('admin/ubahUser', $this->data);
    }

    public function editUser($no_induk)
    {
        $file = $this->request->getFile('foto_profil');
        $user = $this->userModel->getUser($no_induk);

        $no_induk_baru = $this->request->getVar('no_induk');
        if ($user['no_induk'] == $no_induk_baru) {
            $role2 = [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No induk harus diisi',
                ]
            ];
        } else {
            $role2 =  [
                'rules' => 'required|is_unique[user.no_induk]',
                'errors' => [
                    'required' => 'No induk harus diisi',
                    'is_unique' => 'No induk sudah terdaftar',
                ]
            ];
        }


        if ($file->getName()) {
            if (session('id_status_user') == 1 || session('id_status_user') == 2) {
                if (!$this->validate([
                    'nama' => 'required',
                    'no_induk' => $role2,
                    'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,png]'
                ])) {
                    $this->data['validation'] = \Config\Services::validation();
                    return redirect()->to('/admin/ubahUser/' . $no_induk)->withInput()->with('test', 'cek');
                }
            } else {
                if (!$this->validate([
                    'nama' => 'required',
                    'no_induk' => $role2,
                    'tahun_masuk' => 'required',
                    'email' => 'required',
                    'no_telepon' => 'required',
                    'alamat' => 'required',
                    'status_user' => 'required',
                    'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,png]'
                ])) {
                    $this->data['validation'] = \Config\Services::validation();
                    return redirect()->to('/admin/ubahUser/' . $no_induk)->withInput()->with('test', 'cek');
                }
            }
        } else {
            if (session('id_status_user') == 1 || session('id_status_user') == 2) {
                if (!$this->validate([
                    'nama' => 'required',
                    'no_induk' => $role2,
                ])) {
                    $this->data['validation'] = \Config\Services::validation();
                    return redirect()->to('/admin/ubahUser/' . $no_induk)->withInput()->with('test', 'cek');
                }
            } else {
                if (!$this->validate([
                    'nama' => 'required',
                    'no_induk' => $role2,
                    'tahun_masuk' => 'required',
                    'email' => 'required',
                    'no_telepon' => 'required',
                    'alamat' => 'required',
                    'status_user' => 'required',
                ])) {
                    $this->data['validation'] = \Config\Services::validation();
                    return redirect()->to('/admin/ubahUser/' . $no_induk)->withInput()->with('test', 'cek');
                }
            }
        }

        if ($file->getName()) {
            $file->move(FCPATH . 'public/assets/images/users/');
            $name_file = '/assets/images/users/' . $file->getName();
        } else {
            $name_file = $user['foto_profil'];
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'password' => '123',
            'no_induk' => $this->request->getVar('no_induk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'id_status_user' => $this->request->getVar('status_user'),
            'foto_profil' => $name_file
        ];

        $this->userModel->update($no_induk, $data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to(base_url().'/admin/managementUsers');
    }

    public function apiPassword($no_induk)
    {
        $user = $this->userModel->getUser($no_induk);
        return json_encode($user);
    }

    public function ubahPassword($no_induk)
    {
        $validation = \Config\Services::validation();
        $validation->setRule('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $validation->setRule('password2', 'Password', 'required|trim|matches[password1]');

        if (!$validation->withRequest($this->request)
            ->run()) {
            session()->setFlashdata('pesan', '<span class="text-danger">Password gagal diubah</span>');
            return redirect()->to('/admin/managementUsers');
        } else {
            $data = [
                'password' => $this->request->getVar('password1')
            ];
            $this->userModel->update($no_induk, $data);
            session()->setFlashdata('pesan', 'Password berhasil diubah');
            return redirect()->to(base_url().'/admin/managementUsers');
        }
    }

    public function settingPekerjaan($no_induk)
    {
        $pekerjaan_aktif = [];
        $this->data['title'] =  'Setting Pekerjaan Users';
        $this->data['validation'] =  \Config\Services::validation();
        $this->data['u'] = $this->userModel->getUser($no_induk);
        $this->data['status_user'] = $this->statusUserModel->whereNotIn('id_status_user', [1, 2])->findAll();
        $this->data['riwayat_pekerjaan'] = $this->riwayatJabatanModel->getRiwayatJabatan($no_induk);
        foreach ($this->data['riwayat_pekerjaan'] as $r) {
            if ($r['status_aktif'] == 1) {
                $pekerjaan_aktif = $r;
            }
        }

        if ($pekerjaan_aktif) {
            $this->data['pekerjaan_sekarang'] = $this->rancanganTugasModel->where('id_jabatan', $pekerjaan_aktif['id_jabatan'])->findAll();
            $this->data['pekerjaan'] = $pekerjaan_aktif;
        } else {
            $this->data['pekerjaan_sekarang'] = null;
            $this->data['pekerjaan'] = null;
        }

        // dd($this->data);

        return view('admin/settingPekerjaan', $this->data);
    }

    public function daftarSaran()
    {
        $this->data['title'] = 'Daftar Saran';
        if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
            $waktu_mulai = $this->request->getVar('waktu_mulai');
            $waktu_selesai = $this->request->getVar('waktu_selesai');
            $this->data['saran'] = $this->feedbackUserModel->getFeedback($waktu_mulai, $waktu_selesai);
            $this->data['waktu_mulai'] = $waktu_mulai;
            $this->data['waktu_selesai'] = $waktu_selesai;
        }else{
            $this->data['saran'] = $this->feedbackUserModel->getFeedback();
            $this->data['waktu_mulai'] = null;
            $this->data['waktu_selesai'] = null;
        }

        return view('admin/daftarSaran', $this->data);

        // dd($this->data['saran']);
    }

    public function profil()
    {
        $this->data['title'] = 'Profil Admin';
        if (! $this->validate([
            'nama' => 'required',
            'nip'  => 'required',
            'email'  => 'required',
            'no_telepon'  => 'required',
            'alamat'  => 'required',
        ])){
            return view('admin/profilAdmin', $this->data);
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
            return redirect()->to(base_url().'/admin/profil');
        }
    }

    public function ubahGambar($no_induk)
    {
        $file = $this->request->getFile('foto_profil');
        if (!$this->validate([
            'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,png]'
        ])) {
            session()->setFlashdata('pesan', '<span class="text-danger">Foto profil gagal diubah</span>');
            return redirect()->to('/admin/profil');
        }
        $file->move(FCPATH . 'public/assets/images/users/');
        $name_file = '/assets/images/users/' . $file->getName();
        $data = [
            'foto_profil' => $name_file
        ];
        $this->userModel->update($no_induk, $data);
        session()->setFlashdata('pesan', 'Foto profil berhasil diubah');
        return redirect()->to(base_url().'/admin/profil');
    }

    public function indeksKepuasan()
    {
        $this->data['title'] = 'Indeks Kepuasan Pegawai';
        $this->data['indeks'] = $this->indeksModel->findAll();


        $data = [];
        $data2 = [];
        for ($i = 0; $i < count($this->data['indeks']); $i++) {
            $data[$this->data['indeks'][$i]['id']] = count($this->indeksPertanyaanModel->getPertanyaan($this->data['indeks'][$i]['id']));
            $data2[$this->data['indeks'][$i]['id']] = $this->indeksModel->jumlahResponden($this->data['indeks'][$i]['id']);
        }

        $this->data['jumlah'] = $data;
        $this->data['responden'] = $data2;
        return view('admin/daftarIndeksKepuasan', $this->data);
    }

    public function hasilIndeksKepuasan($in_indeks)
    {
        $this->data['title'] = 'Hasil Indeks Kepuasan Pegawai';
        $pertanyaan = $this->indeksPertanyaanModel->getPertanyaan($in_indeks);
        $data = [];
        for ($i = 0; $i < count($pertanyaan); $i++) {
            $data[$pertanyaan[$i]['id_pertanyaan']] = [
                'kurang' => count($this->indeksNilaiModel->getJumlahUser($pertanyaan[$i]['id_pertanyaan'], 1)),
                'cukup' => count($this->indeksNilaiModel->getJumlahUser($pertanyaan[$i]['id_pertanyaan'], 2)),
                'baik' => count($this->indeksNilaiModel->getJumlahUser($pertanyaan[$i]['id_pertanyaan'], 3)),
                'sangat_baik' => count($this->indeksNilaiModel->getJumlahUser($pertanyaan[$i]['id_pertanyaan'], 4)),
            ];
        }
        $this->data['jumlah'] = count($this->userModel->getUserKepuasan());
        $this->data['pertanyaan'] = $pertanyaan;
        $this->data['nilai'] = $data;
        return view('hasilIndeksKepuasan', $this->data);
    }

    public function tambahIndeksKepuasan()
    {

        $data = [
            'tanggal' => $this->request->getVar('tanggal'),
            'status' => 0
        ];
        $this->indeksModel->insert($data);
        session()->setFlashdata('pesan', 'Indeks Kepuasan berhisil ditambah');
        return redirect()->to('/admin/indeksKepuasan');
    }

    public function editIndeksKepuasan($id)
    {

        $this->data['title'] = 'Edit Indeks Kepuasan';
        $this->data['pertanyaan'] = $this->indeksPertanyaanModel->getPertanyaan($id);
        $this->data['indeks'] = $this->indeksModel->where(['id' => $id])->first();
        return view('admin/editIndeksKepuasan', $this->data);
    }

    public function apiPertanyaan($id)
    {
        $data = $this->indeksPertanyaanModel->getPertanyaan($id);
        echo json_encode($data);
    }

    public function tambahIndeksPertanyaan()
    {
        $data = [
            'pertanyaan' => $this->request->getVar('pertanyaan'),
            'id_indeks' => $this->request->getVar('id_indeks'),
        ];
        $this->indeksPertanyaanModel->insert($data);
        $id_pertanyaan = $this->indeksPertanyaanModel->getLastId();
        $data['nomer'] = count($this->indeksPertanyaanModel->getPertanyaan($this->request->getVar('id_indeks')));
        $data['pertanyaan'] = $this->indeksPertanyaanModel->where(['id_pertanyaan' => $id_pertanyaan['id_pertanyaan']])->first();
        echo json_encode($data);
    }

    public function editIndeksPertanyaan()
    {
        $id_pertanyaan = $this->request->getVar('id_pertanyaan');
        $data = [
            'pertanyaan' => $this->request->getVar('pertanyaan')
        ];

        $this->indeksPertanyaanModel->update($id_pertanyaan, $data);
        echo json_encode($id_pertanyaan);
        // session()->setFlashdata('pesan', 'Pertanyaan berhasil diubah');
        // return redirect()->to('/admin/editIndeksKepuasan/' . $this->request->getVar('id_indeks'));
    }

    public function ubahStatusIndeks($id)
    {

        $cekIndek = $this->indeksModel->where(['id' => $id])->first();
        if ($cekIndek['status'] == 1) {
            $data2 = [
                'status' => 0
            ];
            $this->indeksModel->update($id, $data2);
            session()->setFlashdata('pesan', 'Status Indeks Kepuasan berhasil diubah');
            return redirect()->to(base_url().'/admin/indeksKepuasan');
        } else {
            $indek = $this->indeksModel->findAll();
            $data = [];
            for ($i = 0; $i < count($indek); $i++) {
                $data[$i] = [
                    'id' => $indek[$i]['id'],
                    'status' => 0
                ];
            }

            $this->indeksModel->updateBatch($data, 'id');
            $data2 = [
                'status' => 1
            ];
            $this->indeksModel->update($id, $data2);
            session()->setFlashdata('pesan', 'Status Indeks Kepuasan berhasil diubah');
            return redirect()->to(base_url().'/admin/indeksKepuasan');
        }
    }

    public function hapusIndeksPertanyaan($id_pertanyaan, $id_indeks)
    {

        $this->indeksNilaiModel->where('id_pertanyaan', $id_pertanyaan)->delete();
        $this->indeksPertanyaanModel->where('id_pertanyaan', $id_pertanyaan)->delete();
        session()->setFlashdata('pesan', 'Pertanyaan berhasil dihapus');
        return redirect()->to(base_url().'/admin/editIndeksKepuasan/' . $id_indeks);
    }

    public function hapusIndeksKepuasan()
    {
        $id_indeks = $this->request->getVar('id_indeks');
        $dataPertanyaan = $this->indeksPertanyaanModel->where('id_indeks', $id_indeks)->findAll();
        foreach ($dataPertanyaan as $p) {
            $this->indeksNilaiModel->where('id_pertanyaan', $p['id_pertanyaan'])->delete();
        }
        $this->indeksPertanyaanModel->where('id_indeks', $id_indeks)->delete();
        $this->indeksModel->where('id', $id_indeks)->delete();
        session()->setFlashdata('pesan', 'Indeks kepuasan berhasil dihapus');
        return redirect()->to(base_url().'/admin/indeksKepuasan');
    }

    public function penilaianKinerja()
    {
        $this->data['title'] = 'Penilaian Kinerja';
        $this->data['penilaian'] = $this->penilaianKinerjaModel->findAll();

        $data = [];
        $data2 = [];
        for ($i = 0; $i < count($this->data['penilaian']); $i++) {
            $data[$this->data['penilaian'][$i]['id_pk']] = count($this->pertanyaanpkModel->getPertanyaanpk($this->data['penilaian'][$i]['id_pk']));
            $data2[$this->data['penilaian'][$i]['id_pk']] = $this->penilaianKinerjaModel->jumlahRespond($this->data['penilaian'][$i]['id_pk']);
        }

        $this->data['jumlah'] = $data;
        $this->data['responden'] = $data2;
        return view('/admin/daftarPenilaianKinerja', $this->data);
    }

    public function tambahPenilaianKinerja()
    {
        $data = [
            'tanggal_pk' => $this->request->getVar('tanggal_pk'),
            'nama_pk' => $this->request->getVar('nama_pk')
        ];

        $this->penilaianKinerjaModel->insert($data);
        session()->setFlashdata('pesan', 'Penilaian kinerja pegawai berhasil ditambah!');
        return redirect()->to(base_url().'/admin/penilaianKinerja');
    }

    public function hapusPenilaianKinerja()
    {
        $id_pk = $this->request->getVar('id_pk');
        $dataPertanyaan = $this->pertanyaanpkModel->where('id_pk', $id_pk)->findAll();
        foreach ($dataPertanyaan as $p) {
            $this->nilaipkModel->where('id_pertanyaan_pk', $p['id_pertanyaan_pk'])->delete();
        }
        $this->pertanyaanpkModel->where('id_pk', $id_pk)->delete();
        $this->penilaianKinerjaModel->where('id_pk', $id_pk)->delete();
        session()->setFlashdata('pesan', 'Indeks kepuasan berhasil dihapus');
        return redirect()->to(base_url().'/admin/penilaianKinerja');
    }

    public function ubahStatusPenilaian($id)
    {
        $cekIndek = $this->penilaianKinerjaModel->where(['id_pk' => $id])->first();
        if ($cekIndek['status_pk'] == 1) {
            $data2 = [
                'status_pk' => 0
            ];
            $this->penilaianKinerjaModel->update($id, $data2);
            session()->setFlashdata('pesan', 'Status penilaian kinerja berhasil diubah');
            return redirect()->to('/admin/penilaianKinerja');
        } else {
            $penilaian = $this->penilaianKinerjaModel->findAll();
            $data = [];
            for ($i = 0; $i < count($penilaian); $i++) {
                $data[$i] = [
                    'id_pk' => $penilaian[$i]['id_pk'],
                    'status_pk' => 0
                ];
            }

            $this->penilaianKinerjaModel->updateBatch($data, 'id_pk');
            $data2 = [
                'status_pk' => 1
            ];
            $this->penilaianKinerjaModel->update($id, $data2);
            session()->setFlashdata('pesan', 'Status penilaian kinerja berhasil diubah');
            return redirect()->to(base_url().'/admin/penilaianKinerja');
        }
    }

    public function editPenilaianKinerja($id_pk)
    {
        $this->data['aspek'] = [
            "Aspek Teknis Pekerjaan",
            "Aspek Non Teknis",
            "Aspek Kepribadian",
            "Aspek Kepemimpinan (Khusus untuk: GM, Manajer, Supervisor, dan Koordinator)"
        ];


        $this->data['title'] = 'Edit Penilaian Kinerja';
        $this->data['pertanyaan'] = $this->pertanyaanpkModel->where(['id_pk' => $id_pk])->findAll();
        $this->data['penilaian'] = $this->penilaianKinerjaModel->where(['id_pk' => $id_pk])->first();
        return view('admin/editPenilaianKinerja', $this->data);
    }

    public function tambahPertanyaanPenilaian()
    {
        $data = [
            'pertanyaan_pk' => $this->request->getVar('pertanyaan_pk'),
            'id_pk' => $this->request->getVar('id_pk'),
            'aspek_pk' => $this->request->getVar('aspek_pk')
        ];

        $this->pertanyaanpkModel->insert($data);
        $id_pertanyaan_pk = $this->pertanyaanpkModel->getLastID();

        $data['nomer'] = count($this->pertanyaanpkModel->getPertanyaanpk($this->request->getVar('id_pk')));
        $data['pertanyaan_pk'] = $this->pertanyaanpkModel->where(['id_pertanyaan_pk' => $id_pertanyaan_pk['id_pertanyaan_pk']])->first();
        echo json_encode($data);
    }

    public function ubahPertanyaanPenilaian()
    {
        $id_pertanyaan_pk = $this->request->getVar('id_pertanyaan_pk');
        $data = [
            'pertanyaan_pk' => $this->request->getVar('pertanyaan_pk'),
            'aspek_pk' => $this->request->getVar('aspek_pk'),
        ];

        $this->pertanyaanpkModel->update($id_pertanyaan_pk, $data);
        echo json_encode($id_pertanyaan_pk);
    }
    public function exportPenilaianKinerja($id_pk)
    {
        $user = $this->userModel->getUserKepuasan();

        foreach ($user as $u) {
            $data[$u['no_induk']] = [
                'nama' => $u['nama'],
                'status' => $u['nama_status_user'],
                'no_induk' => $u['no_induk'],
                'pekerjaan' => $this->userModel->getDaftarPekerjaanUser($u['no_induk']),
                'nilai' => $this->penilaianKinerjaModel->getPertanyaan($id_pk, $u['no_induk'])
            ];
        }
        $this->data['penilaian'] = $this->penilaianKinerjaModel->where('id_pk', $id_pk)->first();
        $this->data['penilaian_kinerja'] = $data;
        $this->data['pertanyaan'] = $this->pertanyaanpkModel->where('id_pk', $id_pk)->findAll();
        $data3 = [];
        foreach ($this->data['penilaian_kinerja'] as $pk) {
            $data3[$pk['status']]['jumlah'] = 0;
            $data3[$pk['status']]['nama'] = '';
        }

        foreach ($this->data['penilaian_kinerja'] as $pk) {
            $indek = 1;
            $data3[$pk['status']]['jumlah'] += $indek;
            $data3[$pk['status']]['nama'] = $pk['status'];
        }
        ($this->data);
        $this->data['status'] = $data3;
        return view('layout/hasil_penilaian_export', $this->data);
    }

    public function hapusPertanyaanPenilaian($id_pertanyaan_pk, $id_pk)
    {
        $this->nilaipkModel->where('id_pertanyaan_pk', $id_pertanyaan_pk)->delete();
        $this->pertanyaanpkModel->where('id_pertanyaan_pk', $id_pertanyaan_pk)->delete();
        session()->setFlashdata('pesan', 'Pertanyaan berhasil dihapus');
        return redirect()->to(base_url().'/admin/editPenilaianKinerja/' . $id_pk);
    }

    public function hasilPenilaianKinerja($id_pk)
    {
        $this->data['title'] = 'Hasil Penilaian Kinerja';
        $user = $this->userModel->getUserKepuasan();

        if($user == null){
            $data[0] = [
                'nama' => '-',
                'status' => '-',
                'no_induk' => '-',
                'pekerjaan' => '-',
                'nilai' => $this->penilaianKinerjaModel->getPertanyaan($id_pk, 0)
            ];
        }else{
            foreach ($user as $u) {
                $data[$u['no_induk']] = [
                    'nama' => $u['nama'],
                    'status' => $u['nama_status_user'],
                    'no_induk' => $u['no_induk'],
                    'pekerjaan' => $this->userModel->getDaftarPekerjaanUser($u['no_induk']),
                    'nilai' => $this->penilaianKinerjaModel->getPertanyaan($id_pk, $u['no_induk'])
                ];
            }
        }
        $this->data['penilaian'] = $this->penilaianKinerjaModel->where('id_pk', $id_pk)->first();
        $this->data['penilaian_kinerja'] = $data;
        $this->data['pertanyaan'] = $this->pertanyaanpkModel->where('id_pk', $id_pk)->findAll();
        $data3 = [];
        foreach ($this->data['penilaian_kinerja'] as $pk) {
            $data3[$pk['status']]['jumlah'] = 0;
            $data3[$pk['status']]['nama'] = '';
        }

        foreach ($this->data['penilaian_kinerja'] as $pk) {
            $indek = 1;
            $data3[$pk['status']]['jumlah'] += $indek;
            $data3[$pk['status']]['nama'] = $pk['status'];
        }
        ($this->data);
        $this->data['status'] = $data3;
        return view('hasilPenilaianKinerja', $this->data);
    }

    public function daftarPengumuman()
    {
        $this->data['title'] = 'Daftar Pengumuman';
        $this->data['pengumuman'] = $this->pengumumanModel->getPengumuman();

        return view('admin/daftarPengumuman', $this->data);
    }

    public function tambahPengumuman()
    {
        $data = [
            'pengumuman' => $this->request->getVar('pengumuman'),
            'tanggal_pengumuman' => date('Y-m-d'),
            'waktu_pengumuman' => date("h:i:s"),
            'publisher' => session('no_induk'),
            'status_pengumuman' => 0,
        ];
        $this->pengumumanModel->insert($data);
        session()->setFlashdata('pesan', 'Data pengumuman berhasil ditambah');
        return redirect()->to(base_url().'/admin/daftarPengumuman');
    }

    public function hapusPengumuman()
    {
        $id_pengumuman = $this->request->getVar('id_pengumuman');
        $this->pengumumanModel->where('id_pengumuman', $id_pengumuman)->delete();
        session()->setFlashdata('pesan', 'Data pengumuman berhasil dihapus');
        return redirect()->to(base_url().'/admin/daftarPengumuman');
    }

    public function editPengumuman()
    {
        $id_pengumuman = $this->request->getVar('id_pengumuman');
        $data = [
            'pengumuman' => $this->request->getVar('pengumuman'),
            'tanggal_pengumuman' => date('Y-m-d'),
            'waktu_pengumuman' => date("h:i:s"),
            'status_pengumuman' => $this->request->getVar('status_pengumuman'),
        ];


        $this->pengumumanModel->update($id_pengumuman, $data);
        session()->setFlashdata('pesan', 'Data pengumuman berhasil diubah');
        return redirect()->to(base_url().'/admin/daftarPengumuman');
    }

    public function daftarRancanganTugas()
    {
        $this->data['title'] = "Daftar Rancangan Tugas";
        $jabatan = $this->jabatanModel->whereNotIn(
            'kode_jabatan',
            [1, 2]
        )->orderBy('kode_jabatan')->findAll();
        $data = [];
        $i = 1;
        foreach ($jabatan as $j) {
            $data[$j['id_jabatan']] = $this->jabatanModel->getJabtan($j['kode_jabatan'], $j['detail_jabatan']);
            $data[$j['id_jabatan']]['unit_kerja'] = $this->jabatanModel->getUnitKerja($j['kode_jabatan'], $j['detail_jabatan']);
        }
        $this->data['jabatan'] = $data;
        return view('admin/daftarRancanganTugas', $this->data);
    }

    public function lihatRancanganTugas($id_jabatan)
    {
        $this->data['title'] = 'Daftar Rancangan Tugas';
        $id = $this->jabatanModel->where('id_jabatan', $id_jabatan)->first();
        $this->data['jabatan'] = $this->jabatanModel->getJabtan($id['kode_jabatan'], $id['detail_jabatan']);
        $this->data['rancangan'] = $this->rancanganTugasModel->where('id_jabatan', $id_jabatan)->orderBy('nomor_pekerjaan', 'ASC')->findAll();
        return view('admin/editRancanganTugas', $this->data);
    }

    public function tambahRancanganTugas()
    {
        $data = [
            'id_jabatan' => $this->request->getVar('id_jabatan'),
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'periode' => $this->request->getVar('periode'),
            'jumlah_total_tugas' => $this->request->getVar('jumlah_tugas'),
            'nomor_pekerjaan' => $this->request->getVar('nomor_pekerjaan'),
            'kode_tugas' => bin2hex(random_bytes(3)),
            'status_tugas' => 1,
        ];

        $this->rancanganTugasModel->insert($data);
        $id_rancangan_tugas = $this->rancanganTugasModel->getLastID();

        $this->data['rancangan'] = $this->rancanganTugasModel->where(['id_rancangan_tugas' => $id_rancangan_tugas['id_rancangan_tugas']])->first();
        echo json_encode($this->data);
    }

    public function ubahRancanganTugas()
    {
        $id_rancangan_tugas = $this->request->getVar('id_rancangan_tugas');

        $data = [
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'periode' => $this->request->getVar('periode'),
            'jumlah_total_tugas' => $this->request->getVar('jumlah_tugas'),
            'nomor_pekerjaan' => $this->request->getVar('nomor_pekerjaan'),
        ];

        $this->rancanganTugasModel->update($id_rancangan_tugas, $data);
        echo json_encode($data);
    }

    public function hapusRancanganTugas($id_rancangan_tugas, $id_jabatan)
    {
        $this->rancanganTugasModel->where('id_rancangan_tugas', $id_rancangan_tugas)->delete();
        session()->setFlashdata('pesan', 'Data rancangan tugas berhasil dihapus');
        return redirect()->to(base_url().'/admin/lihatRancanganTugas/' . $id_jabatan);
    }

    public function apiDetailJabatan($id_status_user)
    {
        $data = $this->jabatanModel->getDaftarJabatan($id_status_user);
        echo json_encode($data);
    }
    public function apiAtasanJabatan($id_status_user)
    {
        $data = $this->jabatanModel->getListAtasan($id_status_user);
        echo json_encode($data);
    }

    public function tambahRiwayatPekerjaan($no_induk)
    {

        $data = [
            'no_induk' => $no_induk,
            'id_jabatan' => $this->request->getVar('id_jabatan'),
            'status_aktif' => 0,
            'periode_mulai_jabatan' => $this->request->getVar('periode_mulai_jabatan'),
        ];

        $this->riwayatJabatanModel->insert($data);
        session()->setFlashdata('pesan', 'Data riwayat pekerjaan berhasil ditambah');
        return redirect()->to(base_url().'/admin/settingPekerjaan/' . $no_induk);
    }

    public function hapusRiwayatPekerjaan($id_riwayat)
    {
        $no_induk = $this->request->getVar('no_induk');

        $tugas = model('tugas');
        $validasi = model('validasi');
        $presensi = model('presensi');
        $dataTugas =  $tugas->where('id_riwayat_jabatan', $id_riwayat)->findAll();
        $dataPresensi = $presensi->where('id_riwayat_jabatan', $id_riwayat)->findAll();
        // Jika memiliki data tugas
        if ($dataTugas) {
            foreach ($dataTugas as $dt) {
                $validasi->where('id_tugas', $dt['id_tugas'])->delete();
            }
            $tugas->where('id_riwayat_jabatan', $id_riwayat)->delete();
        }

        // jika memiliki data presensi
        if ($dataPresensi) {
            $presensi->where('id_riwayat_jabatan', $id_riwayat)->findAll();
        }

        $this->riwayatJabatanModel->where('id_riwayat_jabatan', $id_riwayat)->delete();
        session()->setFlashdata('pesan', 'Data riwayat pekerjaan berhasil dihapus');
        return redirect()->to(base_url().'/admin/settingPekerjaan/' . $no_induk);
    }

    public function ubahTanggalMenjabat($id_riwayat)
    {
        $no_induk = $this->request->getVar('no_induk');
        $data = [
            'periode_mulai_jabatan' => $this->request->getVar('periode_mulai_jabatan'),
            'periode_akhir_jabatan' => $this->request->getVar('periode_akhir_jabatan')
        ];
        $this->riwayatJabatanModel->update($id_riwayat, $data);
        session()->setFlashdata('pesan', 'Periode riwayat pekerjaan berhasil diubah');
        return redirect()->to(base_url().'/admin/settingPekerjaan/' . $no_induk);
    }

    public function ubahStatusRiwayat($id_riwayat)
    {
        $no_induk = $this->request->getVar('no_induk');
        $cekRiwayat = $this->riwayatJabatanModel->where(['id_riwayat_jabatan' => $id_riwayat])->first();
        if ($cekRiwayat['status_aktif'] == 1) {
            $data2 = [
                'status_aktif' => 0
            ];
            $this->riwayatJabatanModel->update($id_riwayat, $data2);
            session()->setFlashdata('pesan', 'Status riwayat pekerjaan berhasil diubah');
            return redirect()->to(base_url().'/admin/settingPekerjaan/' . $no_induk);
        } else {
            $indek = $this->riwayatJabatanModel->findAll();
            $data = [];
            for ($i = 0; $i < count($indek); $i++) {
                $data[$i] = [
                    'id_riwayat_jabatan' => $indek[$i]['id_riwayat_jabatan'],
                    'status_aktif' => 0
                ];
            }

            $this->riwayatJabatanModel->updateBatch($data, 'id_riwayat_jabatan');
            $data2 = [
                'status_aktif' => 1
            ];
            $this->riwayatJabatanModel->update($id_riwayat, $data2);
            session()->setFlashdata('pesan', 'Status riwayat pekerjaan berhasil diubah');
            return redirect()->to(base_url().'/admin/settingPekerjaan/' . $no_induk);
        }
    }
    public function daftarJamKerja()
    {
        $this->data['title'] = 'Management Jam Kerja';
        $this->data['jam_kerja']  = $this->jamKerjaModel->getJamKerja();
        $this->data['status_user'] = $this->statusUserModel->whereNotIn('id_status_user', [1, 2])->findAll();
        // dd($this->data['jam_kerja']);
        return view('admin/daftarJamKerja', $this->data);
    }

    public function daftarJabatan()
    {
        $this->data['title'] = 'Management Jabatan';
        $jabatan = $this->jabatanModel->whereNotIn(
            'kode_jabatan',
            [1, 2]
        )->orderBy('kode_jabatan')->findAll();
        $data = [];
        $i = 1;
        foreach ($jabatan as $j) {
            $data[$j['id_jabatan']] = $this->jabatanModel->getJabtan($j['kode_jabatan'], $j['detail_jabatan']);
            $data[$j['id_jabatan']]['atasan'] = $this->jabatanModel->getAtasanJabatan($j['kode_jabatan'], $j['detail_jabatan']);
        }
        $this->data['jabatan'] = $data;
        $this->data['status_user'] = $this->statusUserModel->whereNotIn('id_status_user', [1, 2])->findAll();
        // dd($this->data['jabatan']);
        return view('admin/daftarJabatan', $this->data);
    }

    public function tambahJamKerja()
    {
        // cek jam kerja sebelumnya
        $cek = $this->jamKerjaModel->where('id_jabatan', $this->request->getVar('id_jabatan'))->first();
        if (!empty($cek) == false) {
            $data = [
                'jam_kerja_masuk' => $this->request->getVar('jam_kerja_masuk'),
                'jam_kerja_keluar' => $this->request->getVar('jam_kerja_keluar'),
                'id_jabatan' => $this->request->getVar('id_jabatan'),
                'status_aktif' => $this->request->getVar('status_aktif'),
                'status_jam_kerja' => $this->request->getVar('status_jam_kerja')
            ];


            $this->jamKerjaModel->insert($data);
            session()->setFlashdata('pesan', 'Jam kerja berhasil ditambah');
        } else {
            session()->setFlashdata('pesan', '<span class="text-danger">Jam kerja sudah ada</span>');
        }
        return redirect()->to(base_url().'/admin/daftarJamKerja/');
    }

    public function tambahJabatan()
    {
        // cek jam kerja sebelumnya
        $nama = $this->request->getVar('nama_jabatan');
        $status = $this->request->getVar('status_jabatan');
        $jabatan = model('jabatan');
        $temp_data = [];
        if($status != '3'){
            $atasan = $this->request->getVar('atasan_langsung');
            $temp_jabatan = $jabatan->where('id_jabatan', $atasan)->first();
            if ($status = '7') {
                $data = [
                    'nama' => $nama,
                    'id_supervisor' => $temp_jabatan['detail_jabatan']
                ];
                $staff = model('staff');
                $staff->insert($data);
                $temp_p = $staff->where(['nama' => $nama, 'id_supervisor' =>$temp_jabatan['detail_jabatan']])->first();
                $temp_data = [
                    'kode_jabatan' => 7,
                    'detail_jabatan' => $temp_p['id_staff']
                ];
            } else if ($status = '6') {
                $data = [
                    'nama' => $nama,
                    'id_manager' => $temp_jabatan['detail_jabatan']
                ];
                $supervisor = model('supervisor');
                $supervisor->insert($data);
                $temp_p = $supervisor->where(['nama' => $nama, 'id_manager' =>$temp_jabatan['detail_jabatan']])->first();
                $temp_data = [
                    'kode_jabatan' => 6,
                    'detail_jabatan' => $temp_p['id_supervisor']
                ];
            } else if ($status = '5') {
                $data = [
                    'nama' => $nama,
                    'id_gm' => $temp_jabatan['detail_jabatan']
                ];
                $manager = model('manager');
                $manager->insert($data);
                $temp_p = $manager->where(['nama' => $nama, 'id_gm' =>$temp_jabatan['detail_jabatan']])->first();
                $temp_data = [
                    'kode_jabatan' => 5,
                    'detail_jabatan' => $temp_p['id_manager']
                ];
            } else if ($status = '4') {
                $data = [
                    'nama' => $nama,
                    'id_direktur' => $temp_jabatan['detail_jabatan']
                ];
                $general_manager = model('general_manager');
                $general_manager->insert($data);
                $temp_p = $general_manager->where(['nama' => $nama, 'id_direktur' =>$temp_jabatan['detail_jabatan']])->first();
                $temp_data = [
                    'kode_jabatan' => 4,
                    'detail_jabatan' => $temp_p['id_gm']
                ];
            }
        }else{
            $data = [
                'nama' => $nama
            ];
            $direktur = model('direktur');
            $direktur->insert($data);
            $temp_p = $direktur->where(['nama' => $nama])->first();
            $temp_data = [
                'kode_jabatan' => 3,
                'detail_jabatan' => $temp_p['id_direktur']
            ];
        }
        $jabatan->insert($temp_data);
        session()->setFlashdata('pesan', 'Jabatan berhasil ditambah');
        return redirect()->to(base_url().'/admin/daftarJabatan/');
    }
    public function editJabatan()
    {
        // cek jam kerja sebelumnya
        $nama = $this->request->getVar('nama_jabatan_edit');
        $id_jabatan = $this->request->getVar('id_jabatan');
        $status_jabatan_edit = $this->request->getVar('status_jabatan_edit');
        $atasan_langsung_edit = $this->request->getVar('atasan_langsung_edit');
        
        $jabatan = model('jabatan');
        $data_jabatan = $jabatan->where('id_jabatan', $id_jabatan)->first();

        $kode = $data_jabatan['kode_jabatan'];
        $data_edit = [
            'nama'  => $nama,
        ];
        if($kode == 3){
            $direktur = model('direktur');
            $direktur->update($data_jabatan['detail_jabatan'], $data_edit);
        }else if($kode == 4){
            $general_manager = model('general_manager');
            $general_manager->update($data_jabatan['detail_jabatan'], $data_edit);
        }else if($kode == 5){
            $manager = model('manager');
            $manager->update($data_jabatan['detail_jabatan'], $data_edit);
        }else if($kode == 6){
            $supervisor = model('supervisor');
            $supervisor->update($data_jabatan['detail_jabatan'], $data_edit);
        }else{
            $staff = model('staff');
            $staff->update($data_jabatan['detail_jabatan'], $data_edit);
        }

        session()->setFlashdata('pesan', 'Jabatan berhasil diubah');
        return redirect()->to(base_url().'/admin/daftarJabatan/');
    }

    public function  hapusJamKerja($id_jam_kerja)
    {
        $this->jamKerjaModel->where('id_jam_kerja', $id_jam_kerja)->delete();
        session()->setFlashdata('pesan', 'Jam kerja berhasil dihapus');
        return redirect()->to(base_url().'/admin/daftarJamKerja/');
    }
    public function hapusJabatan($id_jabatan)
    {
        $jabatan = model('jabatan');
        $temp_jabatan = $jabatan->where('id_jabatan', $id_jabatan)->first();
        $riwayat_jabatan = model('riwayat_jabatan');
        $temp_riwayat_jabatan = $riwayat_jabatan->where('id_jabatan', $id_jabatan)->findAll();

        if($temp_riwayat_jabatan == null){
            if($temp_jabatan['kode_jabatan'] == 3){
                $direktur = model('direktur');
                $direktur->where('id_direktur', $temp_jabatan['detail_jabatan'])->delete();
                $jabatan->where('id_jabatan', $id_jabatan)->delete();
            }else if($temp_jabatan['kode_jabatan'] == 4){
                $gm = model('general_manager');
                $gm->where('id_gm', $temp_jabatan['detail_jabatan'])->delete();
                $jabatan->where('id_jabatan', $id_jabatan)->delete();
            }else if($temp_jabatan['kode_jabatan'] == 5){
                $manager = model('manager');
                $manager->where('id_manager', $temp_jabatan['detail_jabatan'])->delete();
                $jabatan->where('id_jabatan', $id_jabatan)->delete();
            }else if($temp_jabatan['kode_jabatan'] == 6){
                $supervisor = model('supervisor');
                $supervisor->where('id_supervisor', $temp_jabatan['detail_jabatan'])->delete();
                $jabatan->where('id_jabatan', $id_jabatan)->delete();
            }else if($temp_jabatan['kode_jabatan'] == 7){
                $staff = model('staff');
                $staff->where('id_staff', $temp_jabatan['detail_jabatan'])->delete();
                $jabatan->where('id_jabatan', $id_jabatan)->delete();
            }
            session()->setFlashdata('pesan', 'Jabatan berhasil dihapus');
            return redirect()->to(base_url('/admin/daftarJabatan/'));
        }else{
            session()->setFlashdata('pesan', 'Jabatan tidak bisa dihapus, sudah terpakai di riwayat jabatan pegawai');
            return redirect()->to(base_url('/admin/daftarJabatan/'));
        }
    }

    public function editJamKerja()
    {
        $id = $this->request->getVar('id_jam_kerja');
        $data = [
            'jam_kerja_masuk' => $this->request->getVar('jam_kerja_masuk'),
            'jam_kerja_keluar' => $this->request->getVar('jam_kerja_keluar'),
            'status_aktif' => $this->request->getVar('status_aktif'),
            'status_jam_kerja' => $this->request->getVar('status_jam_kerja')
        ];

        $this->jamKerjaModel->update($id, $data);
        session()->setFlashdata('pesan', 'Jam kerja berhasil diubah');

        return redirect()->to('/admin/daftarJamKerja/');
    }
    public function laporanKinerja(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $this->data['title'] = "Laporan Kinerja";
        $this->data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $data['user']['id_riwayat_jabatan'], 'presensi.tanggal_presensi' => date("Y-m-d")])->first();
        $bulan = model('bulan');
        $this->data['bulan'] = $bulan->findAll();
        return view('laporan/laporan_kinerja_admin', $this->data);
    }
    public function laporanEvaluasi(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $user = model('user');
        $jabatan_a = model('jabatan');
        $this->data['title'] = "Laporan Evaluasi";
        $bulan = model('bulan');
        $this->data['bulan'] = $bulan->findAll();
        $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
            $waktu_mulai = $this->request->getVar('waktu_mulai');
            $waktu_selesai = $this->request->getVar('waktu_selesai');
            $this->data['tanggal_mulai'] = date('d-m-Y', strtotime($waktu_mulai));
            $this->data['tgl_mulai'] = $waktu_mulai;
            $this->data['tgl_selesai'] = $waktu_selesai;
            $this->data['tanggal_selesai'] = date('d-m-Y', strtotime($waktu_selesai));
        }else{
            $this->data['tanggal_mulai'] = null;
        }
        for ($i=0; $i < count($this->data['pegawai']); $i++) { 
            $this->data['pegawai'][$i]['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->findAll();
            // $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->groupBy('tugas.kode_tugas')->orderBy('tugas.id_rancangan_tugas', 'desc')->orderBy('tanggal_tugas', 'asc')->findAll();
            
            // Tambahan
            $rancangan_tugas = model('rancangan_tugas');
            $this->data['pegawai'][$i]['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $this->data['pegawai'][$i]['id_jabatan'])->findAll();
            if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
                $waktu_mulai = $this->request->getVar('waktu_mulai');
                $waktu_selesai = $this->request->getVar('waktu_selesai');
                $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => $waktu_mulai, 'tugas.tanggal_tugas <=' => $waktu_selesai])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
                $this->data['pegawai'][$i]['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0, 'tugas.tanggal_tugas >=' => $waktu_mulai, 'tugas.tanggal_tugas <=' => $waktu_selesai])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();

                $this->data['tanggal_mulai'] = date('d-m-Y', strtotime($waktu_mulai));
                $this->data['tgl_mulai'] = $waktu_mulai;
                $this->data['tgl_selesai'] = $waktu_selesai;
                $this->data['tanggal_selesai'] = date('d-m-Y', strtotime($waktu_selesai));
            }
            else{
                $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
                $this->data['pegawai'][$i]['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();

                $this->data['tanggal_mulai'] = null;
            }
    
            for ($k=0; $k < count($this->data['pegawai'][$i]['rancangan_tugas']); $k++) { 
                $this->data['pegawai'][$i]['rancangan_tugas'][$k]['jumlah_tugas'] = 0;
                for ($j=0; $j < count($this->data['pegawai'][$i]['tugas']); $j++) { 
                    if($this->data['pegawai'][$i]['rancangan_tugas'][$k]['kode_tugas'] == $this->data['pegawai'][$i]['tugas'][$j]['kode_tugas']){
                        $this->data['pegawai'][$i]['rancangan_tugas'][$k]['jumlah_tugas'] += intval($this->data['pegawai'][$i]['tugas'][$j]['jumlah_tugas']);
                    } 
                }
            }

            for ($k=0; $k < count($this->data['pegawai'][$i]['tugas_tambahan']); $k++) { 
                $data = [
                    'id_rancangan_tugas' => 0,
                    'id_jabatan' => $this->data['pegawai'][$i]['id_jabatan'],
                    'nama_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['nama_tugas'],
                    'periode' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['periode'],
                    'jumlah_total_tugas' => 0,
                    'nomor_pekerjaan' => 0,
                    'status_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['status_tugas'],
                    'kode_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['kode_tugas'],
                    'jumlah_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['jumlah_tugas']
                ];
                array_push($this->data['pegawai'][$i]['rancangan_tugas'], $data);
            }
            // Selesai
            
            
            if($this->data['pegawai'][$i]['id_status_user'] == 3){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 4){
                $this->data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 5){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 6){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 7){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $this->data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $this->data['pegawai'][$i]['jabatan']['nama'] = "";
            }
            $this->data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai'][$i]['id_status_user'], $this->data['pegawai'][$i]['detail_jabatan']);
        }
        // dd($this->data);
        return view('laporan/laporan_evaluasi_admin', $this->data);
    }
    public function exportLaporanEvaluasiAdmin(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $user = model('user');
        $jabatan_a = model('jabatan');
        $this->data['title'] = "Laporan Evaluasi";
        $bulan = model('bulan');
        $this->data['bulan'] = $bulan->findAll();
        if(session('id_status_user') != 1){
            $riwayat_jabatan = model('riwayat_jabatan');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->where('riwayat_jabatan.status_aktif', 1)->first();
            $jabatan = model('jabatan');
            $jumlah_bawahan = 0;
            $id_jabatan_bawahan = [];
            if(session('id_status_user') == 3){
                $general_manager = model('general_manager');
                $kode_bawahan = $general_manager->where('id_direktur', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 4)->where('detail_jabatan', $kode_bawahan[$i]['id_gm'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,gm.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
            }else if(session('id_status_user') == 4){
                $manager = model('manager');
                $kode_bawahan = $manager->where('id_manager', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 5)->where('detail_jabatan', $kode_bawahan[$i]['id_manager'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,m.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
            }else if(session('id_status_user') == 5){
                $supervisor = model('supervisor');
                $kode_bawahan = $supervisor->where('id_manager', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 6)->where('detail_jabatan', $kode_bawahan[$i]['id_supervisor'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,s.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
        
            }else if(session('id_status_user') == 6){
                $staff = model('staff');
                $kode_bawahan = $staff->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 7)->where('detail_jabatan', $kode_bawahan[$i]['id_staff'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,s.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
            }
            
            $pegawai = [];
            array_push($pegawai, $data['user']['no_induk']);
            for ($i=0; $i < count($data['staff_bawahan']); $i++) { 
                array_push($pegawai, $data['staff_bawahan'][$i]['no_induk']);
            }
    
            $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->whereIn('user.no_induk', $pegawai)->orderBy('jabatan.id_jabatan')->findAll();
        }else{
            $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        }
        if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
            $waktu_mulai = $this->request->getVar('waktu_mulai');
            $waktu_selesai = $this->request->getVar('waktu_selesai');
            $this->data['tanggal_mulai'] = date('d-m-Y', strtotime($waktu_mulai));
            $this->data['tgl_mulai'] = $waktu_mulai;
            $this->data['tgl_selesai'] = $waktu_selesai;
            $this->data['tanggal_selesai'] = date('d-m-Y', strtotime($waktu_selesai));
        }else{
            $this->data['tanggal_mulai'] = null;
        }
        for ($i=0; $i < count($this->data['pegawai']); $i++) { 
            $this->data['pegawai'][$i]['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->findAll();
            // $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->groupBy('tugas.kode_tugas')->orderBy('tugas.id_rancangan_tugas', 'desc')->orderBy('tanggal_tugas', 'asc')->findAll();
            
            // Tambahan
            $rancangan_tugas = model('rancangan_tugas');
            $this->data['pegawai'][$i]['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $this->data['pegawai'][$i]['id_jabatan'])->findAll();
            if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
                $waktu_mulai = $this->request->getVar('waktu_mulai');
                $waktu_selesai = $this->request->getVar('waktu_selesai');
                $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.tanggal_tugas >=' => $waktu_mulai, 'tugas.tanggal_tugas <=' => $waktu_selesai])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
                $this->data['pegawai'][$i]['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0, 'tugas.tanggal_tugas >=' => $waktu_mulai, 'tugas.tanggal_tugas <=' => $waktu_selesai])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();

                $this->data['tanggal_mulai'] = date('d-m-Y', strtotime($waktu_mulai));
                $this->data['tgl_mulai'] = $waktu_mulai;
                $this->data['tgl_selesai'] = $waktu_selesai;
                $this->data['tanggal_selesai'] = date('d-m-Y', strtotime($waktu_selesai));
            }
            else{
                $this->data['pegawai'][$i]['tugas'] =  $tugas->asArray()->select('id_tugas, id_riwayat_jabatan, tugas.nama_tugas, tanggal_tugas, tugas.periode, tugas.jumlah_tugas, tugas.nomor_pekerjaan, tugas.status_tugas, tugas.id_rancangan_tugas, rancangan_tugas.jumlah_total_tugas, tugas.kode_tugas')->selectSum('tugas.jumlah_tugas')->join('rancangan_tugas', 'rancangan_tugas.id_rancangan_tugas = tugas.id_rancangan_tugas')->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan']])->groupBy("tugas.kode_tugas")->orderBy('tugas.id_rancangan_tugas', 'DESC')->findAll();
                $this->data['pegawai'][$i]['tugas_tambahan'] = $tugas->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tugas.id_rancangan_tugas' => 0])->groupBy("tugas.kode_tugas")->orderBy('tugas.tanggal_tugas', 'DESC')->findAll();

                $this->data['tanggal_mulai'] = null;
            }
    
            for ($k=0; $k < count($this->data['pegawai'][$i]['rancangan_tugas']); $k++) { 
                $this->data['pegawai'][$i]['rancangan_tugas'][$k]['jumlah_tugas'] = 0;
                for ($j=0; $j < count($this->data['pegawai'][$i]['tugas']); $j++) { 
                    if($this->data['pegawai'][$i]['rancangan_tugas'][$k]['kode_tugas'] == $this->data['pegawai'][$i]['tugas'][$j]['kode_tugas']){
                        $this->data['pegawai'][$i]['rancangan_tugas'][$k]['jumlah_tugas'] += intval($this->data['pegawai'][$i]['tugas'][$j]['jumlah_tugas']);
                    } 
                }
            }

            for ($k=0; $k < count($this->data['pegawai'][$i]['tugas_tambahan']); $k++) { 
                $data = [
                    'id_rancangan_tugas' => 0,
                    'id_jabatan' => $this->data['pegawai'][$i]['id_jabatan'],
                    'nama_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['nama_tugas'],
                    'periode' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['periode'],
                    'jumlah_total_tugas' => 0,
                    'nomor_pekerjaan' => 0,
                    'status_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['status_tugas'],
                    'kode_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['kode_tugas'],
                    'jumlah_tugas' => $this->data['pegawai'][$i]['tugas_tambahan'][$k]['jumlah_tugas']
                ];
                array_push($this->data['pegawai'][$i]['rancangan_tugas'], $data);
            }
            // Selesai
            
            
            if($this->data['pegawai'][$i]['id_status_user'] == 3){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 4){
                $this->data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 5){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 6){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 7){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $this->data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $this->data['pegawai'][$i]['jabatan']['nama'] = "";
            }
            $this->data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai'][$i]['id_status_user'], $this->data['pegawai'][$i]['detail_jabatan']);
        }
        // dd($this->data);
        return view('laporan/export_laporan_evaluasi_admin', $this->data);
    }
    public function laporanKeaktifan(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $bulan = model('bulan');
        $user = model('user');
        $jabatan_a = model('jabatan');
        $batas_penanggalan = model('batas_penanggalan');
        $thn = date('Y');
        $bln = date('m');
        if($this->request->getVar('tahun') != "" && $this->request->getVar('bulan') != ""){
            $thn = $this->request->getVar('tahun');
            $bln = $this->request->getVar('bulan');
            if(intval($bln) < 10){
                $bln = '0'.$bln;
            }
        }
        $this->data['title'] = "Laporan Keaktifan Pegawai";
        $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        for ($i=0; $i < count($this->data['pegawai']); $i++) { 
            $this->data['pegawai'][$i]['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tanggal_presensi >=' => $thn.'-'.$bln.'-01', 'tanggal_presensi <=' => $thn.'-'.$bln.'-31'])->findAll();
            if($this->data['pegawai'][$i]['id_status_user'] == 3){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 4){
                $this->data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 5){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 6){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 7){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $this->data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $this->data['pegawai'][$i]['jabatan']['nama'] = "";
            }
            $this->data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai'][$i]['id_status_user'], $this->data['pegawai'][$i]['detail_jabatan']);
        }

        $this->data['t'] = $thn;
        $this->data['bb'] = $bln;
        // DB
        // $data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        // Manual
        $tanggal_mulai = $thn.'-'.$bln.'-01';
        $batas = date('t', strtotime($thn.'-'.$bln.'-01'));
        $this->data['jumlah_tanggal'] = intval($batas);

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
        $this->data['weekend'] = $weekend;

        $this->data['bulan'] = $bulan->findAll();
        $this->data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        $this->data['tahun'] = $thn;
        $temp_bulan = $bulan->where('id_bulan', intval($bln))->first();
        $this->data['bln'] = $temp_bulan['nama_bulan'];
        // dd($this->data);
        return view('laporan/laporan_keaktifan_admin', $this->data);
    }
    public function exportLaporanKeaktifanAdmin(){
        $presensi = model('presensi');
        $tugas = model('tugas');
        $bulan = model('bulan');
        $user = model('user');
        $jabatan_a = model('jabatan');
        $batas_penanggalan = model('batas_penanggalan');
            $thn = $this->request->getVar('tahun');
            $bln = intval($this->request->getVar('bulan'));
            if(intval($bln) < 10){
                $bln = '0'.$bln;
            }
        $this->data['title'] = "Laporan Keaktifan Pegawai";
        if(session('id_status_user') != 1){
            $riwayat_jabatan = model('riwayat_jabatan');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->where('riwayat_jabatan.status_aktif', 1)->first();
            $jabatan = model('jabatan');
            $jumlah_bawahan = 0;
            $id_jabatan_bawahan = [];
            if(session('id_status_user') == 3){
                $general_manager = model('general_manager');
                $kode_bawahan = $general_manager->where('id_gm', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 4)->where('detail_jabatan', $kode_bawahan[$i]['id_gm'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,gm.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('general_manager as gm', 'gm.id_gm=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
        
            }else if(session('id_status_user') == 4){
                $manager = model('manager');
                $kode_bawahan = $manager->where('id_manager', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 5)->where('detail_jabatan', $kode_bawahan[$i]['id_manager'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,m.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('manager as m', 'm.id_manager=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
        
            }else if(session('id_status_user') == 5){
                $supervisor = model('supervisor');
                $kode_bawahan = $supervisor->where('id_manager', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 6)->where('detail_jabatan', $kode_bawahan[$i]['id_supervisor'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,s.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('supervisor as s', 's.id_supervisor=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
        
            }else if(session('id_status_user') == 6){
                $staff = model('staff');
                $kode_bawahan = $staff->where('id_supervisor', $data['user']['detail_jabatan'])->findAll();
                for ($i=0; $i < count($kode_bawahan); $i++) { 
                    $temp_jabatan = $jabatan->where('kode_jabatan', 7)->where('detail_jabatan', $kode_bawahan[$i]['id_staff'])->first();
                    $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
                    array_push($id_jabatan_bawahan, $temp_jabatan['id_jabatan']);
                }
                $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,su.*,s.nama as nama_jabatan, riwayat_jabatan.*')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->whereIn('jabatan.id_jabatan', $id_jabatan_bawahan)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->join('status_user as su', 'su.id_status_user=u.id_status_user', 'left')->findAll();
        
            }
            
            $pegawai = [];
            array_push($pegawai, $data['user']['no_induk']);
            for ($i=0; $i < count($data['staff_bawahan']); $i++) { 
                array_push($pegawai, $data['staff_bawahan'][$i]['no_induk']);
            }
    
            $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->whereIn('user.no_induk', $pegawai)->orderBy('jabatan.id_jabatan')->findAll();
        }else{
            $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        }

        for ($i=0; $i < count($this->data['pegawai']); $i++) { 
            $this->data['pegawai'][$i]['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai'][$i]['id_riwayat_jabatan'], 'tanggal_presensi >=' => $thn.'-'.$bln.'-01', 'tanggal_presensi <=' => $thn.'-'.$bln.'-31'])->findAll();
            if($this->data['pegawai'][$i]['id_status_user'] == 3){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 4){
                $this->data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 5){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 6){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 7){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $this->data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $this->data['pegawai'][$i]['jabatan']['nama'] = "";
            }
            $this->data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai'][$i]['id_status_user'], $this->data['pegawai'][$i]['detail_jabatan']);
        }

        $this->data['t'] = $thn;
        $this->data['bb'] = $bln;
        // DB
        // $data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        // Manual
        $tanggal_mulai = $thn.'-'.$bln.'-01';
        $batas = date('t', strtotime($thn.'-'.$bln.'-01'));
        $this->data['jumlah_tanggal'] = intval($batas);

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
        $this->data['weekend'] = $weekend;

        $this->data['bulan'] = $bulan->findAll();
        $this->data['batas_tanggal'] = $batas_penanggalan->where(['tahun' => $thn, 'bulan' => intval($bln)])->first();
        $this->data['tahun'] = $thn;
        $temp_bulan = $bulan->where('id_bulan', intval($bln))->first();
        $this->data['bln'] = $temp_bulan['nama_bulan'];
        // dd($this->data);
        return view('laporan/export_laporan_keaktifan_admin', $this->data);
    }

    public function rekapitulasiPresensi(){
        $user = model('user');
        $jabatan_a = model('jabatan');
        $batas_penanggalan = model('batas_penanggalan');
        $this->data['title'] = "Laporan Rekapitulasi Presensi";
        $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->whereNotIn('user.id_status_user', [1, 2])->orderBy('jabatan.id_jabatan')->findAll();
        for ($i=0; $i < count($this->data['pegawai']); $i++) { 
            if($this->data['pegawai'][$i]['id_status_user'] == 3){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Direktur";
                $jabatan = model('direktur');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_direktur', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 4){
                $this->data['pegawai'][$i]['nama_jabatan'] = "General Manager";
                $jabatan = model('general_manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_gm', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 5){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Manager";
                $jabatan = model('manager');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_manager', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 6){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_supervisor', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else if($this->data['pegawai'][$i]['id_status_user'] == 7){
                $this->data['pegawai'][$i]['nama_jabatan'] = "Staff";
                $jabatan = model('staff');
                $this->data['pegawai'][$i]['jabatan'] = $jabatan->where('id_staff', $this->data['pegawai'][$i]['detail_jabatan'])->first();
            }else{
                $this->data['pegawai'][$i]['nama_jabatan'] = "Tidak Ada Jabatan";
                $this->data['pegawai'][$i]['jabatan']['nama'] = "";
            }
            $this->data['pegawai'][$i]['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai'][$i]['id_status_user'], $this->data['pegawai'][$i]['detail_jabatan']);
        }
        return view('laporan/rekapitulasi_presensi', $this->data);
    }
    public function rekapitulasiPresensiDetail(){
        $pegawai = $this->request->getVar('pegawai');
        $waktu_mulai = $this->request->getVar('waktu_mulai');
        $waktu_selesai = $this->request->getVar('waktu_selesai');
        $this->data['input'] = ['pegawai'=>$pegawai, 'waktu_mulai'=>$waktu_mulai, 'waktu_selesai'=>$waktu_selesai];
        $user = model('user');
        $jabatan_a = model('jabatan');
        $jam_kerja = model('jam_kerja');
        $presensi = model('presensi');
        $this->data['title'] = "Laporan Rekapitulasi Presensi";
        $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', $pegawai)->first();
        $this->data['pegawai']['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai']['id_status_user'], $this->data['pegawai']['detail_jabatan']);
        $this->data['pegawai']['jabatan'] = $jabatan_a->getJabtan($this->data['pegawai']['id_status_user'], $this->data['pegawai']['detail_jabatan']);
        $this->data['tanggal_mulai'] = $this->getTanggal($waktu_mulai);
        $this->data['tanggal_selesai'] = $this->getTanggal($waktu_selesai);
        $this->data['tgl_mulai'] = $waktu_mulai;
        $this->data['tgl_selesai'] = $waktu_selesai;
        $this->data['jam_kerja'] = $jam_kerja->where('id_jabatan', $this->data['pegawai']['id_jabatan'])->first();
        $this->data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai']['id_riwayat_jabatan'], 'presensi.tanggal_presensi >=' => $waktu_mulai, 'presensi.tanggal_presensi <=' => $waktu_selesai])->orderBy('tanggal_presensi', 'asc')->findAll();
        // for($i = 0; $i < count($this->data['presensi']); $i++){
        //     $this->data['presensi'][$i]['tanggal'] = $this->getTanggal($this->data['presensi'][$i]['tanggal_presensi']);
        // }

        $hadir = [];
        $izin = [];
        for ($i=0; $i < count($this->data['presensi']); $i++) { 
            if($this->data['presensi'][$i]['status_presensi'] == 0){
                array_push($hadir, $this->data['presensi'][$i]['tanggal_presensi']);
            }else{
                array_push($izin, $this->data['presensi'][$i]['tanggal_presensi']);
            }
        }
        $this->data['hadir'] = $hadir;
        $this->data['izin'] = $izin;


        // Weekend
        $weekend = [];
        $sabtu_pertama = date('Y-m-d', strtotime('saturday '.$waktu_mulai));
        $minggu_pertama = date('Y-m-d', strtotime('sunday '.$waktu_mulai));
        $sabtu_terakhir = date('Y-m-d', strtotime('saturday '.$waktu_selesai));
        $minggu_terakhir = date('Y-m-d', strtotime('sunday '.$waktu_selesai));
        $sabtu = $sabtu_pertama;
        $minggu = $minggu_pertama;
        array_push($weekend, $sabtu);
        array_push($weekend, $minggu);
        while($minggu != $minggu_terakhir){
            $sabtu_selanjutnya = date('Y-m-d', strtotime('next saturday '.$sabtu));
            $minggu_selanjutnya = date('Y-m-d', strtotime('next sunday '.$minggu));
            array_push($weekend, $sabtu_selanjutnya);
            array_push($weekend, $minggu_selanjutnya);
            $sabtu = $sabtu_selanjutnya;
            $minggu = $minggu_selanjutnya;
        }
        
        // dd($weekend);
        $this->data['weekend'] = $weekend;

        // dd($this->data);

        return view('laporan/rekapitulasi_presensi_detail', $this->data);
    }
    public function exportLaporanRekapAdmin(){
        $pegawai = $this->request->getVar('pegawai');
        $waktu_mulai = $this->request->getVar('waktu_mulai');
        $waktu_selesai = $this->request->getVar('waktu_selesai');
        $this->data['input'] = ['pegawai'=>$pegawai, 'waktu_mulai'=>$waktu_mulai, 'waktu_selesai'=>$waktu_selesai];
        $user = model('user');
        $jabatan_a = model('jabatan');
        $jam_kerja = model('jam_kerja');
        $presensi = model('presensi');
        $this->data['title'] = "Laporan Rekapitulasi Presensi";
        $this->data['pegawai'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', $pegawai)->first();
        $this->data['pegawai']['unit_kerja'] = $jabatan_a->getUnitKerja($this->data['pegawai']['id_status_user'], $this->data['pegawai']['detail_jabatan']);
        $this->data['pegawai']['jabatan'] = $jabatan_a->getJabtan($this->data['pegawai']['id_status_user'], $this->data['pegawai']['detail_jabatan']);
        $this->data['tanggal_mulai'] = $this->getTanggal($waktu_mulai);
        $this->data['tanggal_selesai'] = $this->getTanggal($waktu_selesai);
        $this->data['tgl_mulai'] = $waktu_mulai;
        $this->data['tgl_selesai'] = $waktu_selesai;
        $this->data['jam_kerja'] = $jam_kerja->where('id_jabatan', $this->data['pegawai']['id_jabatan'])->first();
        $this->data['presensi'] = $presensi->asArray()->where(['id_riwayat_jabatan' => $this->data['pegawai']['id_riwayat_jabatan'], 'presensi.tanggal_presensi >=' => $waktu_mulai, 'presensi.tanggal_presensi <=' => $waktu_selesai])->orderBy('tanggal_presensi', 'asc')->findAll();
        // for($i = 0; $i < count($this->data['presensi']); $i++){
        //     $this->data['presensi'][$i]['tanggal'] = $this->getTanggal($this->data['presensi'][$i]['tanggal_presensi']);
        // }

        $hadir = [];
        $izin = [];
        for ($i=0; $i < count($this->data['presensi']); $i++) { 
            if($this->data['presensi'][$i]['status_presensi'] == 0){
                array_push($hadir, $this->data['presensi'][$i]['tanggal_presensi']);
            }else{
                array_push($izin, $this->data['presensi'][$i]['tanggal_presensi']);
            }
        }
        $this->data['hadir'] = $hadir;
        $this->data['izin'] = $izin;


        // Weekend
        $weekend = [];
        $sabtu_pertama = date('Y-m-d', strtotime('saturday '.$waktu_mulai));
        $minggu_pertama = date('Y-m-d', strtotime('sunday '.$waktu_mulai));
        $sabtu_terakhir = date('Y-m-d', strtotime('saturday '.$waktu_selesai));
        $minggu_terakhir = date('Y-m-d', strtotime('sunday '.$waktu_selesai));
        $sabtu = $sabtu_pertama;
        $minggu = $minggu_pertama;
        array_push($weekend, $sabtu);
        array_push($weekend, $minggu);
        while($minggu != $minggu_terakhir){
            $sabtu_selanjutnya = date('Y-m-d', strtotime('next saturday '.$sabtu));
            $minggu_selanjutnya = date('Y-m-d', strtotime('next sunday '.$minggu));
            array_push($weekend, $sabtu_selanjutnya);
            array_push($weekend, $minggu_selanjutnya);
            $sabtu = $sabtu_selanjutnya;
            $minggu = $minggu_selanjutnya;
        }
        
        // dd($weekend);
        $this->data['weekend'] = $weekend;

        // dd($this->data);

        return view('laporan/export_rekapitulasi_presensi', $this->data);
    }

    public function exportDaftarSaran(){
        $this->data['title'] = 'Daftar Saran';
        if($this->request->getVar('waktu_mulai') != "" && $this->request->getVar('waktu_selesai') != ""){
            $waktu_mulai = $this->request->getVar('waktu_mulai');
            $waktu_selesai = $this->request->getVar('waktu_selesai');
            $this->data['saran'] = $this->feedbackUserModel->getFeedback($waktu_mulai, $waktu_selesai);
            $this->data['waktu_mulai'] = $waktu_mulai;
            $this->data['waktu_selesai'] = $waktu_selesai;
        }else{
            $this->data['saran'] = $this->feedbackUserModel->getFeedback();
            $this->data['waktu_mulai'] = null;
            $this->data['waktu_selesai'] = null;
        }

        return view('laporan/export_daftar_saran', $this->data);
    }
}