<?php
namespace WapplerSystems\Benchmark\Tests\PHP;

use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;

class CryptBench
{

    public function provideStrings()
    {
        yield 'hello' => [ 'string' => 'Hello World!' ];
        yield 'goodbye' => [ 'string' => 'Goodbye Cruel World!' ];
    }

    /**
     * @ParamProviders({"provideStrings"})
     */
    public function benchMd5($params)
    {
        hash('md5', $params['string']);
    }


    /**
     * @ParamProviders({"provideStrings"})
     */
    public function benchSha1($params)
    {
        hash('sha1', $params['string']);
    }

}