<?php namespace App\Models;

use CodeIgniter\Model;

class penilaian_kinerja extends Model
{
    protected $table      = 'penilaian_kinerja';
    protected $primaryKey = 'id_pk';

    protected $useTimestamps = false;
    protected $allowedFields = ['id_pk', 'nama_pk', 'tanggal_pk', 'status_pk'];

    public function jumlahRespond($id_pk)
    {
        $data = $this->select('id_pemberi_nilai')->join('pertanyaan_pk as pk', 'pk.id_pk=penilaian_kinerja.id_pk', 'left')->where(['penilaian_kinerja.id_pk' => $id_pk])->join('nilai_pk as in', 'in.id_pertanyaan_pk = pk.id_pertanyaan_pk', 'left')->groupBy('id_pemberi_nilai')->findAll();

        if ($data[0]['id_pemberi_nilai'] == null) {
            return 0;
        } else {
            return count($data);
        }
    }


    public function getPertanyaan($id_pk, $no_induk)
    {
        return $this->select('n.no_induk,n.nilai,ppk.pertanyaan_pk,ppk.id_pertanyaan_pk')->join('pertanyaan_pk as ppk', 'ppk.id_pk=penilaian_kinerja.id_pk', 'left')->where('ppk.id_pk', $id_pk)->join('nilai_pk as n', 'n.id_pertanyaan_pk=ppk.id_pertanyaan_pk', 'left')->where('n.no_induk', $no_induk)->findAll();
    }
}