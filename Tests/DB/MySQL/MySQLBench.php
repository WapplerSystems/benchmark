<?php

namespace WapplerSystems\Benchmark\Tests\DB\MySQL;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use WapplerSystems\Benchmark\Entities\House;

/**
 * @BeforeClassMethods({"initDatabase"})
 */
class MySQLBench
{
    /**
     * @var EntityManager
     */
    protected static $entityManager;

    public static function initDatabase()
    {

        $entityManager = self::getDatabaseConnection();
        $schemaTool = new SchemaTool($entityManager);

        $classes = [
            $entityManager->getClassMetadata(House::class),
        ];

        $schemaTool->dropSchema($classes);
        $schemaTool->createSchema($classes);
    }

    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    protected static function getDatabaseConnection()
    {
        if (self::$entityManager !== null) return self::$entityManager;

        include_once __DIR__ . '/../../../config/db.config.php';

        $config = Setup::createConfiguration(false);
        $driver = new AnnotationDriver(new AnnotationReader(), [__DIR__ . '/../../../src/Entities']);
        $config->setMetadataDriverImpl($driver);

        self::$entityManager = EntityManager::create($mysqlParams, $config);
        return self::$entityManager;
    }

    /**
     * @Revs(1000)
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function benchInsert()
    {
        $entityManager = self::getDatabaseConnection();

        $employee = new House();
        $employee->setName('test');
        $entityManager->persist($employee);
        $entityManager->flush();

    }
}