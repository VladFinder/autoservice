<?php
// DB.php — класс для работы с базой данных через PDO
class DB {
    private $pdo;

    public function __construct() {
        $config = include 'config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCarsOutOfProduction() {
        $stmt = $this->pdo->query("SELECT cb.brand_name, cm.model_name, cm.production_end 
                                   FROM car_models cm
                                   JOIN car_brands cb ON cm.brand_id = cb.id
                                   WHERE cm.production_end <= '2018-09-30'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrentCarsAndServices() {
        $stmt = $this->pdo->query("SELECT cb.brand_name, cm.model_name, sp.service_name, sp.cost 
                                   FROM car_models cm
                                   JOIN car_brands cb ON cm.brand_id = cb.id
                                   JOIN service_prices sp ON sp.cost > 1000
                                   WHERE cm.production_end IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarsSortedByBodyType() {
        $stmt = $this->pdo->query("SELECT cb.brand_name, cm.model_name, cm.body_type 
                                   FROM car_models cm
                                   JOIN car_brands cb ON cm.brand_id = cb.id
                                   ORDER BY cm.body_type");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>