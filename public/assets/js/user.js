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
    window.open(window.location.origin+'/sisip/public/assets/images/bukti_klarifikasi/'+id);
})

$(function() {
    $.getJSON('http://localhost/sisip/public/kinerjaApi', {
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
    })
    
})

$('#logbook-utama').on('click', '.submit-logbook', function(){
    var id_rancangan = $(this).data('id');
    var jml = $('#jumlah'+id_rancangan).val();
    $('#jumlah'+id_rancangan).val('');
    var no_ind = $(this).data('no');

    $.ajax({
        url: 'http://localhost/sisip/public/staff/inputLogbookApi',
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
                url: 'http://localhost/sisip/public/logbookApi/'+no_ind,
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
        url: 'http://localhost/sisip/public/staff/inputLogbookApi',
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
                url: 'http://localhost/sisip/public/logbookApi/'+no_ind,
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
        url: 'http://localhost/sisip/public/hapusTugasApi/'+id_tugas,
        type: 'get',
        success: function(data){
            $.ajax({
                url: 'http://localhost/sisip/public/logbookApi/'+no_induk,
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
        url: 'http://localhost/sisip/public/hapusTugasApi/'+id_tugas,
        type: 'get',
        success: function(data){
            $.ajax({
                url: 'http://localhost/sisip/public/logbookApi/'+no_induk,
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