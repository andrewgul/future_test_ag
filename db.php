<? 
$host = "localhost";
$user = "root";
$password = "";
$db = "database";

$connect = mysqli_connect($host, $user, $password, $db);

if (!$connect) {
    echo "Не удалось подключиться к базе данных " . mysqli_connect_errno(); 
}