<?php
require_once('fas.php');
session_start();

$sql = "SELECT * FROM car";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='card-container'>";

    while ($row = $result->fetch_assoc()) {
        $productbrand = $row["марка"];
        $productmodel = $row["модель"];
        $productimage = $row["img"];
        $productdescription = $row["описание"];
        $productnumber = $row["номер машины"];
        $productprice = $row["стоимость"];
        $isrented = $row["аренда"];

        if ($isrented == 0) {
            echo "<div class='card' style='width: 18rem;'>";
            echo "<img src='$productimage' class='card-img-top' alt='$productbrand $productmodel'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>$productbrand $productmodel</h5>";
            echo "<p class='card-text'>Стоимость: $productprice ₽/час</p>";
            echo "<form action='rentpage.php' method='GET'>";
            echo "<input type='hidden' name='car_id' value='$productnumber'>";
            echo "<button type='submit' class='btn btn-primary mx-auto'>Перейти к аренде</button>"; // Добавлен класс 'mx-auto' для центрирования кнопки
            echo "</form>";





            
            echo "</div>";
            echo "</div>";

            
        }
    }

    

    echo "</div>";
} else {
    echo "Машины не найдены.";
}

$conn->close();
?>
