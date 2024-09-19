<?php

session_start(); // Старт сессии

// Инициализируем массив для хранения ошибок
$errors = [];

// Проверка, отправлена ли форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    $confirm_pass = $_POST['confirm_password'] ?? '';

    // Валидация данных
    if (empty($lastname)) {
        $errors['lastname'] = "Введите фамилию";
    }
    if (empty($firstname)) {
        $errors['firstname'] = "Введите имя";
    }
    if (empty($age)) {
        $errors['age'] = "Введите возраст";
    }
    if (empty($gender)) {
        $errors['gender'] = "Выберите пол";
    }
    if (empty($email)) {
        $errors['email'] = "Введите email";
    }
    if (empty($user)) {
        $errors['username'] = "Введите имя пользователя";
    }
    if (empty($pass)) {
        $errors['password'] = "Введите пароль";
    }
    if ($pass !== $confirm_pass) {
        $errors['confirm_password'] = "Пароли не совпадают";
    }

    // Если нет ошибок, можем продолжить регистрацию
    if (empty($errors)) {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registration";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Проверка подключения
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Получение данных из формы
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename']; // Отчество может быть пустым
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $confirm_pass = $_POST['confirm_password'];
        
        // Проверка на совпадение паролей
        if ($pass != $confirm_pass) {
            die("Пароли не совпадают");
        }
        
        // Хеширование пароля
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        
        // Проверка, что пользователь с таким email не существует
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            die("Пользователь с таким email уже существует");
        }
        
        // Добавление нового пользователя в базу данных
        $sql = "INSERT INTO users (lastname, firstname, middlename, age, gender, email, username, password)
                VALUES ('$lastname', '$firstname', '$middlename', '$age', '$gender', '$email', '$user', '$hashed_pass')";
        
        if ($conn->query($sql) === TRUE) {
            // Если регистрация успешна, перенаправляем на страницу приветствия
            header("Location: lk_player.php?firstname=" . urlencode($firstname));
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
        header("Location: welcome.php?firstname=" . urlencode($firstname));
        $conn->close();
    }
}
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
    <title>Регистрация</title>
</head>
<body>
    <div class="box9">
        <h1 class="h1">Регистрация</h1>
        <form action="" method="POST">
            <label for="lastname">Фамилия:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['lastname'] ?? ''; ?></span><br>
            <br>
            <label for="firstname">Имя:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['firstname'] ?? ''; ?></span><br>
            <br>
            <label for="middlename">Отчество:</label>
            <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($middlename ?? ''); ?>"><br>
            <br>
            <label for="age">Возраст:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['age'] ?? ''; ?></span><br>
            <br>
            <label for="gender">Пол:</label>
            <select id="gender" name="gender">
                <option value="">Выберите пол</option>
                <option value="male" <?php if (isset($gender) && $gender === 'male') echo 'selected'; ?>>Мужской</option>
                <option value="female" <?php if (isset($gender) && $gender === 'female') echo 'selected'; ?>>Женский</option>
            </select>
            <span style="color:red;"><?php echo $errors['gender'] ?? ''; ?></span><br>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['email'] ?? ''; ?></span><br>
            <br>
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user ?? ''); ?>">
            <span style="color:red;"><?php echo $errors['username'] ?? ''; ?></span><br>
            <br>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password">
            <span style="color:red;"><?php echo $errors['password'] ?? ''; ?></span><br>
            <br>
            <label for="confirm_password">Подтверждение пароля:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <span style="color:red;"><?php echo $errors['confirm_password'] ?? ''; ?></span><br>

            <button class="button2" type="submit">Зарегистрироваться</button>
        </form>
        <a class="a" href="authoritation_player.php>Не первый раз? Авторизируйтесь здесь и сейчас</a>
    </div>
</body>
</html>