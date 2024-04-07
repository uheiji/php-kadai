<?php
session_start();
require('../dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['username'] === '') {
        $error['username'] = 'blank';
    }
    if ($_POST['nickname'] === '') {
        $error['nickname'] = 'blank';
    }
    if ($_POST['user_id'] === '') {
        $error['user_id'] = 'blank';
    }
    if (strlen($_POST['password']) < 8) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    if(empty($error)){
        $users = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE user_id=?');
        $users->execute(array($_POST['user_id']));
        $record = $users->fetch();
        if($record['cnt'] > 0){
            $error['user_id'] = 'duplicate';
        }
    }

    if (empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
}

if($_REQUEST['action'] == 'rewrite'){
    $_POST = $_SESSION['join'];
    $error['rewrite'] = true;
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
    <link rel="stylesheet" href="../style.css">
    <title>掲示板サイト</title>
</head>

<body>

    <div class="border col-8">
        <br>
        <h2>新規登録ページ</h2>
        <br>
        <div class="row">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <dl>
                        <div class="form-group">
                            <dt><label>ユーザーネーム：</label></dt>
                            <dd><input type="text" name="username" maxlength="255" class="form-control" placeholder="タナカ タロウ" value="<?php echo htmlspecialchars($_POST['username'] , ENT_QUOTES); ?>"></dd>
                            <?php if ($error['username'] == 'blank') : ?>
                                <p class="error">＊ユーザーネームを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <dt><label>ニックネーム：</label></dt>
                            <dd><input type="text" name="nickname" maxlength="255" class="form-control" placeholder="タロウ" value="<?php echo htmlspecialchars($_POST['nickname'] , ENT_QUOTES); ?>"></dd>
                            <?php if ($error['nickname'] == 'blank') : ?>
                                <p class="error">＊ニックネームを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <dt><label>ユーザーID：</label></dt>
                            <dd><input type="text" name="user_id" maxlength="255" class="form-control" placeholder="Tarou" value="<?php echo htmlspecialchars($_POST['user_id'] , ENT_QUOTES); ?>"></dd>
                            <?php if ($error['user_id'] == 'blank') : ?>
                                <p class="error">＊ユーザーIDを入力してください</p>
                            <?php endif; ?>
                            <?php if ($error['user_id'] == 'duplicate') : ?>
                                <p class="error">＊指定したユーザーIDはすでに登録されています</p><br>
                                <p class="error">＊ユニークなものを登録してみてください</p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <dt><label>パスワード：</label></dt>
                            <dd style="display: flex;">
                                <input type="password" name="password" maxlength="20" class="form-control" id="passwordInput" placeholder="半角英数字で８文字以上で入力してください" value="<?php echo htmlspecialchars($_POST['password'] , ENT_QUOTES); ?>">
                                <button id="showPasswordButton" style="width: 10%;">表示</button>
                            </dd>
                            <?php if ($error['password'] == 'blank') : ?>
                                <p class="error">＊パスワードを入力してください</p>
                            <?php endif; ?><br>
                            <?php if ($error['password'] == 'length') : ?>
                                <p class="error">＊パスワードは8文字以上で入力してください</p>
                            <?php endif; ?>
                        </div>
                    </dl>
                    <div class="row center-block text-center">
                        <div class="col-4">
                            <input type="submit" class="btn btn-outline-primary btn-block" value="入力内容を確認する">
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
    <script>    
        var showPasswordButton = document.getElementById("showPasswordButton");
        showPasswordButton.addEventListener("click", togglePasswordVisibility);

        function togglePasswordVisibility(event) {
            event.preventDefault(); // デフォルトのクリック動作をキャンセル

            var passwordInput = document.getElementById("passwordInput");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordButton.textContent = "非表示";
            } else {
                passwordInput.type = "password";
                showPasswordButton.textContent = "表示";
            }
        }
    </script>
</body>

</html>