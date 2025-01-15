<?php
// index.php — основная страница для вывода данных
require 'DB.php';
$db = new DB();

$outOfProductionCars = $db->getCarsOutOfProduction();
$currentCarsAndServices = $db->getCurrentCarsAndServices();
$sortedCars = $db->getCarsSortedByBodyType();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автосервис</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Автомобили, снятые с производства на сентябрь 2018 года</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Модель</th>
                <th>Дата снятия с производства</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($outOfProductionCars as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['brand_name']) ?></td>
                <td><?= htmlspecialchars($car['model_name']) ?></td>
                <td><?= htmlspecialchars($car['production_end']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h1 class="my-4">Автомобили и работы, не снятые с производства, стоимость работ выше 1000 рублей</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Модель</th>
                <th>Наименование работ</th>
                <th>Стоимость работ</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($currentCarsAndServices as $service): ?>
            <tr>
                <td><?= htmlspecialchars($service['brand_name']) ?></td>
                <td><?= htmlspecialchars($service['model_name']) ?></td>
                <td><?= htmlspecialchars($service['service_name']) ?></td>
                <td><?= htmlspecialchars($service['cost']) ?> рублей</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h1 class="my-4">Автомобили, отсортированные по типу кузова</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Модель</th>
                <th>Тип кузова</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($sortedCars as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['brand_name']) ?></td>
                <td><?= htmlspecialchars($car['model_name']) ?></td>
                <td><?= htmlspecialchars($car['body_type']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>