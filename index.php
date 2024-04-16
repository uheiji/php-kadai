<?php 
session_start();
require('dbconnect.php');


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
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">知恵袋サイト</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="">ホーム<span class="sr-only">(current)</span></a>
        </li>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) : ?>
          <li class="nav-item">
            <a class="nav-link" href="users/mypage.php">マイページ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">ログアウトする</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">ログインする</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="join/index.php">新規登録</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

</header>

<body>
  <div class="container">
    <h1 class="fv__title">知恵袋サイトへようこそ</h1>
    <p class="fv__intro">
      ユーザー登録がまだの方はまずは<a href="join/index.php">新規登録</a>をお願いします<br>
      質問や回答を投稿する際はログインが必要です。
    </p>
    <div class="listBtn">
      <a href="question/" class="listBtn__item btn btn-success btn-lg">質問一覧へ</a>
      <!-- <a href="answers/" class="listBtn__item btn btn-primary btn-lg">回答一覧へ</a> -->
    </div>

  </div>
  <!-- <h1><?php echo($_SERVER['REQUEST_URI']);?>でアクセスがありました。</h1> -->



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>




