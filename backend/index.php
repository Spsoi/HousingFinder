<?php

// // Устанавливаем заголовки для разрешения CORS
// header('Access-Control-Allow-Origin: *'); // Разрешаем доступ с любого домена (уточните, если требуется ограничить доступ)
// header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Разрешаем использовать определенные методы (GET, POST, OPTIONS)
// header('Access-Control-Allow-Headers: Content-Type'); // Разрешаем отправку заголовка Content-Type
// Включаем CORS для всех доменов
header('Access-Control-Allow-Origin: *');

// Разрешаем определенные HTTP-методы
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// Разрешаем определенные заголовки
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

// Устанавливаем флаг, чтобы разрешить кэширование предзапросов CORS на время до 1 часа
header('Access-Control-Max-Age: 3600');

// // Обработка предварительных запросов (preflight) для сложных запросов
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(204);
//     exit;
// }
// Обработка опций предварительного запроса (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require __DIR__ . '/public/index.php';
// require __DIR__ . '/config/config.php';
