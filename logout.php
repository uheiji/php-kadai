<?php 
session_start();


$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 4200,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();


setcookie('user_id', '', time() - 3600);
setcookie('password', '', time() - 3600);

header('Location: login.php');
exit();
?>
