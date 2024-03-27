<?php 
    session_start();
    require('../dbconnect.php');
    if(isset($_SESSION['user_id'])){
        $id = $_REQUEST['id'];

        $message = $db->prepare('SELECT * FROM answers WHERE id=?');
        $message->execute(array($id));
        $message = $message->fetch();

        if($message['user_id'] == $_SESSION['user_id']){
            $del = $db->prepare('DELETE FROM answers WHERE id=?');
            $del->execute(array($id));
        }
    }

    header('Location: index.php');
    exit();

?>
