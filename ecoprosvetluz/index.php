<?php
// URL API
$apiUrl = "http://localhost:8080/ecocore/api/v1/event";

// Инициализация cURL
$ch = curl_init($apiUrl);

// Настройка cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на ошибки
if ($response === false) {
    die('Ошибка cURL: ' . curl_error($ch));
}

// Закрытие cURL
curl_close($ch);

// Декодирование JSON ответа
$newsList = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <style>
        .news-card {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px 0;
        }
        .news-header {
            font-size: 1.5em;
            margin-bottom: 8px;
        }
        .news-preview, .news-text {
            margin-bottom: 8px;
        }
        .news-url {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Новости</h1>
    <?php if (!empty($newsList)): ?>
        <?php foreach ($newsList as $news): ?>
            <div class="news-card">
                <div class="news-header"><?php echo htmlspecialchars($news['news_header']); ?></div>
                <div class="news-preview"><?php echo htmlspecialchars($news['news_preview']); ?></div>
                <div class="news-text"><?php echo htmlspecialchars($news['news_text']); ?></div>
                <a class="news-url" href="<?php echo htmlspecialchars($news['url']); ?>">Читать далее</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Новостей нет.</p>
    <?php endif; ?>
</body>
</html>
