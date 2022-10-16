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

if (isset($_GET['p0t4t0'])) {
  $p0t4t0 = $_GET['p0t4t0'];
}

if ($_SESSION['potato'] == "/edited/backup_cert") {
    if ($p0t4t0 == "cer") {
  $fetch_domain = $_SESSION['domain'];

// Define file name and path 
$namefile = trim(shell_exec("ls /root/$fetch_domain/ | grep -w cer | grep -w $(date -d '89 days' +'%Y-%m-%d')"));
$fileName = $namefile;
$filePath = "/root/$fetch_domain/".$fileName;

if(!empty($fileName) && file_exists($filePath)){ 
    // Define headers 
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$fileName"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
     
    // Read the file 
    readfile($filePath); 
    exit;
}else{ 
  $update = "err";
}
  } elseif ($p0t4t0 == "key") {
  $fetch_domain = $_SESSION['domain'];

// Define file name and path 
$namefile = trim(shell_exec("ls /root/$fetch_domain/ | grep -w key | grep -w $(date -d '89 days' +'%Y-%m-%d')"));
$fileName = $namefile;
$filePath = "/root/$fetch_domain/".$fileName;

if(!empty($fileName) && file_exists($filePath)){ 
    // Define headers 
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$fileName"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
     
    // Read the file 
    readfile($filePath); 
    exit;
}else{ 
  $update = "err";
}
  } else {
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $domain = $_SESSION['domain'];

        if (!($resource=@ssh2_connect("$domain"))) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Athetication: ";
        if (!@ssh2_auth_password($resource,"$username","$password")) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Shell: ";
        //if (!($stdio = @ssh2_shell($resource,"xterm"))) {
        //        exit(1);
        //}
//        echo "[OK]<br />";
        //$command = "certb backup\n";
//        $command = "systemctl reset-failed local\n";
  //      $command = "systemctl restart local\n";
        //ob_start();
        //fwrite($stdio,$command);
        //sleep(15);
        //sleep(1);

        //while($line = fgets($stdio)) {
        //        flush();
                //echo $line."<br />";
        //}
        //$output_captured = ob_get_contents();
        //fclose($stdio);
        //ob_end_clean();
      $stdout_stream = ssh2_exec($resource, "certb backup");

      $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
      $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);
     
      stream_set_blocking($sio_stream, true);
      stream_set_blocking($err_stream, true);
     
      $result_dio = stream_get_contents($sio_stream);
      $result_err = stream_get_contents($err_stream);
// Define file name and path 
$fetch_domain = trim(shell_exec("cat /etc/v2ray/domain"));
$nameKey = trim(shell_exec("ls /root/$fetch_domain/ | grep -w key | grep -w $(date -d '89 days' +'%Y-%m-%d')"));
$nameCer = trim(shell_exec("ls /root/$fetch_domain/ | grep -w cer | grep -w $(date -d '89 days' +'%Y-%m-%d')"));
$fileCer = $nameCer;
$fileKey = $nameKey;
$filePath = "/root/$fetch_domain/".$fileCer; 

  if (!empty($fileCer) && file_exists($filePath)) {
    if (!empty($fileKey) && file_exists($filePath)) {
        $update = "ok";
      } else {
        $update = "err";
      }
  } else {
    $update = "err";
  }
} // $p0t4t0
} elseif ($_SESSION['potato'] == "/edited/backup_vps") {
    if ($p0t4t0 == "zip") {
  // Define file name and path 
$namefile = trim(shell_exec("ls /root/backup_vps/ | grep -w zip | grep -w $(date +'%Y-%m-%d')"));
$fileName = $namefile;
$filePath = '/root/backup_vps/'.$fileName;

if(!empty($fileName) && file_exists($filePath)){ 
    // Define headers 
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$fileName"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
     
    // Read the file 
    readfile($filePath); 
    exit;
}else{ 
  $update = "err";
}
  } else {
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$domain = $_SESSION['domain'];

        if (!($resource=@ssh2_connect("$domain"))) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Athetication: ";
        if (!@ssh2_auth_password($resource,"$username","$password")) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Shell: ";
        //if (!($stdio = @ssh2_shell($resource,"xterm"))) {
        //        exit(1);
        //}
//        echo "[OK]<br />";
        //$command = "pbup\n";
//        $command = "systemctl reset-failed local\n";
  //      $command = "systemctl restart local\n";
        //ob_start();
        //fwrite($stdio,$command);
        //sleep(15);
        //sleep(1);

        //while($line = fgets($stdio)) {
                //flush();
                //echo $line."<br />";
        //}
        //$output_captured = ob_get_contents();
        //fclose($stdio);
        //ob_end_clean();
      $stdout_stream = ssh2_exec($resource, "pbup");

      $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
      $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);
     
      stream_set_blocking($sio_stream, true);
      stream_set_blocking($err_stream, true);
     
      $result_dio = stream_get_contents($sio_stream);
      $result_err = stream_get_contents($err_stream);
// Define file name and path 
$namefile = trim(shell_exec("ls /root/backup_vps/ | grep -w zip | grep -w $(date +'%Y-%m-%d')"));
$fileName = $namefile;
$filePath = '/root/backup_vps/'.$fileName; 

if (!empty($fileName) && file_exists($filePath)) {
  $update = "ok";
} else {
  $update = "err";
}
} // $p0t4t0
} elseif ($_SESSION['potato'] == "/edited/restore_cert") {
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$domain = $_SESSION['domain'];

$dir = "/root/restore-cert/";
if(!is_dir($dir)){
  mkdir($dir, 0777);
  chmod($dir, 0777);
}

if(!empty($_FILES['file1']['name'])){
  if(!empty($_FILES['file2']['name'])){
    
    // File Cer
    $cer = $_FILES['file1']['name'];
    $to = $_FILES['file1']['tmp_name'];
    $size = $_FILES['file1']['size'];
    $new = "fullchain".".".pathinfo($cer, PATHINFO_EXTENSION); 
    
    // File Key
    $key = $_FILES['file2']['name'];
    $too = $_FILES['file2']['tmp_name'];
    $sizee = $_FILES['file2']['size'];
    $neww = "keyfile".".".pathinfo($key, PATHINFO_EXTENSION);
    $max = 6000;
    
    if($size < $max){
      if($sizee < $max){
        $move = move_uploaded_file($to,$dir.$new);
        $movee = move_uploaded_file($too,$dir.$neww);
    
        if($move){
          if($movee){
        if (!($resource=@ssh2_connect("$domain"))) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Athetication: ";
        if (!@ssh2_auth_password($resource,"$username","$password")) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Shell: ";
        //if (!($stdio = @ssh2_shell($resource,"xterm"))) {
        //        exit(1);
        //}
//        echo "[OK]<br />";
        //$command = "/usr/sbin/certr restore\n";
//        $command = "systemctl reset-failed local\n";
  //      $command = "systemctl restart local\n";
        //fwrite($stdio,$command);
        //sleep(15);
        //fclose($stdio);
      $stdout_stream = ssh2_exec($resource, "certr restore");

      $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
      $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);
     
      stream_set_blocking($sio_stream, true);
      stream_set_blocking($err_stream, true);
     
      $result_dio = stream_get_contents($sio_stream);
      $result_err = stream_get_contents($err_stream);
    
        $sys = trim(shell_exec('systemctl is-active local'));
    
        if ($sys == "active") {
          $update = "ok";
        } else {
          $update = "err";
        }
          } else {
            $update = "err";
          }
        } else {
          $update = "err";
        }
      } else {
        $update = "err";
      }  // $maxx
    } else {
      $update = "err";
    } // $max
  } else {
    $update = "err";
  }
} else {
  $update = "err";
}
} elseif ($_SESSION['potato'] == "/edited/restore_vps") {
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$domain = $_SESSION['domain'];

$dir = "/root/";
if(is_dir($dir)){
  chmod($dir, 0777);
}

if(!empty($_FILES['file1']['name'])){
    
    // File Cer
    $cer = $_FILES['file1']['name'];
    $to = $_FILES['file1']['tmp_name'];
    $size = $_FILES['file1']['size'];
    $new = "backup".".".pathinfo($cer, PATHINFO_EXTENSION); 
    
        $move = move_uploaded_file($to,$dir.$new);
    
        if($move){
        if (!($resource=@ssh2_connect("$domain"))) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Athetication: ";
        if (!@ssh2_auth_password($resource,"$username","$password")) {
                exit(1);
        }
//        echo "[OK]<br />";

//        echo "Shell: ";
        //if (!($stdio = @ssh2_shell($resource,"xterm"))) {
        //        exit(1);
        //}
//        echo "[OK]<br />";
        //$command = "/usr/sbin/rstorv\n";
//        $command = "systemctl reset-failed local\n";
  //      $command = "systemctl restart local\n";
        //fwrite($stdio,$command);
        //sleep(15);
        //fclose($stdio);
      $stdout_stream = ssh2_exec($resource, "rstorv");

      $sio_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDIO);
      $err_stream = ssh2_fetch_stream($stdout_stream, SSH2_STREAM_STDERR);
     
      stream_set_blocking($sio_stream, true);
      stream_set_blocking($err_stream, true);
     
      $result_dio = stream_get_contents($sio_stream);
      $result_err = stream_get_contents($err_stream);
    
        $sys = trim(shell_exec('systemctl is-active local'));
    
            if ($sys == "active") {
              $update = "ok";
            } else {
              $update = "err";
            }
        } else {
          $update = "err";
        }
} else {
  $update = "err";
}
} else {
  echo $update;
}

echo $update;
?>