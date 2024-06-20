<?php
session_start();

if(isset($_POST['rent_button'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    require_once('fas.php');

    $rental_date = $_POST['rental_date'];
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['user_id'];

    if (empty($rental_date) || empty($car_id)) {
        echo "Пожалуйста, заполните все поля формы.";
        exit();
    }

    $sql = "INSERT INTO rent_history (car_id, user_id, rent_date) VALUES ('$car_id', '$user_id', '$rental_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Автомобиль успешно арендован!";
    } else {
        echo "Ошибка при аренде автомобиля: " . $conn->error;
    }
} else {
    header("Location: rentpage.php");
    exit();
}
?>
