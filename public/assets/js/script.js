var url = $(location).attr("href");
var segments = url.split("/");


$(".btn-password").click(function () {
    var no_induk = $(this).data('id');
    $.ajax({
        url: segments[0] + '/' + segments[3] + '/apiPassword/' + no_induk,
        method: 'get',
        dataType: 'json',
        success: function (result) {
            $('.form-pwd').attr('action', segments[0] + '/' + segments[3] + '/ubahPassword/' + result['no_induk'])
            $('.v-pwd').val(result['password']);

        }
    });
});

$(".btn-gambar").click(function () {
    var no_induk = $(this).data('id');
    $('.form-gmbr').attr('action', segments[0] + '/' + segments[3] + '/ubahGambar/' + no_induk)
});



function editPertanyaan(id) {
    let id_pertanyaan = id;
    $.ajax({
        url: segments[0] + '/admin/editIndeksPertanyaan',
        data: $('.editForm' + id_pertanyaan).serialize(),
        method: "post",
        dataType: 'json',
        success: function (result) {
            alert('Data berhasil diubah')
        },
        error: function (data) {
            alert('Data gagal diubah');
        }
    });
}

function editPertanyaan2(id) {
    let id_per = $('#id_per' + id).val()
    let per = $('#per' + id).val()

    $.ajax({
        url: segments[0] + '/admin/editIndeksPertanyaan',
        data: {
            'id_pertanyaan': id_per,
            'pertanyaan': per,
        },
        method: "post",
        dataType: 'json',
        success: function (result) {
            alert('Data berhasil diubah')
        },
        error: function (data) {
            alert('Data gagal diubah');
        }
    });
}

function editPertanyaanpk(id) {
    let id_per = $('#id_pertanyaan_pk' + id).val()
    let per = $('#pertanyaan_pk' + id).val()
    let aspek_pk = $('#aspek_pk' + id).val()
    $.ajax({
        url: segments[0] + '/admin/ubahPertanyaanPenilaian',
        data: {
            'id_pertanyaan_pk': id_per,
            'pertanyaan_pk': per,
            'aspek_pk': aspek_pk
        },
        method: "post",
        dataType: 'json',
        success: function (result) {
            alert('Data berhasil diubah')
        },
        error: function (data) {
            alert('Data gagal diubah');
        }
    });
}

$('.editJamKerja').on('click', function () {
    let id = $(this).data('id')
    let jammasuk = $(this).data('jammasuk')
    let jamkeluar = $(this).data('jamkeluar')
    let statusaktif = $(this).data('statusaktif')
    let statusjam = $(this).data('statusjam')
    let jabatan = $(this).data('jabatan')
    let bidang = $(this).data('bidang')




    $('#riwayat_jabatan_edit').val(jabatan)
    $('#riwayat_bidang_edit').val(bidang)
    $('#id_jam_kerja_edit').val(id)
    $('#jam_kerja_masuk_edit').val(jammasuk)
    $('#jam_kerja_keluar_edit').val(jamkeluar)

    if (statusaktif == 1) {
        $('#status_aktif_edit').html(`
        <option selected value="1">Aktif</option>
        <option value="0">Tidak Aktif</option>
        `)
    } else {
        $('#status_aktif_edit').html(`
        <option  value="1">Aktif</option>
        <option selected value="0">Tidak Aktif</option>
        `)
    }

    if (statusjam == 1) {
        $('#status_jam_kerja_edit').html(`
        <option selected value="1">Aktif</option>
        <option value="0">Tidak Aktif</option>
        `)
    } else {
        $('#status_jam_kerja_edit').html(`
        <option  value="1">Aktif</option>
        <option selected value="0">Tidak Aktif</option>
        `)
    }
})



$('#tambah-pertanyaan').click(function (e) {
    e.preventDefault();
    $.ajax({
        url: segments[0] + '/admin/tambahIndeksPertanyaan',
        data: $('#createForm').serialize(),
        method: "post",
        dataType: 'json',
        success: function (result) {
            var data = result['pertanyaan']
            let no = result['nomer']
            $('.tabel-pertanyaan').append(
                `
                    <tr>
                        <form class="editForm` + data['id_pertanyaan'] + `" id="editForm` + data['id_pertanyaan'] + `"  method="post">
                            <td>` + no + `</td>
                            <td>
                                <input type="hidden" name="id_indeks" value="` + data['id_indeks'] + `">
                                <input type="hidden" name="id_pertanyaan" id="id_per` + data['id_pertanyaan'] + `" value="` + data['id_pertanyaan'] + `">
                                <textarea style="width: 800px;" id="per` + data['id_pertanyaan'] + `" name="pertanyaan" type="text" class="form-control">` + data['pertanyaan'] + `</textarea>
                            </td>
                            <td>
                                <div class="button-group">
                                    <button type="button" class="btn waves-effect waves-light btn-info edit-pertanyaan cek" data-id="` + data['id_pertanyaan'] + `" onclick="editPertanyaan2(` + data['id_pertanyaan'] + `)"><i class="fas fa-edit mr-2"></i>Simpan</button>
                                    <a href="/admin/hapusIndeksPertanyaan/` + data['id_pertanyaan'] + `/` + data['id_indeks'] + `" class="btn waves-effect waves-light btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    `
            );

        },
        error: function (data) {
            alert('Gagal');
        }
    });
})

$('#tambah-pertanyaan-pk').click(function (e) {
    e.preventDefault();
    confirm($('#pertanyaan_pk').val());


    $.ajax({
        url: segments[0] + '/admin/tambahPertanyaanPenilaian',
        data: {
            'id_pk': $('#id_pk').val(),
            'pertanyaan_pk': $('#pertanyaan_pk').val(),
            'aspek_pk': $('#aspek_pk').val()
        },
        method: "post",
        dataType: 'json',
        success: function (result) {
            var data = result['pertanyaan_pk']
            let no = result['nomer']
            let aspek = [
                "Aspek Teknis Pekerjaan",
                "Aspek Non Teknis",
                "Aspek Kepribadian",
                "Aspek Kepemimpinan (Khusus untuk: GM, Manajer, Supervisor, dan Koordinator)"
            ];

            let td_aspek = '';

            for (var i in aspek) {
                if (aspek[i] == data['aspek_pk']) {
                    td_aspek += `<option selected value="` + aspek[i] + `">` + aspek[i] + `</option>`
                } else {
                    td_aspek += `<option value="` + aspek[i] + `">` + aspek[i] + `</option>`
                }
            }


            console.log(result)

            $('.tabel-pertanyaan-pk').append(
                `
                    <tr>
                        <form class="editFormPertanyaan` + data['id_pertanyaan_pk'] + `" method="post">
                            <td>` + (no++) + `</td>
                            <td>
                                <input type="hidden" name="id_pk" value="` + data['id_pk'] + `">
                                <input type="hidden" name="id_pertanyaan_pk" id="id_pertanyaan_pk` + data['id_pertanyaan_pk'] + `" value="` + data['id_pertanyaan_pk'] + ` ">
                                <textarea style="width: 500px;" name="pertanyaan_pk" id="pertanyaan_pk` + data['id_pertanyaan_pk'] + `" type="text" class="form-control">` + data['pertanyaan_pk'] + `</textarea>
                            </td>
                            <td>
                                <select name="aspek_pk" id="aspek_pk` + data['id_pertanyaan_pk'] + `" class="form-control">
                                        <option value="">Tidak ada aspek</option>
                                        ` + td_aspek + `
                                </select>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn waves-effect waves-light btn-info edit-pertanyaan-pk" data-id="` + data['id_pertanyaan_pk'] + `" onclick="editPertanyaanpk(` + data['id_pertanyaan_pk'] + `)"><i class=" fas fa-edit"></i></button>
                                    <a href="/admin/hapusPertanyaanPenilaian/` + data['id_pertanyaan_pk'] + `/` + data['id_pk'] + `" class="btn waves-effect waves-light btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </form>
                    </tr>
                `
            );
        },
        error: function (data) {
            alert('Gagal');
        }
    });
})

$('#tambah-rancangan').click(function (e) {
    let id_jabatan = $('.id_jabatan').val()
    let nama_tugas = $('.nama_tugas').val()
    let periode = $('.periode').val()
    let jumlah_tugas = $('.jumlah_tugas').val()
    let nomor_pekerjaan = $('.nomor_pekerjaan').val()

    $.ajax({
        url: segments[0] + '/admin/tambahRancanganTugas',
        data: {
            'id_jabatan': id_jabatan,
            'nama_tugas': nama_tugas,
            'periode': periode,
            'jumlah_tugas': jumlah_tugas,
            'nomor_pekerjaan': nomor_pekerjaan
        },
        method: "post",
        dataType: 'json',
        success: function (result) {
            let r = result['rancangan'];
            let periode = "";

            if (r['periode'] == 1) {
                periode = '<option value="1" selected>Harian</option><option value="3">Mingguan</option><option value="2">Bulanan</option>'
            } else if (r['periode'] == 3){
                periode = '<option value="1" >Harian</option><option value="3" selected>Mingguan</option><option value="2">Bulanan</option>'
            } else {
                periode = '<option value="1" >Harian</option><option value="3">Mingguan</option><option value="2" selected>Bulanan</option>'
            }


            $('.tabel-rancangan').append(
                `<tr>
                    <form class="editFormRancangan` + r['id_rancangan_tugas'] + `" method="post">
                        <td>
                            <input type="number" class="form-control" name="nomor" value="` + r['nomor_pekerjaan'] + `" id="nomor_pekerjaan` + r['id_rancangan_tugas'] + `">
                        </td>
                        <td>
                            <input type="hidden" id="id_jabatan" name="id_jabatan" value="` + r['id_jabatan'] + `">
                            <textarea id="nama_tugas` + r['id_rancangan_tugas'] + `" type="text" name="nama_tugas" class="form-control">` + r['nama_tugas'] + `</textarea>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="custom-select col-12" id="periode` + r['id_rancangan_tugas'] + `" name="periode">
                                    ` + periode + `
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input id="jumlah_tugas` + r['id_rancangan_tugas'] + `" type="number" value="` + r['jumlah_total_tugas'] + `" class="form-control" name="jumlah_tugas">
                            </div>
                        </td>
                        <td>
                            <div class="button-group">
                                <button type="button" class="btn waves-effect waves-light btn-info edit-pertanyaan" data-id="` + r['id_rancangan_tugas'] + `" onclick="editRancanganTugas(` + r['id_rancangan_tugas'] + `)"><i class=" fas fa-edit mr-2"></i>Simpan</button>
                                <a href="/admin/hapusRancanganTugas/` + r['id_rancangan_tugas'] + `/` + r['id_jabatan'] + `" class="btn waves-effect waves-light btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</a>
                            </div>
                        </td>
                    </form>
                </tr>
                `
            );
            alert('Data rancangan berhasil ditambahkan');
        },
        error: function (data) {
            alert('Gagal Menambahkan');
        }
    });
})

function editRancanganTugas(id) {
    let nama_tugas = $('#nama_tugas' + id).val()
    let periode = $('#periode' + id).val()
    let jumlah_tugas = $('#jumlah_tugas' + id).val()
    let nomor_pekerjaan = $('#nomor_pekerjaan' + id).val()


    $.ajax({
        url: segments[0] + '/admin/ubahRancanganTugas',
        data: {
            'nama_tugas': nama_tugas,
            'periode': periode,
            'jumlah_tugas': jumlah_tugas,
            'nomor_pekerjaan': nomor_pekerjaan,
            'id_rancangan_tugas': id
        },
        method: "post",
        dataType: 'json',
        success: function (result) {
            alert('Data berhasil diubah')
        },
        error: function (data) {
            alert('Data gagal diubah');
        }
    });
}



$('.btn-edit-pengumuman').on('click', function () {
    $('.temp-status').remove()
    let id = $(this).data('id')
    let status = $(this).data('status')
    let peng = $(this).data('pengumuman')

    $('.edit-id-pengumuman').val(id)
    $('.edit-pengumuman').val(peng)

    if (status == 1) {
        $('.edit-status-pengumuman').append(`
            <option class="temp-status" value="1" selected> Aktif </option>
            <option class="temp-status" value="0">Tidak Aktif</option>
        `)
    } else {
        $('.edit-status-pengumuman').append(`
            <option class="temp-status" value="1"> Aktif </option>
            <option class="temp-status" value="0" selected> Tidak Aktif </option>
        `)
    }
})

$('#riwayat_jabatan').on('change', function () {
    let id_status_user = $('#riwayat_jabatan').val()

    $.ajax({
        url: segments[0] + '/admin/apiDetailJabatan/' + id_status_user,
        method: "get",
        dataType: 'json',
        success: function (result) {
            console.log(result)
            let pilihan = '';
            for (var i in result) {
                pilihan += '<option value="' + result[i]['id_jabatan'] + '">' + result[i]['nama'] + '</option>'
            }

            $('#riwayat_bidang').html(pilihan)
        }
    });
})

$('#status_jabatan_modal').on('change', function () {
    let id_status_user = $('#status_jabatan_modal').val()
    console.log(id_status_user);
    $.ajax({
        url: segments[0] + '/admin/apiAtasanJabatan/' + id_status_user,
        method: "get",
        dataType: 'json',
        success: function (result) {
            console.log(result)
            let pilihan = '';
            if(result != null){
                $('#atasan').html(`
                <div class="form-group">
                    <label for="atasan_langsung_modal" class="control-label">Atasan Langsung</label>
                    <select class="custom-select mr-sm-2" id="atasan_langsung_modal" name="atasan_langsung">
                    </select>
                </div>
                `)
                for (var i in result) {
                    pilihan += '<option value="' + result[i]['id_jabatan'] + '">' + result[i]['nama_status_user']+' '+result[i]['nama'] + '</option>'
                }
                $('#atasan_langsung_modal').append(pilihan);
            }else{
                $('#atasan').html(``)
            }
        }
    });
})