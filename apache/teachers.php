<?php
include 'teachersEntity.php';


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

$entity = new Teachers($args);

    
switch ($method){
    case 'POST':
        $entity->createTeacher();
    break;
    case 'GET':
        $entity->getTeacher();
    break;
    case 'PUT':
        $entity->updateTeacher();
    break;
    case 'DELETE':
        $entity->deleteTeacher();
    break;
    default:
    $entity->unknownMethod();
}
    
