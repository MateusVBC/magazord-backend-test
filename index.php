<?php
// bootstrap.php
require_once "vendor/autoload.php";
require_once "autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use MateusVBC\Magazord_Backend\Model\Pessoa;

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
$o = $connection->prepare('select * from pessoa');
var_dump($o->executeQuery());
echo"<hr>";
var_dump($connection->fetchAllAssociative('select * from pessoa'));
//..
$connectionParams = [
    'dbname' => 'magazord',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);


// var_dump($oPessoa);