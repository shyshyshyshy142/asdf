<?php
require_once('fas.php'); // Ensure this file contains the database connection

// Retrieve and sanitize input data
$login = trim($_POST['login']);
$pass = trim($_POST['pass']);
$repeatpass = trim($_POST['repeatpass']);
$email = trim($_POST['email']);

$errors = [];

// Validate input data
if (empty($login)) {
    $errors[] = "неверный логин";
}
if (empty($pass)) {
    $errors[] = "заполните пароль";
}
if (empty($repeatpass)) {
    $errors[] = "напишите повторно пароль";
}
if (empty($email)) {
    $errors[] = "заполните email";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "введен неверный email";
}
if ($pass !== $repeatpass) {
    $errors[] = "пароли не совпадают";
}

if (!empty($errors)) {
    echo "<script type='text/javascript'>alert('" . implode("\\n", $errors) . "');</script>";
} else {
    // Hash the password before storing it
    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `users` (login, pass, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $login, $hashed_pass, $email);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Registration successful.');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
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
            
                <form action="register.php" method="post">
                <input type="text" placeholder='логин' name="login">
                <input type="text" placeholder='пароль' name="pass" style="-webkit-text-security: circle">
                <input type="text" placeholder='повторение пароля' name="repeatpass"  style="-webkit-text-security: circle">
                <input type="text" placeholder='email' name="email">
                <button type="submit">Войти</button>
                <a href="login.php"> есть аккаунт</a>
                </form>
    
    <footer>
        <p>&copy; 2024 Мой сайт</p>
    </footer>
    <script src="asd.js"></script>
</body>
</html>