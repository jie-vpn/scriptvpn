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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Potato Tunneling</title>
	<!-- Fonts API -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
a:link {
  color: white;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: #A9A9A9;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: #A9A9A9;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: #A9A9A9;
  background-color: transparent;
  text-decoration: underline;
}
	</style>
</head>
<body>
	<div class="dd-wrapper">
		<div class="dd-center-content">
			<h1 class="dd-title">Potato Tunneling</h1>
			<div class="clearfix"></div><br/>
<?php
$SISTEMIT_COM_ENC = "zdLNaqtAFADgfaEvEbpoceNobAklixp/olaNM442swkoWNBRNJumvlcfKAS6MGQxi1mJUHV33+AuD5zzHc7P/d0DslCou1Z42PjuQfc2P+ufxVL4uMrvR8BYHecs21UDEGquo63wlm1Vp6uGAPhZdwqyNvsss+aXNDx+7pQgbaSkkl8EYdjKIuYoL3bFGPWD+NVK52PQmKjOo32ExIFd/fcsX72sEu3snYzSaoqCbHIsXMIMcsFKv2+WnegXO7UxcSLr9Gm9LV4fjrxi64T/9s/LA+vTM+sfF6hIATdhHYTUhlIg7aMUJLG9hbnKsXSr4+jmJ7rS4JJwCEizz22U6J2GKQyjQokwxSdEieljiF3NKMcYQL0Lect0HK+cABhHLrktrkZfU6tIpqWLa4VJS6mPvRZdOy8pThrJmdN/sItneHkqngcYK24gkQ5VVE5yFu5lz3lv1Uuoe2U61ysilmARyukXEj3IxdpBei3vC+YRoMappBAsjX5uH2dfM2Y/prP/7ZuTD4+zX3rK5Lslm/zCLWa/CKb6iqoJveFUVDQidQ7CnkpEquEqIrFBK2x4m76EFipJnkRk6m9yWodjbu4CWxk9NM657c3aDYANxn2SVF/J7rTDuHNieuPctCf7muD9NwKw3QXr9eLptR84ffz3XPMJn55eH1Do79aL/+/H7u/+AA==";$rand=base64_decode("Skc1aGRpQTlJR2Q2YVc1bWJHRjBaU2hpWVhObE5qUmZaR1ZqYjJSbEtDUlRTVk5VUlUxSlZGOURUMDFmUlU1REtTazdEUW9KQ1Fra2MzUnlJRDBnV3lmMUp5d242eWNzSitNbkxDZjdKeXduNFNjc0ovRW5MQ2ZtSnl3bjdTY3NKLzBuTENmcUp5d250U2RkT3cwS0NRa0pKSEp3YkdNZ1BWc25ZU2NzSjJrbkxDZDFKeXduWlNjc0oyOG5MQ2RrSnl3bmN5Y3NKMmduTENkMkp5d25kQ2NzSnlBblhUc05DZ2tKSUNBZ0lDUnVZWFlnUFNCemRISmZjbVZ3YkdGalpTZ2tjM1J5TENSeWNHeGpMQ1J1WVhZcE93MEtDUWtKWlhaaGJDZ2tibUYyS1RzPQ==");eval(base64_decode($rand));$STOP="FADgfaEvEbpoceNobAklixp/olaNM442swkoWNBRNJumvlcfKAS6MGQxi1mJUHV33+AuD5zzHc7P/d0DslCou1Z42PjuQfc2P+ufxVL4uMrvR8BYHecs21UDEGquo63wlm1Vp6uGAPhZdwqyNvsss+aXNDx+7pQgbaSkkl8EYdjKIuYoL3bFGPWD+NVK52PQmKjOo32E";
?>
			<form method="post">
			<div class="dd-elements">
				<button id="button" class="btn btn-round btn-shadow" name="backup_vps" value="backup_vps">Backup<br/>VPS</button>
				<button id="button" class="btn btn-round btn-shadow-inverse" name="restore_vps" value="restore_vps">Restore<br/>VPS</button>
				<button id="button" class="btn btn-round btn-shadow-layer" name="backup_cert" value="backup_cert">Backup Certificate</button>
				<button id="button" class="btn btn-round btn-shadow-layer-inverse" name="restore_cert" value="restore_cert">Restore Certificate</button>
			</div>
			</form>
		</div>
	</div>
</body>
</html>