<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $users = $db->prepare('SELECT * FROM users WHERE user_id=?');
    $users->execute(array(
        $_SESSION['user_id']
    ));
    $users = $users->fetch();
} else {
    header('Location: ../login.php');
    exit();
}


if(!empty($_POST)){
        $profile = $db->prepare('UPDATE users SET  username=? ,user_id=?, nickname=?  WHERE user_id=?');
        $profile->execute(array(
            $_POST['username'],
            $_POST['user_id'],
            $_POST['nickname'],
            $_SESSION['user_id']
        ));

        header('Location: mypage.php'); exit();
}else{
    header('Location: mypage.php'); exit();
}
?>