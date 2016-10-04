<?php
include 'models/Autoload.php';
Autoload::register();
$database = new Database('localhost','','procedures','root');
$action = isset($_GET['page']) ? $_GET['page'] : 'homepage';

include 'views/header.php';
switch ($action) {
    case 'result':
      include 'views/result.php';
      break;

    default:
        include 'views/home.php';
        break;
}
include 'views/footer.php';
