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

$('#klarifikasi-tugas-tambahan').on('click', '.bukti-klarifikasi-fix',function(){
    let id = $(this).data('id');
    window.open(window.location.origin+'/sisip/public/assets/images/bukti_klarifikasi/'+id);
})

$('#klarifikasi-tugas-utama').on('click', '.bukti-klarifikasi-tugas',function(){
    let id = $(this).data('id');
    window.open(window.location.origin+'/sisip/public/assets/images/bukti_klarifikasi/'+id);
})

$('#klarifikasi-tugas-detail').on('click', '.bukti-klarifikasi-detail',function(){
    let id = $(this).data('id');
    window.open(window.location.origin+'/sisip/public/assets/images/bukti_klarifikasi/'+id);
})

$('#validasi-tugas-detail').on('click', '.bukti-validasi-detail',function(){
    let id = $(this).data('id');
    window.open(window.location.origin+'/sisip/public/assets/images/bukti_klarifikasi/'+id);
})

