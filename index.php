<?php
    include 'db.php';

    if (!empty($_POST['com_author']) && !empty($_POST['com_text'])) {

        // Дата в подходящем формате для MySQL DATETIME
        $date = date('Y-m-d H:i:s', time());

        $query_result = mysqli_query($connect, "INSERT INTO comments (`id`, `author`, `text`,  `datetime`) VALUES (NULL, '$_POST[com_author]', '$_POST[com_text]', '$date')");

        if (!$query_result) {
            echo mysqli_error($connect);
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
    <title>Комментарии</title>
</head>
    <header class="header">
        <div class="container-header">
            <div class="header-left">
                <div class="header-info">
                    <p class="info info-ph">Телефон: (499) 340-94-71</p>
                    <p class="info">Email: <u>info@future-group.ru</u></p>
                </div>
                <p class="header-title">Комментарии</p>
            </div>
            <div class="header-right">
                <img src="logo.jpg" alt="Future Logo">
            </div>
        </div>
    </header>
    <section class="comment-section">
        <div class="container-comments">
            <div class="comments">
                <?php
                $result = mysqli_query($connect, "SELECT * FROM `comments`");

                if (!$result->num_rows) {
                ?>
                    <p class="no-comments">Комментариев пока нет... :(<p>
                <?php
                } else {
                $comments = [];
                while ($com = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $comments[] = $com;
                }
                // Для того, чтобы сначала в массиве шли последние добавленные комментарии
                $comments = array_reverse($comments);

                foreach ($comments as $comment) {
                $date = new DateTime($comment['datetime']);
                ?>
                <div class="comment">
                    <div class="com-info">
                        <span class="com-author"><b><?=$comment['author']?></b></span>
                        <span class="com-time"><?=$date->format('H:i')?></span>
                        <span class="com-date"><?=$date->format('d/m/Y')?></span>
                    </div>
                    <p class="com-text"><?=$comment['text']?></p>
                </div>
                <?php
                }
                }
                ?>
            </div>
            <hr class="com-hr">
            <div class="new-com">
                <form method="POST">
                    <p class="leave-a-com">Оставить комментарий</p>
                    <p class="new-com-label">Ваше имя</p>
                    <input type="text" name="com_author" class="new-com-author">
                    <p class="new-com-label">Ваш комментарий</p>
                    <textarea name="com_text" id="" cols="30" rows="10" class="com-textarea"></textarea>
                    <div class="div-btn">
                        <button class="com-btn">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container-footer">
            <img src="logo.jpg" alt="Future Logo" class="footer-logo">
            <div class="footer-info">
                <p class="footer-info-item">Телефон: (499) 340-94-71</p>
                <p class="footer-info-item">Email: <u>info@future-group.ru</u></p>
                <p class="footer-info-item">Адрес: <u>115088 Москва, ул. 2-я Машиностроения, д.7 стр. 1</u></p>
                <p class="footer-info-item">© 2010 - 2014 Future. Все права защищены</p>
            </div>
        </div>
    </footer>
</body>
</html>