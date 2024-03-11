<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

if(!empty($_POST)){
    $statement = $db->prepare('INSERT INTO users SET username=?, password=?, nickname=?, create_date=NOW(), update_date=CURRENT_TIMESTAMP ,user_id=?');
    $ret = $statement->execute(array(
        $_SESSION['join']['username'],
        password_hash($_SESSION['join']['password'], PASSWORD_DEFAULT), // パスワードを安全にハッシュ化する
        $_SESSION['join']['nickname'],
        $_SESSION['join']['user_id']
    ));
    unset($_SESSION['join']);

    // ヘッダー情報の送信前に出力がないようにする
    header('Location: thanks.php');
    exit(); // ヘッダー情報の送信後にコードの実行を終了する
}
?>
<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>掲示板サイト</title>
</head>

<body>
    <br>
    <h1>掲示板サイト</h1>
    <br>

    <div class="border col-8">
        <br>
        <h2></h2>
        <br>
        <div class="row">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="submit">
                    <dl>
                        <div class="form-group">
                            <dt><label>ユーザーネーム：</label></dt>
                            <dd><?php echo htmlspecialchars($_SESSION['join']['username'] , ENT_QUOTES); ?></dd>
                        </div>
                        <div class="form-group">
                            <dt><label>ユーザーネーム：</label></dt>
                            <dd><?php echo htmlspecialchars($_SESSION['join']['nickname'] , ENT_QUOTES); ?></dd>
                        </div>
                        <div class="form-group">
                            <dt><label>ユーザーID：</label></dt>
                            <dd><?php echo htmlspecialchars($_SESSION['join']['user_id'] , ENT_QUOTES); ?></dd>
                        </div>
                        <div class="form-group">
                            <dt><label>パスワード：</label></dt>
                            <dd><?php echo htmlspecialchars($_SESSION['join']['password'] , ENT_QUOTES); ?></dd>
                        </div>
                    </dl>
                    <div class="row center-block text-center">
                        <div class="col-4">
                            <a href="index.php?action=rewrite" class="btn btn-outline-secondary btn-block">書き直す</a>
                            <input type="submit" class="btn btn-outline-primary btn-block" value="登録する">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>