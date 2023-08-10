<?php
// bootstrap.php
require_once "vendor/autoload.php";
require_once "autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = ['/src/Model/Pessoa.php'];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'magazord',
];

$config        = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection    = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

if(2>1) echo "ola mundoi";