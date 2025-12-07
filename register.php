<?php
// Включаем вывод ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    
    // Проверяем, что все поля заполнены
    if (empty($name) || empty($email) || empty($phone)) {
        die("Ошибка: Все поля обязательны для заполнения!");
    }
    
    // Формируем данные для сохранения
    $data = "=== НОВАЯ РЕГИСТРАЦИЯ ===\n";
    $data .= "Имя: " . htmlspecialchars($name) . "\n";
    $data .= "Email: " . htmlspecialchars($email) . "\n";
    $data .= "Телефон: " . htmlspecialchars($phone) . "\n";
    $data .= "Дата регистрации: " . date('Y-m-d H:i:s') . "\n";
    $data .= "===========================\n\n";
    
    // 1. Сохраняем в общий файл users.txt
    $result1 = file_put_contents('users.txt', $data, FILE_APPEND);
    
    // 2. Создаем отдельный файл для этого пользователя
    $filename = 'user_' . date('Ymd_His') . '.txt';
    $result2 = file_put_contents($filename, $data);
    
    // Проверяем успешность сохранения
    if ($result1 !== false && $result2 !== false) {
        echo "<!DOCTYPE html>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Регистрация успешна</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    text-align: center; 
                    padding: 50px; 
                    background-color: #f5f5f5;
                }
                .success { 
                    background: white; 
                    padding: 30px; 
                    border-radius: 10px; 
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    display: inline-block;
                }
                .success h1 { color: green; }
            </style>
        </head>
        <body>
            <div class='success'>
                <h1>✅ Регистрация успешна!</h1>
                <p><strong>Имя:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Телефон:</strong> $phone</p>
                <p>Данные сохранены в файл: <strong>$filename</strong></p>
                <p><a href='index.html'>Вернуться на главную</a></p>
            </div>
        </body>
        </html>";
    } else {
        echo "<h1>❌ Ошибка при сохранении данных!</h1>";
        echo "<p>Проверьте права доступа к папке.</p>";
    }
} else {
    // Если кто-то попытался открыть этот файл напрямую без формы
    header('Location: index.html');
    exit();
}
?>