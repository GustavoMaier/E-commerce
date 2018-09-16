<?php
	session_start();
	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	session_destroy();
	echo '<meta http-equiv="refresh" content="0; url=index.php">';
?>