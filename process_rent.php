
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
                <li><a href="pol.php">Главная</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="catalog.php">Каталог</a></li>
                <li class="action-btn right"><button class="btn" onclick="openModal('logout-modal')">Выйти</button></li>
            </ul>
        </nav>
        </header>

        <?php
session_start();
require_once('fas.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rental_start_datetime = $_POST['rental_start_datetime'];
    $rental_end_datetime = $_POST['rental_end_datetime'];

    $car_id = $_POST['car_id']; 
    $user_login = $_SESSION['user_login']; 
    if (!empty($rental_start_datetime) && !empty($rental_end_datetime)) {
        $sql_insert = "INSERT INTO rent_history (car, user_login, rent_data, rent_data_ends, ends) VALUES ('$car_id', '$user_login', '$rental_start_datetime', '$rental_end_datetime', FALSE)";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Заявка на аренду успешно отправлена!";

            $sql_update = "UPDATE car SET аренда = FALSE WHERE id = '$car_id'";
            if ($conn->query($sql_update) === TRUE) {
                echo "Статус аренды успешно обновлен в базе данных.";
            } else {
                echo "Ошибка при обновлении статуса аренды: " . $conn->error;
            }

        } else {
            echo "Ошибка при добавлении в историю аренды: " . $conn->error;
        }
    } else {
        echo "Пожалуйста, укажите дату и время начала и окончания аренды.";
    }
}
?>
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


</body>
</html>
