<? 
// $host, $username, $password скорее всего нужно будет поменять на свои

// Название хоста, на котором расположен MySQL-сервер (обычно это localhost)
$host = "localhost";
// Имя пользователя БД (может быть root, admin)
$user = "root";
// Пароль для указанного выше пользователя
$password = "";
$db = "database";

$connect = mysqli_connect($host, $user, $password, $db);

if (!$connect) {
    echo "Не удалось подключиться к базе данных " . mysqli_connect_errno(); 
}