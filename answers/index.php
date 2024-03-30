<?php
session_start();
require('../dbconnect.php');

// htmlspecialcharsのショートカット
function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES);
}

// 本文内のURLにリンクを設定
function makeLink($value)
{
    return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%.!#~*/:@&=_-]+)", '<a href="\1\2">\1\2<a>', $value);
}

$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}

$page = max($page, 1);

$counts = $db->query('SELECT COUNT(*) AS cnt FROM answers');
$cnt = $counts->fetch();
$maxPage = ceil($cnt['cnt'] / 5);
$page = min($page, $maxPage);

$start = ($page - 1) * 5;
$answers = $db->prepare('SELECT u.nickname, a.* FROM users u, answers a WHERE u.user_id=a.user_id ORDER BY a.create_date ASC LIMIT ? , 5');
$answers->bindParam(1, $start, PDO::PARAM_INT);
$answers->execute();
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
        <h1>回答一覧ページ</h1>
        <div class="msg__lists">
            <?php
            foreach ($answers as $answer) :
            ?>
                <article class="msg__list">
                    <a href="detail.php?id=<?php echo h($post['id']) ?>">
                        <div class="msg__body">
                            <p class="msg__question"><?php echo makeLink(h($answer['body'])); ?><span class="name">(<?php echo h($answer['nickname']); ?>)</span></p>
                            <p class="msg__day"><?php echo h($answer['create_date']); ?></p>
                            <?php if ($_SESSION['user_id'] == $answer['user_id']) : ?>
                                [<a href="delete.php?id=<?php echo h($answer['id']); ?>" style="color:red;">削除</a>]
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
            <?php
            endforeach;
            ?>
        </div>
    </div>
    <ul class="page" style="text-align: center; margin-top:20px;">
        <?php
        if ($page > 1) {
        ?>
            <li style="display:inline;"><a href="index.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
        <?php
        } else {
        ?>
            <li style="display:inline;">前のページへ</li>
        <?php
        }
        ?>
        <?php
        if ($page < $maxPage) {
        ?>
            <li style="display:inline;"><a href="index.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
        <?php
        } else {
        ?>
            <li style="display:inline;">次のページへ</li>
        <?php
        }
        ?>
    </ul>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>