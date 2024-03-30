<?php
session_start();
require('../dbconnect.php');

// URLパラメータが正しくしてされているか確認、なければトップに戻る
if (empty($_REQUEST['id'])) {
    header('Location: index.php');
    exit();
}

// htmlspecialcharsのショートカット
function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES);
}



$posts = $db->prepare('SELECT u.username, q.* FROM users u , questions q WHERE u.user_id=q.user_id AND q.id=? ORDER BY q.create_date DESC');
$posts->execute(array($_REQUEST['id']));

$answers = $db->prepare('SELECT u.username, q.*, a.* FROM users u , questions q , answers a WHERE a.question_id=q.id AND q.id=? AND a.user_id = u.user_id  ORDER BY q.create_date ASC');
$answers->execute(array($_REQUEST['id']));

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
    <div class="container question">
        <h1>質問詳細ページ</h1>
        <?php if ($post = $posts->fetch()) : ?>
            <div class="detail">
                <p class="detail__name"><?php echo h($post['username']); ?>さんの質問</p>
                <div class="detail__msg-wrap">
                    <p class="detail__msg"><?php echo h($post['body']); ?></p>
                    <span class="detail__day"><?php echo h($post['create_date']); ?></span>
                </div>
            </div>
        <?php else : ?>
            <p class="detail__error">その投稿は削除されたかURLが間違えています。</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['time'] + 3600 > time()) : ?>
            <a href="/answers/addanswer.php?res=<?php echo h($post['id']); ?>" class="answer-btn">この質問の回答をする</a>
        <?php else : ?>
            <p class="answer-btn">回答を投稿するにはログインしてください</p>
        <?php endif; ?>


        <?php if ($answers->rowCount() > 0) : ?>

            <div class="before-answer">
                <h2 class="before-answer-title">質問に対する回答</h2>
            </div>
            <?php while ($answer = $answers->fetch()) : ?>
                <div class="answer__item">
                    <p class="answer__item-name"><?php echo h($answer['username']); ?>さんの回答</p>
                    <div class="answer__item-msg-wrap">
                        <p class="answer__item-msg"><?php echo h($answer['body']); ?></p>
                        <span class="answer__item-day"><?php echo h($answer['create_date']); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="answer__item-msg-wrap">
                <p class="answer__item-msg">この質問に対する回答はありません</p>
            </div>
        <?php endif; ?>

        <a class="return" href="index.php">質問一覧に戻る</a>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>