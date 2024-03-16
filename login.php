<?php
require('dbconnect.php');

session_start();

if($_COOKIE['user_id'] != ''){
    $_POST['user_id'] = $_COOKIE['user_id'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['save'] = 'on';
}

if (!empty($_POST)) {
    if ($_POST['user_id'] != '' && $_POST['password'] != '') {
        $login = $db->prepare('SELECT * FROM users WHERE user_id=? AND password=?');
        $login->execute(array(
            $_POST['user_id'],
            sha1($_POST['password'])
        ));
        $users = $login->fetch();

        if ($users) {
            $_SESSION['user_id'] = $users['user_id'];
            $_SESSION['time'] = time();

            if($_POST['save'] == 'on'){
                setcookie('user_id' ,$_POST['user_id'] , time()+60*60*24*14);
                setcookie('password' ,$_POST['password'] , time()+60*60*24*14);
            }

            header('Location: question/index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
    }
}
// htmlspecialcharsのショートカット
    function h($value){
    return htmlspecialchars($value, ENT_QUOTES);
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
    <link rel="stylesheet" href="/style.css">
    <title>掲示板サイト</title>
</head>

<body>

    <br>
    <h1>掲示板サイト</h1>
    <br>

    <h2>ログインページ</h2>

    <div class="border col-8 bg-primary">
        <div class="register">
            <p>ユーザーIDとパスワードを記入してログインしてください</p>
            <p>登録がまだの方はこちらからどうぞ</p>
            <a href="join/index.php">>会員登録をする</a>
        </div>
    </div>

    <div class="border col-8">
        <br>
        <br>
        <div class="row">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <dl>
                        <div class="form-group">
                            <dt><label>ユーザーID：</label></dt>
                            <dd><input type="text" name="user_id" maxlength="255" class="form-control" placeholder="" value="<?php echo h($_POST['user_id']); ?>"></dd>
                            <?php if ($error['login'] == 'blank') : ?>
                                <p class="error">＊ユーザーIDとパスワードを入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['login'] == 'failed') : ?>
                                <p class="error">＊ログインに失敗しました。正しくご記入ください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <dt><label>パスワード：</label></dt>
                            <dd><input type="password" name="password" maxlength="20" class="form-control" placeholder="" value="<?php echo h($_POST['password']); ?>"></dd>
                        </div>
                    </dl>
                    <div class="row center-block text-center">
                        <div class="form-group">
                            <input id="save" type="checkbox" name="save" value="on">
                            <label for="save">次回からは自動的にログインする</label>
                        </div>
                        <div class="col-4">
                            <input type="submit" class="btn btn-outline-primary btn-block" value="ログインする">
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