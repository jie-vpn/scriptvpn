$(document).ready(function(){
    // upload file via AJAX
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
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
                $('#uploadStatus').html('<p style="color:#EA4335;">Restore gagal, silakan coba lagi.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">Certificate berhasil dipasang!</p>');
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Silakan pilih file yang valid untuk diupload.</p>');
                }
            }
        });
    });
	
    // memvalidasi file
   $("#file1").change(function(){
     fileobj = document.getElementById('file1').files[0];
     var fname = fileobj.name;
     var ext = fname.split(".").pop().toLowerCase();
     if(ext == "cer" || ext == "crt"){
     }else{
        alert("Accepted file .CER/.CRT only..");
        $("#file1").val("");
        return false;
     }
   });
   $("#file2").change(function(){
     fileobj = document.getElementById('file2').files[0];
     var fname = fileobj.name;
     var ext = fname.split(".").pop().toLowerCase();
     if(ext == "key"){
     }else{
        alert("Accepted file .KEY only..");
        $("#file2").val("");
        return false;
     }
   });
});