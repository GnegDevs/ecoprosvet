<?php

session_start(); // Старт сессии

// Инициализируем массив для хранения ошибок
$errors = [];

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

// Проверка, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Валидация email
    if (empty($email)) {
        $errors['email'] = "Введите email";
    }
    
    // Валидация пароля
    if (empty($pass)) {
        $errors['password'] = "Введите пароль";
    }

    // Если нет ошибок, проверяем пользователя в базе данных
    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Получаем данные пользователя
            $user = $result->fetch_assoc();

            // Проверка пароля
            if (password_verify($pass, $user['password'])) {
                // Пароль правильный — перенаправляем пользователя
                header("Location: lk_player.php?firstname=" . urlencode($user['firstname']));
                exit();
            } else {
                $errors['password'] = "Неправильный пароль";
            }
        } else {
            $errors['email'] = "Пользователь с таким email не найден";
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
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['email'] ?? ''; ?></span><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password">
            <span style="color:red;"><?php echo $errors['password'] ?? ''; ?></span><br>

            <button class="button2" type="submit">Войти</button>
        </form>
        <a class="a" href="registration_player.php">Первый раз? Зарегистрируйтесь здесь и сейчас</a>
    </div>
</body>
</html>