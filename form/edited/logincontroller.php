<?php
session_start();

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443 ? "https://" : "http://";

$page_url = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$page_index = "{$protocol}{$_SERVER['HTTP_HOST']}";

if(isset($_REQUEST['submit'])){
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  $domain = $_REQUEST['domain'];
  
  $connection = ssh2_connect($domain, 22);

    if (ssh2_auth_password($connection, $username, $password)) {
      $_SESSION['status'] = "sudah_login";
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      $_SESSION['domain'] = $domain;
      echo "<script>alert('Authentication Successfully!');</script>";
      header("location: fitur");
    } else {
      session_unset();
      session_destroy();
      echo "<script>alert('Authentication Failed!');window.location.replace('$page_index');;</script>";
    }
} else {
  session_unset();
  session_destroy();
  header("location: $page_index");
}

?>