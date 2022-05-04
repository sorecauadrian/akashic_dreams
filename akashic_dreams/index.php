<?php
    session_start();

    require_once "./module/functions.php";

	$page = 'main';
    if (isset($_GET['page']))
	{
        if(in_array($_GET['page'], ['main', 'logout', 'delete_account', 'add_dream', 'login_signup']))
            $page = trim($_GET['page']);
        else
            $page = 404;
	}
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
		$page = 'login_signup';

    $file = "./pages/{$page}.php";
    if (file_exists($file))
        include $file;
    else
        include "./pages/404.php";

    $text_color = (isset($_SESSION['culoare_text'])? $_SESSION['culoare_text'] : "light");

?>