<?php

namespace App\Models;

use CodeIgniter\Model;

class indeksKepuasan extends Model
{
    protected $table      = 'indeks_kepuasan';
    protected $primaryKey = 'id';

    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'tanggal', 'status'];

    // protected $db = \Config\Database::connect();
    // protected $builder = $db->table($table);

    // public function get(){

    //     $this->builder->select('')
    // }

    public function cekIndeksKepuasan($no_induk)
    {
        return $this->join('indeks_pertanyaan as ip', 'ip.id_indeks=indeks_kepuasan.id', 'left')->where(['indeks_kepuasan.status' => 1])->join('indeks_nilai as in', 'in.id_pertanyaan = ip.id_pertanyaan', 'left')->where('in.no_induk ', $no_induk)->findAll();
    }

    public function jumlahResponden($id)
    {
        $data = $this->select('no_induk')->join('indeks_pertanyaan as ip', 'ip.id_indeks=indeks_kepuasan.id', 'left')->where(['indeks_kepuasan.id' => $id])->join('indeks_nilai as in', 'in.id_pertanyaan = ip.id_pertanyaan', 'left')->groupBy('no_induk')->findAll();

        if ($data[0]['no_induk'] == null) {
            return 0;
        } else {
            return count($data);
        }
    }
}
