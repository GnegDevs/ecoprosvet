<?php
session_start(); // Стартуем сессию

// Проверяем, авторизована ли компания
if (!isset($_SESSION['company_id'])) {
    // Если компания не авторизована, перенаправляем на страницу входа
    header("Location: login_company.php");
    exit();
}

// Получаем данные компании из сессии
$full_name = $_SESSION['full_name'];
$short_name = $_SESSION['short_name'];
$password = $_SESSION['password'];
$confirm_password = $_SESSION['confirm_password'];
$ogrn = $_SESSION['ogrn'];
$legal_address = $_SESSION['legal_address'];
$actual_address = $_SESSION['actual_address'];
$contact_firstname = $_SESSION['contact_firstname'];
$contact_lastname = $_SESSION['contact_lastname'];
$contact_middlename = $_SESSION['contact_middlename'];
$contact_phone = $_SESSION['contact_phone'];
$contact_email = $_SESSION['contact_email'];
$company_website = $_SESSION['company_website'];
$activity = $_SESSION['activity'];
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
    <div class="box10" style="height: 1700px;">
        <h1 class="h1">Личный кабинет</h1>
        <div class="box11">
            <p class="p1">Статус: </h4>
            <p>Организатор мероприятий</p>
        </div>
            <div class="box130" style="margin-left: 3.5%;">
                <div class="box13">
                    <p class="p1">Полное название: </h4>
                    <p><?php echo htmlspecialchars($full_name); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Сокращенное название: </h4>
                    <p><?php echo htmlspecialchars($short_name); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">ОГРН: </h4>
                    <p><?php echo htmlspecialchars($ogrn); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Юридический адрес: </h4>
                    <p><?php echo htmlspecialchars($legal_address); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Фактический адрес: </h4>
                    <p><?php echo htmlspecialchars($actual_address); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Контактное лицо для связи: </h4>
                    <p><?php echo htmlspecialchars($contact_firstname); ?> <?php echo htmlspecialchars($contact_middlename); ?> <?php echo htmlspecialchars($contact_lastname); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Контактный телефон: </h4>
                    <p><?php echo htmlspecialchars($contact_phone); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">E-mail для связи: </h4>
                    <p><?php echo htmlspecialchars($contact_email); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Сайт: </h4>
                    <p><?php echo htmlspecialchars($company_website); ?></p>
                </div>
                <div class="box13">
                    <p class="p1">Основной вид деятельности: </h4>
                    <p><?php echo htmlspecialchars($activity); ?></p>
                </div>
            </div>
            <button class="button3" type="button">Изменить данные</button>

            <div class="box14" style="line-height: 10px;">
                <div class="box141" style="margin-left: 125px;">
                    <h5>Согласие на обработку персональных данных</h5>
                    <h6>Не прикреплено</h6>
                </div>
                <div class="box141" style="margin-left: 70px;">
                    <h5>Копии учредительных документов</h5>
                    <h6>Прикреплено</h6>
                </div>
            </div>

            <div class="box15">
                <h1 style="color: #041B4A;">Активные мероприятия</h1>
                <h1 style="color: #041B4A; font-size: 40px; margin-top: 10px;">Нет активных мероприятий</h1>
            </div>
    
            <div class="box12">
                <p>За все время вы организовали </p>
                <p class="p1">10</p>
                <p> мероприятий</p>
            </div>
        </div>


    </div>
    <script src="script.js"></script>
</body>
</html>