<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прокат автомобилей</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .car-rent {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .car-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
        }
        .car-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            flex-grow: 1;
        }
        .car-details h3 {
            margin-top: 0;
        }
        .rental-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        .rental-form label {
            display: block;
            margin-bottom: 5px;
        }
        .rental-form input[type="datetime-local"] {
            margin-bottom: 10px;
            width: calc(100% - 20px);
            max-width: 300px;
        }
        .rental-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .rental-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <main>
        <?php
        session_start();
        require_once('fas.php');

        // Проверяем, предоставлен ли car_id в URL
        if (!isset($_GET['car_id'])) {
            header("Location: index.php"); // Перенаправляем на страницу индекса, если car_id не предоставлен
        }

        $car_id = $_GET['car_id'];

        // Подготавливаем SQL-запрос для получения информации о машине
        $sql = "SELECT * FROM car WHERE `номер машины` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $car_id); // Привязываем параметр car_id
            $stmt->execute();

            $result = $stmt->get_result();

            // Проверяем, найдена ли машина
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productbrand = $row["марка"];
                    $productmodel = $row["модель"];
                    $productimage = $row["img"];
                    $productdescription = $row["описание"];
                    $productnumber = $row['номер машины'];
                    $productprice = $row["стоимость"];
                    $isrented = $row["аренда"];

                    // Отображаем информацию о машине, если она не арендована
                    if ($isrented == 0) {
                        echo "<div class='car-rent'>";
                        echo "<img src='$productimage' alt='$productbrand $productmodel' class='car-image'>";
                        echo "<div class='car-details'>";
                        echo "<h3>$productbrand $productmodel</h3>";
                        echo "<p><strong>Номер автомабиля:</strong> $productnumber</p>";
                        echo "<p><strong>комплнетация:</strong> $productdescription</p>";
                        echo "<p><strong>Стоимость:</strong> $productprice ₽/час</p>";
                        echo "<form action='process_rent.php' method='post' class='rental-form'>";
                        echo "<input type='hidden' name='car_id' value='$car_id'>";
                        echo "<label for='rental_start_datetime'>Дата и время начала аренды:</label>";
                        echo "<input type='datetime-local' id='rental_start_datetime' name='rental_start_datetime' required><br>";
                        echo "<label for='rental_end_datetime'>Дата и время окончания аренды:</label>";
                        echo "<input type='datetime-local' id='rental_end_datetime' name='rental_end_datetime' required><br>";
                        echo "<button type='submit'>Арендовать</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            } else {
                echo "Машина не найдена."; // Выводим сообщение, если машина не найдена
            }

            $stmt->close(); // Закрываем подготовленный запрос
        } else {
            echo "Ошибка подготовки запроса: " . $conn->error; // Выводим сообщение об ошибке, если подготовка запроса не удалась
        }

        $conn->close(); // Закрываем соединение с базой данных
        ?>
    </main>
</body>
</html>
