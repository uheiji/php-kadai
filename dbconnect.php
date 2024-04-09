<?php
try {
    $db = new PDO('mysql:host=mysql;dbname=my_bbs;charset=utf8mb4', 'test', 'test');
    // PDOをエラー発生時に例外をスローするように設定
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
}
?>