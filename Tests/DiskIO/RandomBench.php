<?php


namespace WapplerSystems\Benchmark\Tests\DiskIO;


class RandomBench
{
    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchRandomReadWrite(){ //tests random read and write performance with fio
        $output = null;
        $retval = null;

        exec('fio --randrepeat=1 --ioengine=libaio --direct=1 --gtod_reduce=1 --name=test --filename=test.file --bs=4k --iodepth=64 --size=250M --readwrite=randrw --rwmixread=80', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO random Read/Write benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    function removeFile(){
        $output = null;
        $retval = null;

        exec('rm test.file', $output, $retval);
        if ($retval != 0) {
            print "there was an error during removal of the test file\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }
}