<?php
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_login = $_SESSION['user_login'];
} else {
    header("Location: login.php");
    exit();
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
                <li><a href="car_2133">О нас</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="catalog.php">Каталог</a></li>
                <li class="action-btn right"><button class="btn" onclick="openModal('logout-modal')">Выйти</button></li> 
            </ul>
        </nav>
    </header>

   
    <div class="car-cards-container">
        <?php
            require_once('cards.php');
        ?>
        </div>

        
      


        <footer>
        <p>&copy; 2024 Мой сайт</p>
    </footer>

    <div id="logout-modal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="closeModal('logout-modal')">&times;</span>
            <h2>Выход</h2>
            <form action="logout.php" method="post">
                <button type="submit">да</button> 
                <button type="button"  onclick="closeModal('logout-modal')">нет</button>

            </form>
        </div>

        <div class="car-cards-container">
        <?php
            require_once('cards.php');
        ?>
        </div>

     

        <footer>
        <p>&copy; 2024 Мой сайт</p>
    </footer>
    <script src="asd.js"></script>
</body>
</html>

