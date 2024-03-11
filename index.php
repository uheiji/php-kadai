
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
                <form action="" method="post"  enctype="multipart/form-data">
                    <dl>
                        <div class="form-group">
                            <dt><label>ユーザーネーム：</label></dt>
                            <dd><input type="text" name="name" maxlength="255" class="form-control" placeholder=""></dd>
                        </div>
                        <div class="form-group">
                            <dt><label>ユーザーID：</label></dt>
                            <dd><input type="text" name="id" maxlength="255" class="form-control" placeholder=""></dd>
                        </div>
                        <div class="form-group">
                            <dt><label>パスワード：</label></dt>
                            <dd><input type="text" name="password" maxlength="20" class="form-control" placeholder=""></dd>
                        </div>
                    </dl>
                </form>
            </div>
        </div>
        <div class="row center-block text-center">
            <div class="col-4">
                <input type="submit" class="btn btn-outline-primary btn-block" value="入力内容を確認する">
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
<?php
phpinfo();
?>