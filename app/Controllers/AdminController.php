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
        $this->data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $this->data['kategori_menu'] = $kategori->findAll();
        $this->data['user'] = $this->userModel->getUser(session('no_induk'));
        $this->data['validation'] =  \Config\Services::validation();
    }


    public function index()
    {
        $this->data['title'] =  'Dashboard Admin';
        return view('dashboard_admin', $this->data);
    }

    public function managementUsers()
    {
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
        if ($file->move(FCPATH . 'assets/images/users/')) {
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
        return redirect()->to('/admin/managementUsers');
    }

    public function deleteUser($no_induk)
    {
        $this->userModel->delete($no_induk);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/admin/managementUsers');
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
            $file->move(FCPATH . 'assets/images/users/');
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
        return redirect()->to('/admin/managementUsers');
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
            return redirect()->to('/admin/managementUsers');
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
        $this->data['saran'] = $this->feedbackUserModel->getFeedback();

        return view('admin/daftarSaran', $this->data);

        dd($this->data['saran']);
    }

    public function profil()
    {
        $this->data['title'] = 'Daftar Saran';
        return view('admin/profilAdmin', $this->data);
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
        $file->move(FCPATH . 'assets/images/users/');
        $name_file = '/assets/images/users/' . $file->getName();
        $data = [
            'foto_profil' => $name_file
        ];
        $this->userModel->update($no_induk, $data);
        session()->setFlashdata('pesan', 'Foto profil berhasil diubah');
        return redirect()->to('/admin/profil');
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
            return redirect()->to('/admin/indeksKepuasan');
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
            return redirect()->to('/admin/indeksKepuasan');
        }
    }

    public function hapusIndeksPertanyaan($id_pertanyaan, $id_indeks)
    {

        $this->indeksNilaiModel->where('id_pertanyaan', $id_pertanyaan)->delete();
        $this->indeksPertanyaanModel->where('id_pertanyaan', $id_pertanyaan)->delete();
        session()->setFlashdata('pesan', 'Pertanyaan berhasil dihapus');
        return redirect()->to('/admin/editIndeksKepuasan/' . $id_indeks);
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
        return redirect()->to('/admin/indeksKepuasan');
    }

    public function penilaianKinerja()
    {
        $this->data['title'] = 'Penilaian Kinerja';
        $this->data['penilaian'] = $this->penilaianKinerjaModel->orderBy('id_pk', 'DESC')->findAll();

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

        $id = $this->penilaianKinerjaModel->insert($data);

        if ($this->request->getVar('jenis_penilaian') != 0) {
            $pertanyaan = $this->pertanyaanpkModel->where('id_pk', $this->request->getVar('jenis_penilaian'))->findAll();
            $duplicate = [];
            $indek = 0;
            foreach ($pertanyaan as $p) {
                $duplicate[$indek++] = [
                    'pertanyaan_pk' => $p['pertanyaan_pk'],
                    'id_pk' => $id
                ];
            }

            $this->pertanyaanpkModel->insertBatch($duplicate);
        }
        session()->setFlashdata('pesan', 'Penilaian kinerja pegawai berhasil ditambah!');
        return redirect()->to('/admin/penilaianKinerja');
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
        return redirect()->to('/admin/penilaianKinerja');
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
            return redirect()->to('/admin/penilaianKinerja');
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
        return redirect()->to('/admin/editPenilaianKinerja/' . $id_pk);
    }

    public function hasilPenilaianKinerja($id_pk)
    {
        $this->data['title'] = 'Hasil Penilaian Kinerja';
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
        return redirect()->to('/admin/daftarPengumuman');
    }

    public function hapusPengumuman()
    {
        $id_pengumuman = $this->request->getVar('id_pengumuman');
        $this->pengumumanModel->where('id_pengumuman', $id_pengumuman)->delete();
        session()->setFlashdata('pesan', 'Data pengumuman berhasil dihapus');
        return redirect()->to('/admin/daftarPengumuman');
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
        return redirect()->to('/admin/daftarPengumuman');
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
            'jumlah_tugas' => $this->request->getVar('jumlah_tugas'),
            'nomor_pekerjaan' => $this->request->getVar('nomor_pekerjaan'),
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
            'jumlah_tugas' => $this->request->getVar('jumlah_tugas'),
            'nomor_pekerjaan' => $this->request->getVar('nomor_pekerjaan'),
        ];

        $this->rancanganTugasModel->update($id_rancangan_tugas, $data);
        echo json_encode($data);
    }

    public function hapusRancanganTugas($id_rancangan_tugas, $id_jabatan)
    {
        $this->rancanganTugasModel->where('id_rancangan_tugas', $id_rancangan_tugas)->delete();
        session()->setFlashdata('pesan', 'Data rancangan tugas berhasil dihapus');
        return redirect()->to('/admin/lihatRancanganTugas/' . $id_jabatan);
    }

    public function apiDetailJabatan($id_status_user)
    {
        $data = $this->jabatanModel->getDaftarJabatan($id_status_user);
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
        return redirect()->to('/admin/settingPekerjaan/' . $no_induk);
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
        return redirect()->to('/admin/settingPekerjaan/' . $no_induk);
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
        return redirect()->to('/admin/settingPekerjaan/' . $no_induk);
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
            return redirect()->to('/admin/settingPekerjaan/' . $no_induk);
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
            return redirect()->to('/admin/settingPekerjaan/' . $no_induk);
        }
    }



    public function daftarJamKerja()
    {
        $this->data['title'] = 'Management Jam Kerja';
        $this->data['jam_kerja']  = $this->jamKerjaModel->getJamKerja();
        $this->data['status_user'] = $this->statusUserModel->whereNotIn('id_status_user', [1, 2])->findAll();
        //dd($this->data['jam_kerja']);
        return view('admin/daftarJamKerja', $this->data);
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
        return redirect()->to('/admin/daftarJamKerja/');
    }

    public function  hapusJamKerja($id_jam_kerja)
    {
        $this->jamKerjaModel->where('id_jam_kerja', $id_jam_kerja)->delete();
        session()->setFlashdata('pesan', 'Jam kerja berhasil dihapus');
        return redirect()->to('/admin/daftarJamKerja/');
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
}
