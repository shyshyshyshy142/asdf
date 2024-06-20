<?php
session_start();

// Проверьте, есть ли данные пользователя в сессии
if(isset($_SESSION['user_id'])) {
    // Используйте данные пользователя по мере необходимости
    $user_id = $_SESSION['user_id'];
    $user_login = $_SESSION['user_login'];
} else {
    // Если данные пользователя отсутствуют, перенаправьте его на страницу входа или выполните другие действия
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
                <li><a href="#">О нас</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="catalog.php">Каталог</a></li>

                <li class="action-btn right"><button class="btn" onclick="openModal('logout-modal')">Выйти</button></li>
            </ul>
        </nav>
    </header>
    <div class="header-image">
        <img src="image/RR-EVQ-24MY-AUTOBIOGRAPHY-DRIVING-210623-09-6498d07284479.jpg" alt="Большая картинка" class="header-image" />
    </div>

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
    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Информация о машине</title>
</head>
<body>

<?php
session_start();
require_once('fas.php');

if (!isset($_GET['car_id'])) {
    header("Location: index.php");
    exit;
}

$car_id = $_GET['car_id'];

$sql = "SELECT * FROM car WHERE номер_машины = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $car_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productbrand = $row["марка"];
            $productmodel = $row["модель"];
            $productimage = $row["img"];
            $productdescription = $row["описание"];
            $productnumber = $row["номер_машины"];
            $productprice = $row["стоимость"];

            echo "<h1>$productbrand $productmodel</h1>";
            echo "<img src='$productimage' alt='$productbrand $productmodel' style='width: 200px; height: auto;'><br>";
            echo "<p>$productdescription</p>";
            echo "<p>Стоимость: $productprice ₽/час</p>";
            echo "<form action='rentpage.php' method='GET'>";
            echo "<input type='hidden' name='car_id' value='$productnumber'>";
            echo "<label for='rentalDate'>Выберите дату аренды:</label>";
            echo "<input type='date' id='rentalDate' name='rentalDate' required><br>";
            echo "<label for='startTime'>Выберите время начала аренды:</label>";
            echo "<input type='time' id='startTime' name='startTime' required><br>";
            echo "<label for='endTime'>Выберите время окончания аренды:</label>";
            echo "<input type='time' id='endTime' name='endTime' required><br>";
            echo "<button type='submit'>Перейти к аренде</button>";
            echo "</form>";
        }
    } else {
        echo "Машина не найдена.";
    }

    $stmt->close();
} else {
    echo "Ошибка подготовки запроса: " . $conn->error;
}

$conn->close();
?>

</body>
</html>

    <div>
    <h2>Выберите время аренды:</h2>
    <form id="rentalForm">
        <label for="rentalDate">Дата:</label>
        <input type="date" id="rentalDate" name="rentalDate" required><br><br>
        
        <label for="startTime">Время начала:</label>
        <input type="time" id="startTime" name="startTime" required><br><br>
        
        <label for="endTime">Время окончания:</label>
        <input type="time" id="endTime" name="endTime" required><br><br>
        
        <input type="submit" value="Забронировать">
    </form>
</div>

    <div class="car-cards-container">
        <?php
            require_once('cards.php');
        ?>
    </div>

    <main>
        <section>
            <h2>О нас</h2>
            <p>Здесь можно описать вашу компанию.</p>
        </section>
        
        <section>
            <h2>Услуги</h2>
            <p>Здесь можно перечислить ваши услуги.</p>
        </section>
        
        <section>
            <h2>Контакты</h2>
            <p>Здесь можно добавить контактную информацию.</p>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Мой сайт</p>
    </footer>
    <script src="asd.js"></script>
</body>
</html>
