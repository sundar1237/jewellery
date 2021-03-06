<?php

function displayLoginPage($errMsg)
{
    ?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo MAIN_TITLE?> | Money Transfer Program">
<meta name="author"
	content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Jekyll v4.1.1">
<title><?php echo MAIN_TITLE?> | Money Transfer Program</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<style>
.bd-placeholder-img {
	font-size: 1.125rem;
	text-anchor: middle;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

@media ( min-width : 768px) {
	.bd-placeholder-img-lg {
		font-size: 3.5rem;
	}
}
</style>
<!-- Custom styles for this template -->
<link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
	
	<form class="form-signin" method="post" action="index.php">
				<h1 style="width: 100%;"><?php echo PROGRAM_TITLE ?></h1>			
				<input type='hidden' name='action' value='verifyUser'> <img
					class="mb-4" src="images/logo_saran.png" title="<?php echo MAIN_TITLE?>">
				<h5>Please Sign In</h5>
				<?php echo '<span class="badge badge-danger">'.$errMsg.'</span>'?>
				<label for="inputEmail" class="sr-only">Username</label> <input
					type="text" id="inputEmail" class="form-control"
					placeholder="Username" name="username" required autofocus> <label
					for="inputPassword" class="sr-only">Password</label> <input
					type="password" name="password" id="inputPassword"
					class="form-control" placeholder="Password" required>
				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign
					in</button>
				<p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
			</form>
</body>
</html>

<?php
}
?>

