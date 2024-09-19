<?php
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $full_name = $_POST['full_name'] ?? '';
    $short_name = $_POST['short_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $ogrn = $_POST['ogrn'] ?? '';
    $legal_address = $_POST['legal_address'] ?? '';
    $actual_address = $_POST['actual_address'] ?? '';
    $contact_firstname = $_POST['contact_firstname'] ?? '';
    $contact_lastname = $_POST['contact_lastname'] ?? '';
    $contact_middlename = $_POST['contact_middlename'] ?? '';
    $contact_phone = $_POST['contact_phone'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';
    $company_website = $_POST['company_website'] ?? '';
    $activity = $_POST['activity'] ?? '';

    // Проверка загруженных файлов
    $pd_agreement_file = $_FILES['pd_agreement_file']['name'] ?? '';
    $documents_file = $_FILES['documents_file']['name'] ?? '';

    // Валидация данных
    if (empty($full_name)) $errors['full_name'] = "Введите полное название компании";
    if (empty($password)) $errors['password'] = "Введите пароль";
    if ($password !== $confirm_password) $errors['confirm_password'] = "Пароли не совпадают";
    if (empty($ogrn)) $errors['ogrn'] = "Введите ОГРН";
    if (empty($contact_firstname)) $errors['contact_firstname'] = "Введите имя контактного лица";
    if (empty($contact_email)) $errors['contact_email'] = "Введите контактную эл. почту";

    // Если нет ошибок, загружаем файлы и сохраняем данные в БД
    if (empty($errors)) {
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "registration";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Загружаем файлы
        if (!empty($pd_agreement_file)) {
            $pd_agreement_file_path = 'uploads/' . basename($_FILES['pd_agreement_file']['name']);
            move_uploaded_file($_FILES['pd_agreement_file']['tmp_name'], $pd_agreement_file_path);
        }
        if (!empty($documents_file)) {
            $documents_file_path = 'uploads/' . basename($_FILES['documents_file']['name']);
            move_uploaded_file($_FILES['documents_file']['tmp_name'], $documents_file_path);
        }

        // Хешируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Сохранение в БД
        $sql = "INSERT INTO companies (full_name, short_name, password, ogrn, legal_address, actual_address, contact_firstname, contact_lastname, contact_middlename, contact_phone, contact_email, company_website, activity, pd_agreement_file, documents_file)
                VALUES ('$full_name', '$short_name', '$hashed_password', '$ogrn', '$legal_address', '$actual_address', '$contact_firstname', '$contact_lastname', '$contact_middlename', '$contact_phone', '$contact_email', '$company_website', '$activity', '$pd_agreement_file_path', '$documents_file_path')";

        if ($conn->query($sql) === TRUE) {
            header("Location: welcome_company.php?company=" . urlencode($full_name));
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }

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
<form action="" method="POST" enctype="multipart/form-data">
        <label for="full_name">Полное название компании:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name ?? ''); ?>">
        <span style="color:red;"><?php echo $errors['full_name'] ?? ''; ?></span><br>

        <label for="short_name">Сокращенное название (если есть):</label>
        <input type="text" id="short_name" name="short_name" value="<?php echo htmlspecialchars($short_name ?? ''); ?>"><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password"><br>

        <label for="confirm_password">Подтверждение пароля:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <span style="color:red;"><?php echo $errors['confirm_password'] ?? ''; ?></span><br>

        <label for="ogrn">ОГРН:</label>
        <input type="text" id="ogrn" name="ogrn" value="<?php echo htmlspecialchars($ogrn ?? ''); ?>">
        <span style="color:red;"><?php echo $errors['ogrn'] ?? ''; ?></span><br>

        <label for="legal_address">Юридический адрес:</label>
        <input type="text" id="legal_address" name="legal_address" value="<?php echo htmlspecialchars($legal_address ?? ''); ?>"><br>

        <label for="actual_address">Фактический адрес:</label>
        <input type="text" id="actual_address" name="actual_address" value="<?php echo htmlspecialchars($actual_address ?? ''); ?>"><br>

        <label for="contact_firstname">Контактное лицо (Имя):</label>
        <input type="text" id="contact_firstname" name="contact_firstname" value="<?php echo htmlspecialchars($contact_firstname ?? ''); ?>">
        <span style="color:red;"><?php echo $errors['contact_firstname'] ?? ''; ?></span><br>

        <label for="contact_lastname">Фамилия контактного лица:</label>
        <input type="text" id="contact_lastname" name="contact_lastname" value="<?php echo htmlspecialchars($contact_lastname ?? ''); ?>"><br>

        <label for="contact_middlename">Отчество контактного лица (если есть):</label>
        <input type="text" id="contact_middlename" name="contact_middlename" value="<?php echo htmlspecialchars($contact_middlename ?? ''); ?>"><br>

        <label for="contact_phone">Телефон для связи:</label>
        <input type="text" id="contact_phone" name="contact_phone" value="<?php echo htmlspecialchars($contact_phone ?? ''); ?>"><br>

        <label for="contact_email">Эл. почта для связи:</label>
        <input type="email" id="contact_email" name="contact_email" value="<?php echo htmlspecialchars($contact_email ?? ''); ?>"><br>

        <label for="company_website">Сайт компании (если есть):</label>
        <input type="url" id="company_website" name="company_website" value="<?php echo htmlspecialchars($company_website ?? ''); ?>"><br>

        <label for="activity">Основные виды деятельности:</label>
        <input type="text" id="activity" name="activity" value="<?php echo htmlspecialchars($activity ?? ''); ?>"><br>

        <label for="pd_agreement_file">Согласие на обработку ПД:</label>
        <input type="file" id="pd_agreement_file" name="pd_agreement_file"><br>

        <label for="documents_file">Копии учредительных документов:</label>
        <input type="file" id="documents_file" name="documents_file"><br>

        <button class="button2" type="submit">Зарегистрировать компанию</button>
    </form>

        <a class="a" href="authoritation_organisation.php">Не первый раз? Авторизируйтесь здесь и сейчас</a>
    </div>
</body>
</html>