<?php

include 'studentsEntity.php';


// Определяем метод запроса
$method = $_SERVER['REQUEST_METHOD'];

//$page = $_SERVER['REQUEST_FILENAME'];

// Получение строки запроса
$url = $_SERVER['REQUEST_URI'];
// Анализ и формирование структуры для дальнейшей обработки
$url_data = parse_url($url);
if(isset($url_data["query"])){
    parse_str($url_data["query"], $args);
}
else{
    $args = NULL;
}

// На основе метода запускаем функциональность

$entity = new Students($args);

    
switch ($method){
    case 'POST':
        echo $entity->createStudent();
    break;
    case 'GET':
        echo $entity->getStudent();
    break;
    case 'PUT':
        echo $entity->updateStudent();
    break;
    case 'DELETE':
        echo $entity->deleteStudent();
    break;
    default:
        echo $entity->unknownMethod();
}
