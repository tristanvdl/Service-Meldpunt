<?php
include 'models/Autoload.php';
Autoload::register();

$db = Database::getInstance();
$con = $db->getDB();

$action = isset($_GET['page']) ? $_GET['page'] : 'homepage';
session_start();
include 'views/header.php';
switch ($action) {
    case 'result':
      include 'views/result.php';
      break;

    case 'admin_cms':
        include 'views/cms.php';
        break;

    case 'ticket':
        include 'views/ticket.php';
        break;

    default:
        include 'views/home.php';
        break;
}
include 'views/footer.php';
