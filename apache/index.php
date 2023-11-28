<html lang="en">
<head>
<title>Main table page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Таблица студентов</h1>
<table>
    <tr><th>Id</th><th>Name</th><th>tutorId</th><th>AverageMark</th></tr>
<?php
$mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM students");
foreach ($result as $row){
    echo "<tr><td>{$row['ID']}</td><td>{$row['namee']}</td><td>{$row['tutorId']}</td><td>{$row['averageMark']}</td></tr>";
}
?>
</table>
</body>
</html>