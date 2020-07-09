/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    handleCheckWFO = function(cb){
        $('#is_wfo').val($(cb).is(":checked"));
        $('#is_wfh').val(false);
        $('#is_wfh').prop('checked', false); // Unchecks it
    };
    
    handleCheckWFH = function (cb){
        $('#is_wfh').val($(cb).is(":checked"));
        $('#is_wfo').val(false);
        $('#is_wfo').prop('checked', false); // Unchecks it
    };
    
    findTugasHarian = function(){
        console.log("findTugasHarian");
        $('#block-table-tugas').html("");
        var url = appBaseUrl + "/administrasi/find_tugas_harian";
        var req = $.get(url)
            .done(function (data) {
                if (data) {
                    //console.log(data.length);
                    var tag = '<table id="tb-tugas" class="table table-condensed">\n\
                       <thead >    \n\
                           <tr> \n\
                               <th>No</th><th>Tugas yang Dilaksanakan</th><th>Aksi</th>\n\
                       </tr> </thead> <tbody id="table-body-assign">';
                   if (data) {
                       var no = 0;
                       for (i = 0; i < data.length; i++) {  
                           no++;
                           var u = data[i];
                           d = JSON.stringify(u).replace(/'/g, "\`");                           
                           var h = "<input type='hidden' value='" + d + "'/>";
                           //<button type='button' class='btn btn-sm btn-flat btn-warning ' title='Ajukan Perubahan Data' onclick='ajukanperubahan()'><i class='fa fa-edit'></i></button>
                           if (!u.tugas) u.tugas = '(Tidak ada data)';
                           var btnedit = '';
                               btnedit = "" +
                                   "<div class='pull-right'> <button type='button' class='btn btn-sm btn-danger btn-delete' title='Hapus Tugas'>Hapus</button></div>";
                           //<i class="glyphicon glyphicon-option-vertical"></i> <small><i>'+ u.username + '</i></small> <div class="pull-right"><small><i> '+ u.timestamp + '</i></small>'
                           var content = '<tr>';                                   
                           content += '<td>'+no+'</td><td>' + h+''
                                   + '<div><p>'+ u.tugas +'</p></div></td>'
                                   +'<td>'+btnedit+'</td>'
                                   + '</tr>';
                           tag += content;                           
                       }
                   }
                   tag += '</tbody> </table>';
                   $('#block-table-tugas').html(tag);
                   
                   var oTable = $("#tb-tugas").DataTable({
                     width: "100%",
                     searching: false,   
                     scrollY:  "350px",
                     scrollCollapse: true,
                     paging: false,
                       responsive:true,
                     order: [[0, 'asc']]                     
                    });
                    
                   $(document).on('click', '#tb-tugas .btn-delete', function () {
                        //var tr = $(this).parents("tr").hasClass("child") ? $(this).parents("tr").prev(): $(this).parents("tr");
                        //var aData = oTable.row(tr).data();
                        var d = $(this).closest('tr').find('input[type="hidden"]').val();
                        
                        if (d) {
                            var obj = JSON.parse(d);
                            //if (!obj.id_pengajuan_pegawai ) return;
                            var url = appBaseUrl + "/administrasi/remove_tugas";
                            var param = {
                                id_presensi_tugas: obj.id_presensi_tugas                          
                            };
                            $.post(url, param)
                                    .done(function (res) {
                                        if (res) {
                                            findTugasHarian();
                                        }
                                    });                            
                        }                         
                   }); 
                } else {
                    $('#block-table-tugas').html('<span style="display:block; text-align: center;"><em>Belum ada tugas yang dilaksanakan.</em></span>');
                }
            })
            .fail(function (data) {
                if ('responseText' in data)
                    $.notify({title: "Error", message: data.responseText}, {type: "danger", delay: 0});
            })
            .always(function (data) {
            });
    };
    
    findTugasHarian();
    
    $('.btn-presensi').click(function () {
        /**
        var l = $('#lokasi').val();        
        if (!l || l.trim() == '' || l.trim() == '-') {
            $.notify({title: "Information", message: 'Mohon isikan lokasi Anda terlebih dahulu!'}, {type: "error", delay: 5});
            return;
        }
        */
        if($("#tb-tugas tbody tr").length == 0 && $(".waktu_presensi:eq(0)").text() != ""){
            swal("Anda yakin mengakhiri bekerja tanpa mengisi tugas harian?", {
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Batal",
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
            }).then(function (value) {
                if(value) submitForm();
            });
            return ;
        }
        submitForm();
    });

    function submitForm(){
        
        ///handleCheckWFH($('#is_wfh'));
        var isWfh = $('#is_wfh').is(":checked");
        if (isWfh) {
            handleCheckWFH($('#is_wfh'));
        }
        //handleCheckWFO($('#is_wfo'));
        var isWfo = $('#is_wfo').is(":checked");
        if (isWfo) {
            handleCheckWFO($('#is_wfo'));
        }
        if (isWfh !== true && isWfo !== true) {
            $.notify({title: "Information", message: 'Mohon tandai/cek salah satu jenis kerja Anda: WFO atau WFH.'}, {type: "error", delay: 5});
            return;
        }
        if (isWfh == true && isWfo == true) {
            $.notify({title: "Information", message: 'Mohon tandai/cek salah satu jenis kerja Anda: WFO atau WFH.'}, {type: "error", delay: 5});
            return;
        }
        var btn_save = $('.btn-presensi');
        btn_save.prop('disabled', true);
        var options = {
            target: '',
            success: function (result) {
                if (!result){
                    $.notify({title: "Information", message: 'Mohon ulangi lagi, cek koneksi internet atau server busy.'}, {type: "error", delay: 0});
                    return;
                }
                try {
                    var data = result;
                    if (data.status) {
                        $('#id_presensi').val(data.data);
                        $.notify({title: "Information", message: data.message}, {type: "success", delay: 1});
                        location.reload();
                        return;
                    }
                    $.notify({title: "Information", message: data.message}, {type: "error", delay: 1});
                } catch (err) {
                    $.notify({title: "Information", message: err.message}, {type: "error", delay: 0});
                    btn_save.prop('disabled', false);
                }
            }
        };
        $('#frm-presensi').ajaxForm(options).submit();
    }
    
    $('.btn-save-tugas').click(function () {
        //var btn_save = $(this);
        var t = $('#tugas').val();
        if (!t) return;
        var options = {
            target: '',
            success: function (result) {
                if (!result){
                    $.notify({title: "Information", message: 'Mohon ulangi lagi, cek koneksi internet atau server busy.'}, {type: "error", delay: 0});
                    return;
                }
                try {
                    var data = result;
                    if (data.status) {                
                        //$('#id_presensi').val(data.data);
                        $('#tugas').val("");
                        $.notify({title: "Information", message: data.message}, {type: "success", delay: 1});
                        findTugasHarian();
                        //location.reload();
                        return;
                    }
                    $.notify({title: "Information", message: data.message}, {type: "error", delay: 1});
                } catch (err) {
                    $.notify({title: "Information", message: err.message}, {type: "error", delay: 0});
                    //btn_save.prop('disabled', false);
                }
            }
        };
        $('#frm-tugas').ajaxForm(options).submit();

    });
});
