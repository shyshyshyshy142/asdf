<?php
session_start();
require_once('fas.php');

$login = $_POST['login'];
$pass = $_POST['pass'];

if (empty($login) || empty($pass)) {
} else {
    $sql = "SELECT * FROM `users` WHERE login ='$login' AND pass ='$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_login'] = $row['login'];
        
        header("Location: pol.php");
        exit(); 
    } else {
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>ДрайвБезЗабот</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="catalog.php">Каталог</a></li>
                <li class="action-btn right"><button class="btn" onclick="openModal('logout-modal')">Выйти</button></li> 
            </ul>
        </nav>
    </header>

    <div id="logout-modal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="closeModal('logout-modal')">&times;</span>
            <h2>Выход</h2>
            <form action="logout.php" method="post">
                <button type="submit">да</button> 
                <button type="button"  onclick="closeModal('logout-modal')">нет</button>

            </form>

           
        </div>
    </div>



                <form action="login.php" method="post">
                <input type="text" placeholder='логин' name="login">
                <input type="text" placeholder='пароль' name="pass" style="-webkit-text-security: circle">
                <button type="submit">Войти</button>
                <a href="register.php"> зарегистрироватся</a>
                </form>
    
    <footer>
        <p>&copy; 2024 Мой сайт</p>
    </footer>
    <script src="asd.js"></script>
</body>
</html>







