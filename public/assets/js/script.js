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