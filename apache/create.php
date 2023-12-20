<html lang="en">
<head>
<title>Add student page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<?php
if ($_POST) {
    echo 'Вы отправили запись о студенте!';
    echo 'Имя: ' $_POST['name'];
    echo 'Фамилия: ' $_POST['surname'];
    echo 'Средний балл: ' $_POST['averageMark'];
}
?>
<form action="" method="post">
    Имя:  <input type="text" name="name" /><br />
    Фамилия: <input type="text" name="surname" /><br />
    Средний балл: <input type="text" name="averageMark" /><br />
    <input type="submit" name="submit" value="Создать запись о студенте" />
</form>
</body>
</html>