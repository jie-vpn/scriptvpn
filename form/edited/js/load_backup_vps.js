$(document).ready(function(){
    // upload file via AJAX
    $('#statusData').hide();
    $('.progress-bar').hide();
    $('.progress').hide();
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'potato',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">Backup gagal, silakan coba lagi.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">Data VPS berhasil dicadangkan</p>');
                    window.history.replaceState("Data VPS berhasil dicadangkan", "p0t4t0", "backup_vps?p0t4t0");
                    $('#uploadForm').hide();
                    $('#statusData').show();
                    $('#statusData').on('submit', function(e) {
                      e.preventDefault();
                      window.location = 'potato?p0t4t0=zip';
                    });
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Backup gagal, silakan coba lagi.</p>');
                }
            }
        });
    });
});