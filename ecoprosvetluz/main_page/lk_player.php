<?php
session_start(); // Стартуем сессию

// Проверяем, вошёл ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Если пользователь не вошёл, перенаправляем на страницу входа
    header("Location: login.php");
    exit();
}

// Получаем имя пользователя из сессии
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$firstname = $_SESSION['firstname'];
$middlename = $_SESSION['middlename']; // Отчество может быть пустым
$age = $_SESSION['age'];
$gender = $_SESSION['gender'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Лого_главное.svg" type="x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Личный кабинет</title>
</head>
<body>
    <div class="box10" style="height: 1600px;">
        <h1 class="h1">Личный кабинет</h1>
        <div class="box11">
            <p class="p1">Статус: </h4>
            <p>Участник мероприятий</p>
        </div>
        <div class="box111">
            <div class="box110" style="margin-left: 3.5%;">
                <div class="box11">
                    <p class="p1">ФИО: </h4>
                    <p><?php echo htmlspecialchars($firstname); ?> <?php echo htmlspecialchars($lastname); ?> <?php echo htmlspecialchars($middlename); ?></p>
                </div>
                <div class="box11">
                    <p class="p1">Возраст: </h4>
                    <p><?php echo htmlspecialchars($age); ?></p>
                </div>
                <div class="box11">
                    <p class="p1">Пол: </h4>
                    <p><?php echo htmlspecialchars($gender); ?></p>
                </div>
                <div class="box11">
                    <p class="p1">E-mail: </h4>
                    <p><?php echo htmlspecialchars($email); ?></p>
                </div>
            </div>
            <div class="box110">
                <div class="box11">
                    <p class="p1">Telegram: </h4>
                    <p>@ivan</p>
                </div>
                <div class="box11">
                    <p class="p1">ВКонтакте: </h4>
                    <p>@ivan</p>
                </div>
                <div class="box11">
                    <p class="p1">Одноклассники: </h4>
                    <p>@ivan</p>
                </div>
                <div class="box11">
                    <p class="p1">Инстаграм: </h4>
                    <p>@ivan</p>
                </div>
                <button class="button3" type="button">Изменить данные</button>
            </div>
        </div>

        <h1 class="h1">Коллекция няшек</h1>
        <div class="box4" style="background-color: #EDDF98; align-items: center; justify-content: center;">
            <div class="carousel">
                <div class="carousel-slide active">
                    <div class="carousel-content">
                        <img src="Мышь.gif" alt="GIF 1">
                        <div class="carousel-content-text">
                            <h2>Хомямышь</h2>
                            <p>Крайне дружелюбное существо - в любой компании сойдет за своего</p>
                            <p>Любит уют и хорошо покушать</p>
                            <p>Бодрствует ночью и спит днем - настоящий любитель покоя и умиротворения </p>
                            <div style="background-color: #6C103F;" class="carousel-content-rare">
                                <p>Легендарный</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-slide">
                    <div class="carousel-content">
                        <img src="Геккон.gif" alt="GIF 2">
                        <div style="margin-left: 50px;" class="carousel-content-text">
                            <h2>Змееныш</h2>
                            <p>Чешуйчатый и вертлявый снаружи, <br> но мягкий и добрый внутри</p>
                            <p>Совсем не опасный</p>
                            <p>Не укусит в отличие от <br> своих сородичей ужа и гадюки</p>
                            <div class="carousel-content-rare">
                                <p>Редкий</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-slide">
                    <div class="carousel-content">
                        <img src="Воробей.gif" alt="GIF 3">
                        <div class="carousel-content-text">
                            <h2>Воробушек</h2>
                            <p>Неприметный, но никогда <br> не оставит тебя в трудные времена</p>
                            <p>Любитель семечек и больших и дружных компаний</p>
                            <p>Напевает, когда находится в хорошем настроении</p>
                            <div class="carousel-content-rare" style="background-color: #56682B;">
                                <p>Обычный</p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="carousel-controls">
                    <img src="Стрелочка_влево.png" class="prev" alt="Previous">
                    <img src="Стрелочка_вправо.png" class="next" alt="Next">
                </div>
            </div>
            <br><br>
        </div>

        <div class="box12">
            <p>Вы посетили </p>
            <p class="p1">10</p>
            <p> мероприятий</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>