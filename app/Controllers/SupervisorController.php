<?php

namespace App\Controllers;

use PDO;
use App\Models\nilai_pk;

class SupervisorController extends BaseController
{
    protected $nilaipkModel;

    public function index()
    {
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

        // for ($i = 0; $i < count($kode_bawahan); $i++) {
        //     $temp_jabatan = $jabatan->where('kode_jabatan', 6)->where('detail_jabatan', $kode_bawahan[$i]['id_staff'])->first();
        //     $temp = count($riwayat_jabatan->where('id_jabatan', $temp_jabatan['id_jabatan'])->findAll());
        //     $jumlah_bawahan += $temp;
        // }
        $data['jumlah_bawahan'] = 0;
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        $data['pengumuman'] = $pengumuman->join('user', 'pengumuman.publisher = user.no_induk')->findAll();

        return view('dashboard_atasan', $data);
    }

    public function profil()
    {
        $data['title'] = "Profil Pegawai";
        if (!$this->validate([
            'nama' => 'required',
            'nip'  => 'required',
            'email'  => 'required',
            'no_telepon'  => 'required',
            'alamat'  => 'required',
        ])) {
            $menu = model('menu');
            $kategori = model('kategori_menu');
            $user = model('user');
            $rancangan_tugas = model('rancangan_tugas');
            $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
            $data['rancangan_tugas'] = $rancangan_tugas->where('id_jabatan', $data['user']['id_jabatan'])->findAll();
            $jumlah_tugas_berlangsung = 0;
            $jumlah_total_tugas = 0;
            for ($i = 0; $i < count($data['rancangan_tugas']); $i++) {
                $jumlah_total_tugas += intval($data['rancangan_tugas'][$i]['jumlah_tugas']);
            }
            $data['jumlah_total_tugas'] =  $jumlah_total_tugas;
            $data['jumlah_tugas_berlangsung'] = $jumlah_tugas_berlangsung;
            if ($data['user']['id_jabatan'] == 6) {
                $data['user']['nama_jabatan'] = "Supervisor";
                $jabatan = model('supervisor');
                $data['user']['jabatan'] = $jabatan->where('id_supervisor', $data['user']['detail_jabatan'])->first();
            }
            // dd($data['user']);
            $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
            $data['kategori_menu'] = $kategori->findAll();
            return view('profil', $data);
        } else {
            $no_induk = $this->request->getPost('nip');
            $profil = [
                'nama' => $this->request->getPost('nama'),
                'email'  => $this->request->getPost('email'),
                'no_telepon'  => $this->request->getPost('no_telepon'),
                'alamat'  => $this->request->getPost('alamat'),
            ];
            $user = model('user');
            $user->update($no_induk, $profil);
            return redirect()->to(base_url() . '/supervisor/profil');
        }
    }

    public function presensi()
    {
        $data['title'] = "Presensi Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        if ($data['user']['id_jabatan'] == 6) {
            $data['user']['nama_jabatan'] = "Supervisor";
            $jabatan = model('supervisor');
            $data['user']['jabatan'] = $jabatan->where('id_supervisor', $data['user']['detail_jabatan'])->first();
        }
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('presensi', $data);
    }

    public function logbook()
    {
        $data['title'] = "Logbook Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('logbook', $data);
    }

    public function capaianKerja()
    {
        $data['title'] = "Capaian Kerja Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $pk = model('penilaian_kinerja');
        $riwayat_jabatan = model('riwayat_jabatan');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();

        $data['staff_bawahan'] = $riwayat_jabatan->select('u.*,s.nama as nama_jabatan')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan', 'left')->where('jabatan.id_jabatan', 7)->join('staff as s', 's.id_staff=jabatan.detail_jabatan', 'left')->where('id_supervisor', $data['user']['detail_jabatan'])->join('user as u', 'u.no_induk=riwayat_jabatan.no_induk', 'left')->findAll();

        $data['penilaian_kinerja'] = $pk->where('status_pk', 1)->first();

        return view('capaian_kerja_atasan', $data);
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




    public function saran()
    {
        $data['title'] = "Saran";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $kategori_saran = model('kategori_feedback');
        $data['kategori_saran'] = $kategori_saran->findAll();
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('saran', $data);
    }

    public function klarifikasi()
    {
        $data['title'] = "Klarifikasi Tugas";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('klarifikasi', $data);
    }

    public function indeksKepuasan()
    {
        $data['title'] = "Indeks Kepuasan Pegawai";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('indeks_kepuasan', $data);
    }

    public function validasi()
    {
        $data['title'] = "Validasi Logbook";
        $menu = model('menu');
        $kategori = model('kategori_menu');
        $user = model('user');
        $data['user'] = $user->join('riwayat_jabatan', 'riwayat_jabatan.no_induk = user.no_induk')->join('jabatan', 'riwayat_jabatan.id_jabatan = jabatan.id_jabatan')->where('user.no_induk', session('no_induk'))->first();
        $data['menu'] = $menu->where('status_user', session('id_status_user'))->findAll();
        $data['kategori_menu'] = $kategori->findAll();
        return view('validasi', $data);
    }
}
