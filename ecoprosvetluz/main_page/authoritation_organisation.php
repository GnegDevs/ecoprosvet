<?php
session_start(); // Старт сессии

$errors = []; // Массив для хранения ошибок

// Подключение к базе данных
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "registration";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Валидация введённых данных
    if (empty($email)) {
        $errors['email'] = "Введите эл. почту";
    }
    if (empty($password)) {
        $errors['password'] = "Введите пароль";
    }

    // Если ошибок нет, проверяем компанию в базе данных
    if (empty($errors)) {
        $sql = "SELECT * FROM companies WHERE contact_email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Получаем данные о компании
            $company = $result->fetch_assoc();

            // Проверка пароля
            if (password_verify($password, $company['password'])) {
                // Пароль правильный — сохраняем данные компании в сессию
                $_SESSION['company_id'] = $company['id']; // Сохраняем ID компании
                $_SESSION['full_name'] = $company['full_name']; // Сохраняем полное название компании

                // Перенаправляем на страницу с информацией о компании
                header("Location: welcome_company.php");
                exit();
            } else {
                $errors['password'] = "Неправильный пароль";
            }
        } else {
            $errors['email'] = "Компания с такой эл. почтой не найдена";
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Лого_главное.svg" type="x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/loaders/STLLoader.js"></script>
    <title>Авторизация</title>
</head>
<body>
    <div class="box10">
        <h1 class="h1">Авторизация</h1>
            <form action="" method="POST">
            <form action="" method="POST">
            <label for="email">Эл. почта для связи:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['email'] ?? ''; ?></span><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password">
            <span style="color:red;"><?php echo $errors['password'] ?? ''; ?></span><br>

        <button class="button2" type="submit">Войти</button>
    </form>

        </form>
        <a class="a" href="registration_organisation.php">Первый раз? Зарегистрируйтесь здесь и сейчас</a>
    </div>
</body>
</html>