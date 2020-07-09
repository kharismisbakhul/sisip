<?php

namespace App\Controllers;

use App\Models\user;
use App\Models\status_user;
use App\Models\feedback;
use App\Models\indeksKepuasan;
use App\Models\indeksPertanyaan;
use App\Models\indeksNilai;

class AdminController extends BaseController
{

    protected $userModel;
    protected $statusUserModel;
    protected $feedbackUserModel;
    protected $indeksModel;
    protected $indeksPertanyaanModel;
    protected $indeksNilaiModel;
    protected $data = [];
    public function __construct()
    {
        $this->userModel = new user();
        $this->statusUserModel = new status_user();
        $this->feedbackUserModel = new feedback();
        $this->indeksModel = new indeksKepuasan();
        $this->indeksPertanyaanModel = new indeksPertanyaan();
        $this->indeksNilaiModel = new indeksNilai();
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $this->data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $this->data['kategori_menu'] = $kategori->findAll();
        $this->data['user'] = $this->userModel->getUser(session('no_induk'));
        $pesan = model('pesan');
        $this->data['chat']  = $pesan->asArray()->join('user', 'user.no_induk = pesan.user')->orderBy('waktu', 'asc')->orderBy('tanggal', 'asc')->findAll();

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
        $this->data['validation'] =  \Config\Services::validation();
        return view('admin/tambahUser', $this->data);
    }

    public function saveUser()
    {
        // In the controller
        if (!$this->validate([
            'nama' => 'required',
            'no_induk' => 'required|is_unique[user.no_induk]',
            'tahun_masuk' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'status_user' => 'required',
            'foto_profil' => 'uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,png]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/admin/tambahUser')->withInput()->with('validation', $validation);
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
            $role2 = 'required';
        } else {
            $role2 =  'required|is_unique[user.no_induk]';
        }
        $validation = \Config\Services::validation();

        if ($file->getName()) {
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
                return redirect()->to(base_url().'/admin/ubahUser/' . $no_induk)->withInput()->with('validation', $validation);
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
                return redirect()->to(base_url().'/admin/ubahUser/' . $no_induk)->withInput()->with('validation', $validation);
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
        $this->data['title'] =  'Setting Pekerjaan Users';
        $this->data['validation'] =  \Config\Services::validation();
        $this->data['u'] = $this->userModel->getUser($no_induk);

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
        return redirect()->to(base_url().'/admin/indeksKepuasan');
    }

    public function editIndeksKepuasan($id)
    {

        $this->data['title'] = 'Edit Indeks Kepuasan';
        $this->data['pertanyaan'] = $this->indeksPertanyaanModel->getPertanyaan($id);
        $this->data['indeks'] = $this->indeksModel->where(['id' => $id])->first();
        return view('admin/editIndeksKepuasan', $this->data);
    }

    public function tambahIndeksPertanyaan()
    {
        $data = [
            'pertanyaan' => $this->request->getVar('pertanyaan'),
            'id_indeks' => $this->request->getVar('id_indeks'),
        ];

        $this->indeksPertanyaanModel->insert($data);
        session()->setFlashdata('pesan', 'Pertanyaan berhasil ditambah');
        return redirect()->to(base_url().'/admin/editIndeksKepuasan/' . $this->request->getVar('id_indeks'));
    }

    public function editIndeksPertanyaan($id_pertanyaan)
    {
        $data = [
            'pertanyaan' => $this->request->getVar('pertanyaan')
        ];

        $this->indeksPertanyaanModel->update($id_pertanyaan, $data);
        session()->setFlashdata('pesan', 'Pertanyaan berhasil diubah');
        return redirect()->to(base_url().'/admin/editIndeksKepuasan/' . $this->request->getVar('id_indeks'));
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
}