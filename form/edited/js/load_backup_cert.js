$(document).ready(function(){
    // upload file via AJAX
    $('#statusCer').hide();
    $('#statusKey').hide();
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
                $('#uploadStatus').html('<p style="color:#EA4335;">Certificate tidak ada.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">Certificate berhasil dicadangkan</p>');
                    window.history.replaceState("Certificate berhasil dicadangkan", "p0t4t0", "backup_cert?p0t4t0");
                    $('#uploadForm').hide();
                    $('#statusCer').show();
                    $('#statusCer').on('submit', function(e) {
                      e.preventDefault();
                     window.location = 'potato?p0t4t0=cer';
                    });
                    $('#statusKey').show();
                    $('#statusKey').on('submit', function(e) {
                      e.preventDefault();
                      window.location = 'potato?p0t4t0=key';
                    });
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Certificate tidak ada.</p>');
                }
            }
        });
    });
});