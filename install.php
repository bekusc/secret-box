<?php

require_once 'classes/Hash.php';

if ($_POST) {

	$host = $_POST['db_host'];
	$dbname = $_POST['db_name'];
	$dbuser = $_POST['db_user'];
	$dbpw = $_POST['db_pw'];

	$username = $_POST['username'];
	$name = $_POST['name'];
	$salt = Hash::salt(32);
	$password = Hash::make($_POST['password'], $salt);
	$date = date('Y-m-d H:i:s');

	$pdo = new PDO("mysql:host={$host};dbname={$dbname}", $dbuser, $dbpw);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try {
		
		$pdo->query("CREATE TABLE IF NOT EXISTS `groups` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(50) NOT NULL,
			`permissions` text NOT NULL,
			PRIMARY KEY (`id`)
		)");

		$pdo->query("CREATE TABLE IF NOT EXISTS `users` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`username` varchar(20) NOT NULL,
			`name` varchar(50) NOT NULL,
			`password` varchar(255) NOT NULL,
			`salt` varchar(255) NOT NULL,
			`avatar` varchar(255) NOT NULL,
			`joined` datetime NOT NULL,
			`group_id` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		)");

		$pdo->query("CREATE TABLE IF NOT EXISTS `users_session` (
			`user_id` int(11) NOT NULL,
			`hash` varchar(255) NOT NULL
		)");

		$pdo->query("INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
			(1, 'Registered', ''),
			(2, 'Administrator', '{\"admin\" :1}')
		");

		$pdo->query("INSERT INTO `users` (
			`id`,
			`username`,
			`name`,
			`password`,
			`salt`,
			`avatar`,
			`joined`,
			`group_id`
		)
		VALUES (
			1,
			'{$username}',
			'{$name}',
			'{$password}',
			'{$salt}',
			'default.png',
			'{$date}',
			2
		)");

	} catch (Exception $e) {
		die($e->getMessage());
	}

	$content = "<?php

	\$GLOBALS['config'] = [
	    'mysql' => [
	        'host' => '{$host}',
	        'username' => '{$dbuser}',
	        'password' => '{$dbpw}',
	        'db' => '{$dbname}'
	    ],
	    'remember' => [
	        'cookie_name' => 'hash',
	        'cookie_expiry' => 604800
	    ],
	    'session' => [
	        'session_name' => 'user',
	        'token_name' => 'token'
	    ]
	];

?>";

	file_put_contents('config/config.php', $content);
	chmod('config/config.php', 0644);
	
	echo 'Database config successfull updated <br />';
	echo 'Congratulation! LogME was installed successful!<br />';
	echo 'Please delete file <b>install.php</b><br /><br />';
	die ('<a href="index.php">View your site.</a>');

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LogME - Installation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 450px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
		width: 100%;
      }
    </style>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST">

      	<h1>FRESH INSTALL</h1>

        <h2 class="form-signin-heading">Insert database information</h2>

        <input type="text" class="input-block-level" required placeholder="Database host" name="db_host">
        <input type="text" class="input-block-level" required placeholder="Database name" name="db_name">
        <input type="text" class="input-block-level" required placeholder="Database username" name="db_user">
        <input type="password" class="input-block-level" placeholder="Database user's password" name="db_pw">

        <h2 class="form-signin-heading">Admin account</h2>

        <input type="text" class="input-block-level" required placeholder="ADMIN's name" name="name">
        <input type="text" class="input-block-level" required placeholder="ADMIN's username" name="username">
        <input type="password" class="input-block-level" required placeholder="ADMIN's password" name="password">

        <button class="btn btn-large btn-primary" type="submit">Begin installing</button>
        
      </form>

    </div>

  </body>
</html>