<?php
session_start();

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443 ? "https://" : "http://";

$page_url = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$page_index = "{$protocol}{$_SERVER['HTTP_HOST']}";


if ($_SESSION['status'] != "sudah_login") {
  session_unset();
  session_destroy();
  header("location: $page_index");
}

$_SESSION['potato'] = $_SERVER['REQUEST_URI'];

  $timeout = 5;
  $logout = "$page_index";
  
  $timeout = $timeout * 60;
  if (isset($_SESSION['start_session'])) {
    $elapsed_time = time()-$_SESSION['start_session'];
    if ($elapsed_time >= $timeout) {
      session_unset();
      session_destroy();
      echo "<script>alert('Sesi telah berakhir');window.location='$logout'</script>";
    }
  }
  $_SESSION['start_session']=time();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Restore Certificates</title>
	<link href="style.css" rel="stylesheet">
	<link href="button.css" rel="stylesheet">
	<link href="progress-bar.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/load_restore_cert.js"></script>
</head>

<body id="top">

	<header id="header">
		<div class="content">
			<h1>Restore Certificates</h1>
			<p>Potato Tunneling</p>
			<ul class="actions">
				<!-- Form upload file -->
				<form id="uploadForm" enctype="multipart/form-data">
				  <p>
				  <span id="info_cer_file"></span>
				  <label>CER : </label>
					<input type="file" name="file1" id="file1">
	        </p>
	        <p>
	        <span id="info_key_file"></span>
	        <label>KEY : </label>
					<input type="file" name="file2" id="file2">
					</p>
					<input type="submit" name="submit" value="UPLOAD"/>
				</form>
				
				<!-- Progress bar -->
				<div class="progress">
					<div class="progress-bar"></div>
				</div>
				
				<!-- Menampilkan status upload (sukses/gagal) -->
				<div id="uploadStatus"></div>
				
			</ul>
			<br><br>
			<br><br>
			<p>
			  <a href="fitur" class='tombol'>Back</a>
			</p>
			<br><br>
			<small><a href="https://github.com/potatonc/ScriptAutoInstallPotato">Script Tunneling by Potato</a></small><br><br>
		</div>
	</header>

</body>

</html>
