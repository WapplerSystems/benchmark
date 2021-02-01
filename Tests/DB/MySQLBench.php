<?php

namespace WapplerSystems\Benchmark\Tests\DB;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use WapplerSystems\Benchmark\Entities\House;
use WapplerSystems\Benchmark\Entities\Page;

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
            $entityManager->getClassMetadata(Page::class),
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

        include_once __DIR__ . '/../../config/db.config.php';

        $config = Setup::createConfiguration(false);
        $driver = new AnnotationDriver(new AnnotationReader(), [__DIR__ . '/../../src/Entities']);
        $config->setMetadataDriverImpl($driver);

        self::$entityManager = EntityManager::create($mysqlParams, $config);
        return self::$entityManager;
    }

    /**
     * @Iterations(30)
     * @throws \Doctrine\ORM\ORMException
     */
    public function benchInsert()
    {
        $entityManager = self::getDatabaseConnection();

        $house = new House();
        $house->setName('test');
        $entityManager->persist($house);
        $entityManager->flush();
    }

    public function provideLargeText()
    {
        yield 'hello' => [ 'string' =>  file_get_contents(__DIR__.'/../../data/sample-2mb-text-file.txt', true) ];
    }

    /**
     * @Iterations(5)
     * @ParamProviders({"provideLargeText"})
     * @throws \Doctrine\ORM\ORMException
     */
    public function benchInsertLargeText($params)
    {
        $entityManager = self::getDatabaseConnection();

        $page = new Page();
        $page->setName('page 1');
        $page->setContent($params['string']);
        $entityManager->persist($page);
        $entityManager->flush();
    }


    /**
     * @Iterations(5)
     * @throws \Doctrine\ORM\ORMException
     */
    public function benchSelect()
    {

        $entityManager = self::getDatabaseConnection();



    }
}