<?php
require_once 'config.php';

// Простой запрос для проверки
try {
    $stmt = $pdo->query("SELECT 1");
    echo "Подключение к базе данных успешно!";
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
