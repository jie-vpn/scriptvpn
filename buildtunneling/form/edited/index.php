<!DOCTYPE html>
<html>
<head>
	<title>Login With Password VPS Server</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body {
			background-color: #7a58ff;
			font-family: "Segoe UI";
			width: 100%;
		}
		#wrapper {
			background-color: #fff;
			width: 400px;
			height: 500px;
			margin-top: 120px;
			margin-left: auto;
			margin-right: auto;
			padding: 20px;
			border-radius: 4px;
		}
		input[type=text], input[type=password] {
			border: 1px solid #ddd;
			padding: 10px;
			width: 95%;
			border-radius: 2px;
			outline: none;
			margin-top: 10px;
			margin-bottom: 20px;
		}
		label, h1 {
			text-transform: uppercase;
			font-weight: bold;
		}
		h1 {
			text-align: center;
			font-size: 40px;
			color: #7a58ff;
		}
		button {
			border-radius: 2px;
			padding: 10px;
			width: 120px;
			background-color: #7a58ff;
			border: none;
			text-align: center;
			color: #fff;
			font-weight: bold;
		}
		.error {
			background-color: #f72a68;
			width: 400px;
			height: auto;
			margin-top: 20px;
			margin-left: auto;
			margin-right: auto;
			padding: 20px;
			border-radius: 4px;
			color: #fff;

		}
	</style>
</head>
<body>
	<div id="wrapper">
		<form action="logincontroller" method="post">
		  <h1>Potato Tunneling</h1>
			<h1>Login</h1>
<?php
$user = "root";
?>
			<input type="text" name="domain" id="domain" value="<?php echo $_SERVER['SERVER_NAME']; ?>" required="" autofocus="" readonly="readonly">
			
			<input type="text" name="username" id="username" value="<?php echo $user; ?>" required="" autofocus="" readonly="readonly">
			
			<input type="password" name="password" id="password" placeholder="Masukkan Password" required="" >
			<input type="checkbox" class="form-check-input" id="show-password"> Show password
			<br/><br/>
			<button type="submit" name="submit">SUBMIT</button>
		</form>
	</div>
	  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script>
        $(document).ready(function() {
            $('#show-password').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });
      </script>
	
		<?php if(isset($_GET['pesan'])) { ?>
			<div class="error">
				<label>Oopps... <?php echo $_GET['pesan']; ?></label>
			</div>
		<?php } ?>
</body>
</html>