<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotation Mapping
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, null, null, false);
// database configuration parameters
$conn = [
    'driver'   => 'pdo_mysql',
    'host'     => 'mysql-host',
    'dbname'   => 'calendar',
    'user'     => 'calendar_user',
    'password' => 'secret',
    'charset'  => 'utf8mb4',
];

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

class DoctrineManager {
	public static function getEntityManager(){
		global $entityManager;
		return $entityManager;
	}
}
