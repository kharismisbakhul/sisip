var url = $(location).attr("href");
var segments = url.split("/");

// console.log(segments);

// $('#table-daftar-hadir').on('click', function(){
//     console.log("HAHAHAH");
// });

$('#riwayat-presensi').DataTable({
    "pageLength": 5,
    'order' : []
});
$('#tabel-daftar-jabatan').DataTable({
    "pageLength": 5,
    'order' : []
});
$('#tabel-riwayat-presensi').DataTable({
    "pageLength": 5,
    'order' : []
});
$('#tabel-riwayat-saran').DataTable({
    "pageLength": 5
});
$('#tabel_validasi_logbook').DataTable({
    "pageLength": 5,
    initComplete: function () {
        $('#tabel_validasi_logbook_filter').append(`<div class="filter_pegawai"></div>`)
        this.api().columns([3]).every( function () {
            var column = this;
            var select = $('<select class="form-control mb-3" id="filter_pegawai_validasi"><option value="">Pilih Pegawai</option></select>')
                .appendTo(".filter_pegawai")
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    }
});
$('#tabel-klarifikasi').DataTable();


$('#tabel-klarifikasi').on('click', '.klarifikasi_tugas',function(){
    let id = $(this).data('id');
    $('#id_tugas_modal').val(id);
})

$('#validasi-tugas-detail').on('click', '.validasi-revisi',function(){
    let id = $(this).data('id');
    let presensi = $(this).data('presensi');
    $('#id_tugas_validasi').val(id);
    $('#id_presensi_validasi').val(presensi);
})

$('#validasi-tugas-detail').on('click', '.bukti-validasi-detail',function(){
    let id = $(this).data('id');
    window.open(window.location.origin+':8080/assets/images/bukti_klarifikasi/'+id);
})

$(function() {
    $.getJSON(segments[0] + '/kinerjaApi', {
        format: 'json',
        }, function (result) {
            var chart = c3.generate({
                bindto: '#dashboard_diagram',
                data: {
                  columns: [['Pekerjaan divalalidasi', result.jumlah_validasi], ['Pekerjaan belum divalidasi', result.jumlah_belum_validasi], ['Pekerjaan revisi', result.jumlah_revisi]],
            
                  type: 'donut',
                  onclick: function(d, i) {
                    // console.log('onclick', d, i);
                  },
                  onmouseover: function(d, i) {
                    // console.log('onmouseover', d, i);
                  },
                  onmouseout: function(d, i) {
                    // console.log('onmouseout', d, i);
                  }
                },
                donut: {
                  label: {
                    show: false
                  },
                  title: 'Progress Kinerja',
                  width: 25
                },
            
                legend: {
                  hide: true
                  //or hide: 'data1'
                  //or hide: ['data1', 'data2']
                },
                color: {
                  pattern: ['#22c6ab', '#4798e8', '#ffbc34']
                }
              });
              var chart2 = c3.generate({
                bindto: '#admin-chart',
                data: {
                  columns: [['Valid', result.jumlah_validasi], ['Belum Validasi', result.jumlah_belum_validasi], ['Revisi', result.jumlah_revisi]],
            
                  type: 'donut',
                  onclick: function(d, i) {
                    // console.log('onclick', d, i);
                  },
                  onmouseover: function(d, i) {
                    // console.log('onmouseover', d, i);
                  },
                  onmouseout: function(d, i) {
                    // console.log('onmouseout', d, i);
                  }
                },
                donut: {
                  label: {
                    show: false
                  },
                  title: 'Progress Kinerja',
                  width: 25
                },
            
                legend: {
                  hide: true
                  //or hide: 'data1'
                  //or hide: ['data1', 'data2']
                },
                color: {
                  pattern: ['#22c6ab', '#4798e8', '#ffbc34']
                }
              });
              
    })
    
})

$('#logbook-utama').on('click', '.submit-logbook', function(){
    var id_rancangan = $(this).data('id');
    var jml = $('#jumlah'+id_rancangan).val();
    $('#jumlah'+id_rancangan).val('');
    var no_ind = $(this).data('no');

    $.ajax({
        url: segments[0] + '/staff/inputLogbookApi',
        type: 'post',
        data: {
            id_rancangan_tugas: id_rancangan,
            jumlah: jml,
            no_induk: no_ind
        },
        dataType: 'json',
        success: function(data){
            // console.log("SUKSESDONG");
            $.ajax({
                url: segments[0] + '/logbookApi/'+no_ind,
                type: 'get',
                dataType: 'json',
                success: function(dataA){
                    var j = 1;
                    console.log(dataA)
                    $('#table-tugas-utama').html('');
                    dataA['tugas_hari_ini'].forEach(function(pp) {
                        $('#table-tugas-utama').append(`
                        <tr class="row`+pp['id_tugas']+`">
                            <td>`+(j++)+`</td>
                            <td>`+pp['nama_tugas']+`</td>
                            <td>`+pp['jumlah_tugas']+`</td>
                        </tr>
                        `);
                        addRow(pp['id_tugas'], pp['status_tugas'], pp['catatan'], pp['bukti'], no_ind);
                    })
                }
            });
        }
    });
})

$('#logbook-tambahan').on('click', '.submit-logbook', function(){
    var id_rancangan = $(this).data('id');
    var jml = $('#jumlah'+id_rancangan).val();
    $('#jumlah'+id_rancangan).val('');
    var nama_tugas_t = $('#nama_tugas_tambahan').val();
    $('#nama_tugas_tambahan').val('Tugas Tambahan');
    var period = $('#periode').val();
    // $('#periode').val('');
    var no_ind = $(this).data('no');
    $.ajax({
        url: segments[0] + '/staff/inputLogbookApi',
        type: 'post',
        data: {
            id_rancangan_tugas: id_rancangan,
            jumlah: jml,
            no_induk: no_ind,
            periode: period,
            nama_tugas_tambahan: nama_tugas_t
        },
        dataType: 'json',
        success: function(data){
            console.log("SUKSESDONG");
            $.ajax({
                url: segments[0] + '/logbookApi/'+no_ind,
                type: 'get',
                dataType: 'json',
                success: function(dataA){
                    var j = 1;
                    console.log(dataA)
                    $('#table-tugas-tambahan').html('');
                    dataA['tugas_tambahan_hari_ini'].forEach(function(pp) {
                        $('#table-tugas-tambahan').append(`
                        <tr class="row`+pp['id_tugas']+`">
                            <td>`+(j++)+`</td>
                            <td>`+pp['nama_tugas']+`</td>
                            <td>`+pp['jumlah_tugas']+`</td>
                        </tr>
                        `);
                        addRow(pp['id_tugas'], pp['status_tugas'], pp['catatan'], pp['bukti'], no_ind);
                    })
                }
            });
        }
    });
})

function addRow(id_tugas, status_tugas, catatan, bukti, no_induk){
    if(status_tugas == 1){
        $('.row'+id_tugas).append(`
        <td><i class="fas fa-dot-circle mr-2 text-success"></i> Valid</td>
        `);
    }else if(status_tugas == 2){
        $('.row'+id_tugas).append(`
        <td>
            <i class="fas fa-dot-circle mr-2 text-warning"></i>
            <button class="btn btn-sm btn-warning">Revisi</button>
            <p>`+catatan+`</p>
        </td>
        `);
    }else if(status_tugas == 3){
        $('.row'+id_tugas).append(`
        <td><i class="fas fa-dot-circle mr-2"></i> Belum valid</td>
        <td><button class="btn btn-danger hapus_Tugas" data-no="`+no_induk+`" data-id="`+id_tugas+`">Hapus</button></td>
        `);
    }else if(status_tugas == 5){
        $('.row'+id_tugas).append(`
        <td><i class="fas fa-dot-circle mr-2 text-danger"></i> Tolak</td>
        `);
    }else{
        $('.row'+id_tugas).append(`
        <td>
            <i class="fas fa-dot-circle mr-2 text-purple"></i>
            Klarifikasi
            <a target="_blank" href="`+segments[0] + '/' + segments[3] +`/assets/images/bukti_klarifikasi/`+bukti+`"><i class="fas fa-file-alt"></i></a>
            <p>`+catatan+`</p>
        </td>
        `);
    }
}

$('#logbook-tugas-utama').on('click', '.hapus_Tugas', function(){
    var id_tugas = $(this).data('id');
    var no_induk = $(this).data('no');

    $.ajax({
        url: segments[0] + '/hapusTugasApi/'+id_tugas,
        type: 'get',
        success: function(data){
            $.ajax({
                url: segments[0] + '/logbookApi/'+no_induk,
                type: 'get',
                dataType: 'json',
                success: function(dataA){
                    var j = 1;
                    console.log(dataA)
                    $('#table-tugas-utama').html('');
                    dataA['tugas_hari_ini'].forEach(function(pp) {
                        $('#table-tugas-utama').append(`
                        <tr class="row`+pp['id_tugas']+`">
                            <td>`+(j++)+`</td>
                            <td>`+pp['nama_tugas']+`</td>
                            <td>`+pp['jumlah_tugas']+`</td>
                        </tr>
                        `);
                        addRow(pp['id_tugas'], pp['status_tugas'], pp['catatan'], pp['bukti'], no_induk);
                    })
                }
            });
        }
    });

})

$('#logbook-tugas-tambahan').on('click', '.hapus_Tugas', function(){
    var id_tugas = $(this).data('id');
    var no_induk = $(this).data('no');

    $.ajax({
        url: segments[0] + '/hapusTugasApi/'+id_tugas,
        type: 'get',
        success: function(data){
            $.ajax({
                url: segments[0] + '/logbookApi/'+no_induk,
                type: 'get',
                dataType: 'json',
                success: function(dataA){
                    var j = 1;
                    console.log(dataA)
                    $('#table-tugas-tambahan').html('');
                    dataA['tugas_tambahan_hari_ini'].forEach(function(pp) {
                        $('#table-tugas-tambahan').append(`
                        <tr class="row`+pp['id_tugas']+`">
                            <td>`+(j++)+`</td>
                            <td>`+pp['nama_tugas']+`</td>
                            <td>`+pp['jumlah_tugas']+`</td>
                        </tr>
                        `);
                        addRow(pp['id_tugas'], pp['status_tugas'], pp['catatan'], pp['bukti'], no_induk);
                    })
                }
            });
        }
    });

})

var input = document.getElementById("chat-masuk");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("kirim-chat").click();
  }
}); 

$('#kirim-chat').on('click', function(){
    var uname = $('#chat-username').val();
    var  psn = $('#chat-masuk').val();
    $.ajax({
        url: segments[0] + '/chat',
        type: 'post',
        data: {
            username: uname,
            pesan: psn,
        },
        dataType: 'json',
        success: function(data){
            // console.log(data);
            $('#list-chat-box').html('');
            $('#chat-masuk').val('');
            data.forEach(function(pp) {
                if(pp['no_induk'] == uname){
                    $('#list-chat-box').append(`
                    <li class="odd chat-item">
                        <div class="chat-content">
                            <div class="box bg-light-inverse">`+pp['pesan']+`</div>
                            <br>
                        </div>
                        <div class="chat-time">`+pp['tanggal']+` `+pp['waktu']+`</div>
                    </li>
                    `);
                }else{
                    $('#list-chat-box').append(`
                    <li class="chat-item">
                        <div class="chat-img">
                            <img src="`+window.location.origin+pp['foto_profil']+`" alt="user">
                        </div>
                        <div class="chat-content">
                            <h6 class="font-medium">`+pp['nama']+`</h6>
                            <div class="box bg-light-info">`+pp['pesan']+`</div>
                        </div>
                        <div class="chat-time">`+pp['tanggal']+` `+pp['waktu']+`</div>
                    </li>
                    `);
                }
                
            })
            
            var listChat = document.querySelector('.chat-box');
            listChat.scrollTop = listChat.scrollHeight - listChat.clientHeight;


        }
    });
})

var listChat = document.querySelector('.chat-box');
listChat.scrollTop = listChat.scrollHeight - listChat.clientHeight;


$('.tabel-presensi-riwayat').on('click', '.button-detail-presensi-bawahan', function(){
    var id_riwayat_jabatan = $(this).data('id');
    console.log(id_riwayat_jabatan);
    $.ajax({
        url: segments[0] + '/getPresensiBawahan',
        type: 'post',
        data: {
            id_riwayat: id_riwayat_jabatan,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#nama-pegawai').html(data['user']['nama']);
            $('#jabatan-pegawai').html(data['user']['jabat']['nama_status_user']+' '+data['user']['jabat']['nama']);
            if(data['presensi'].length == 0){
                $('.tabel-detail-presensi-bawahan').html('');
                $('.tabel-detail-presensi-bawahan').html('<div class="alert alert-warning text-center">Belum ada presensi</div>');
            }else{
                $('.tabel-detail-presensi-bawahan').html(`
                <thead>
                    <tr class="align-middle text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Waktu Presensi Masuk</th>
                        <th>Waktu Presensi Keluar</th>
                        <th>Tempat Presensi Masuk</th>
                        <th>Tempat Presensi Keluar</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="body-riwayat-presensi-bawahan">
                </tbody>
                `);
                var i = 1;
                data['presensi'].forEach(function(p){
                    // console.log(p);
                    var temp = 'aa';
                    var temp2 = 'bb';
                    var temp3 = 'cc';
                    if(p['waktu_presensi_keluar'] == null){
                        temp2 = 'Belum presensi keluar';
                    }else{
                        temp2 = p['waktu_presensi_keluar']+' ('+p['keluar']+')';
                    }
                    if(p['tempat_presensi_keluar'] == null){
                        temp3 = 'Belum presensi keluar';
                    }else{
                        temp3 = p['tempat_presensi_keluar'];
                    }
                    if(p['status_tempat_kerja'] == 1){
                        temp = 'WFH';
                    }else if(p['status_tempat_kerja'] == 2){
                        temp = 'WFO';
                    }else{
                        temp = 'WO';
                    }
                    $('#body-riwayat-presensi-bawahan').append(`
                        <tr>
                            <td>`+(i++)+`</td>
                            <td>`+p['tanggal_presensi']+`</td>
                            <td>`+p['waktu_presensi_masuk']+' ('+p['masuk']+`)</td>
                            <td>`+temp2+`</td>
                            <td>`+p['lokasi']+`</td>
                            <td>`+temp3+`</td>
                            <td>`+temp+`</td>
                            <td><button class="btn btn-success button-detail-logbook-bawahan" data-toggle="modal" data-target="#detail_logbook_bawahan" data-id="`+p['id_presensi']+`">Log</button></td>
                        </tr>
                    `);
                })
            }


        }
    });
    // $('.tabel-detail-presensi-bawahan').DataTable({
    //     "pageLength": 5
    // });
})

$('.tabel-presensi-riwayat').on('click', '.tambah_presensi_pegawai_bawahan', function(){
    var id_riwayat_jabatan = $(this).data('id');
    // console.log(id_riwayat_jabatan);
    $.ajax({
        url: segments[0] + '/getPresensiBawahan',
        type: 'post',
        data: {
            id_riwayat: id_riwayat_jabatan,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('.nama-user').html(data['user']['nama']);
            $('.nip-user').html('NIP.'+data['user']['no_induk']);
            $('.jabatan-user').html(data['user']['jabat']['nama_status_user']+' '+data['user']['jabat']['nama']);
            $('#input_rj').val(id_riwayat_jabatan);
            $('#input_induk').val(data['user']['no_induk']);
        }
    });
})

$('.tabel-detail-presensi-bawahan').on('click', '.button-detail-logbook-bawahan', function(){
    var id_presensi = $(this).data('id');
    console.log(id_presensi);
    $.ajax({
        url: segments[0] + '/getLogbookBawahan',
        type: 'post',
        data: {
            id_p: id_presensi,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);
            $('#logbook-nama-pegawai').html(data['user']['nama']);
            $('#logbook-jabatan-pegawai').html(data['user']['jabat']['nama_status_user']+' '+data['user']['jabat']['nama']);
            $('#logbook-tanggal').html(data['presensi']['tanggal_presensi']);
            if(data['tugas'].length == 0){
                $('.tabel-detail-logbook-bawahan').html('');
                $('.tabel-detail-logbook-bawahan').html('<div class="alert alert-warning text-center">Belum ada logbook</div>');
            }else{
                $('.tabel-detail-logbook-bawahan').html(`
                <thead>
                    <tr class="align-middle text-center">
                        <th>No</th>
                        <th>Tugas</th>
                        <th>Jenis Tugas</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Waktu Pengisian</th>
                    </tr>
                </thead>
                <tbody id="body-riwayat-logbook-bawahan">
                </tbody>
                `);
                var i = 1;
                data['tugas'].forEach(function(t){
                    var temp = 'aa';
                    var temp2 = 'bb';
                    if(t['id_rancangan_tugas'] != 0){
                        temp2 = 'Utama';
                    }else{
                        temp2 = 'Tambahan';
                    }
                    if(t['status_tugas'] == 1){
                        temp = '<td class="text-success">Valid</td>';
                    }else if(t['status_tugas'] == 2){
                        temp = '<td class="text-warning">Revisi</td>';
                    }else if(t['status_tugas'] == 3){
                        temp = '<td class="text-info">Menunggu Validasi</td>';
                    }else if(t['status_tugas'] == 5){
                        temp = '<td class="text-danger">Tolak</td>';
                    }else{
                        temp = '<td class="text-purple">Klarifikasi</td>';
                    }
                    $('#body-riwayat-logbook-bawahan').append(`
                        <tr>
                            <td>`+(i++)+`</td>
                            <td>`+t['nama_tugas']+`</td>
                            <td>`+temp2+`</td>
                            <td>`+t['jumlah_tugas']+`</td>
                            `+temp+`
                            <td>`+t['waktu']+`</td>
                        </tr>
                    `);
                })
            }


        }
    });
})

$('#tabel-daftar-bawahan').on('click', '.button-detail-bawahan', function(){
    var foto = $(this).data('foto');
    var nama = $(this).data('nama');
    var nip = $(this).data('nip');
    var jabatan = $(this).data('jabatan');
    var status = $(this).data('status');
    var email = $(this).data('email');
    var no = $(this).data('no');
    var alamat = $(this).data('alamat');
    $('#foto').attr('src', '');
    $('#foto').attr('alt', '');
    $('#nama').val();
    $('#no_induk').val();
    $('#jabatan').val();
    $('#email').val();
    $('#no_telepon').val();
    $('#alamat').val();
    $('#foto').attr('src', window.location.origin+foto);
    $('#foto').attr('alt', 'Foto');
    $('#nama').val(nama);
    $('#no_induk').val(nip);
    $('#jabatan').val(status+' '+jabatan);
    $('#email').val(email);
    $('#no_telepon').val(no);
    $('#alamat').val(alamat);
})