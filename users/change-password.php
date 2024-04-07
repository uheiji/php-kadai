<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    $users = $db->prepare('SELECT * FROM users WHERE user_id=?');
    $users->execute(array(
        $_SESSION['user_id']
    ));
    $user = $users->fetch();

    // パスワード変更処理
    $newPass = $_POST['newPassword'];
    $confimPass = $_POST['confirmPassword'];
    $passwordClear = '';
    $passwordChange = '';
    if (!empty($_POST['submit'])) {
        if ($user['password'] === sha1($_POST['currentPassword'])) {
            // 現在のパスワードが正しい場合、新しいパスワードと確認用のパスワードが一致しているか確認する
            if ($newPass === $confimPass) {
                $changePass = $db->prepare('UPDATE users SET password=? WHERE user_id=?');
                $changePass->execute(array(
                    sha1($newPass),
                    $_SESSION['user_id']
                ));
                $passwordChange = 'パスワードが変更されました';
            } else {
                $error['password'] = 'mismatchConfim'; // 確認用パスワードが一致しない場合のエラー
            }
        } else {
            $error['password'] = 'mismatch'; // 現在のパスワードが一致しない場合のエラー
        }
    }
} else {
    header('Location: ../login.php');
    exit();
}


// htmlspecialcharsのショートカット
function h($value)
{
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>掲示板サイト</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">知恵袋サイト</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">ホーム<span class="sr-only">(current)</span></a>
                </li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/mypage.php">マイページ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">ログアウトする</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.php">ログインする</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../join/index.php">新規登録</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
            </form>
        </div>
    </nav>

</header>

<body>
    <div class="container">
        <h1 class="title">マイページ</h1>
        <div class="mypage__header">
            <p class="mypage__head"><span><?php echo $user['username']; ?></span> さん</p>
        </div>
        <dl class="profile">
        <form action="" method="post">
            <div>
                <p>パスワード変更</p>
            </div>
            <div>
                <dt>現在のパスワード:</dt>
                <dd class="password-container">
                    <input type="password" name="currentPassword" id="currentPasswordInput">
                    <button class="toggle-password-button" data-target="currentPasswordInput">表示</button>
                </dd>
            </div>
            <?php if (isset($error['password']) && $error['password'] === 'mismatch') : ?>
                <p class="error">＊現在のパスワードが正しくありません</p>
            <?php endif; ?>
            <div>
                <dt>新しいパスワード:</dt>
                <dd class="password-container">
                    <input type="password" name="newPassword" id="newPasswordInput" >
                    <button class="toggle-password-button" data-target="newPasswordInput">表示</button>
                </dd>
            </div>
            <div>
                <dt>新しいパスワード（確認用）:</dt>
                <dd class="password-container">
                    <input type="password" name="confirmPassword" id="confirmPasswordInput">
                    <button class="toggle-password-button" data-target="confirmPasswordInput">表示</button>
                </dd>
            </div>
            <?php if (isset($error['password']) && $error['password'] === 'mismatchConfim') : ?>
                <p class="error">＊新しいパスワードと確認用パスワードが一致しません</p>
            <?php endif; ?>
            <div class="row center-block text-center">
                <div class="col-4">
                    <input type="submit" class="btn btn-outline-primary btn-block" name="submit" value="変更する">
                </div>
            </div>
        </form>
        </dl>
        <p ><?php echo $passwordChange; ?></p>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        var togglePasswordButtons = document.querySelectorAll(".toggle-password-button");
        togglePasswordButtons.forEach(function(button) {
            button.addEventListener("click", togglePasswordVisibility);
        });

        function togglePasswordVisibility(event) {
            event.preventDefault();

            var targetId = this.getAttribute("data-target");
            var passwordInput = document.getElementById(targetId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.textContent = "非表示";
            } else {
                passwordInput.type = "password";
                this.textContent = "表示";
            }
        }
    </script>
</body>

</html>