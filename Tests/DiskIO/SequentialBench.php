<?php


namespace WapplerSystems\Benchmark\Tests\DiskIO;


class SequentialBench
{
    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchSequentialWrite1G(){ //writes 1G 1 time
        $output = null;
        $retval = null;

        exec('dd if=/dev/zero of=test.file bs=1G count=1 oflag=dsync', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO sequential write of 1GB benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchSequentialWrite64M(){ //writes 64M 1 time
        $output = null;
        $retval = null;

        exec('dd if=/dev/zero of=test.file bs=64M count=1 oflag=dsync', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO sequential write of 64M benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchSequentialWrite1M(){ //writes 1M 256 times
        $output = null;
        $retval = null;

        exec('dd if=/dev/zero of=test.file bs=1M count=256 conv=fdatasync', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO sequential write of 64M benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchSequentialWrite8K(){ //writes 8KB 10k times
        $output = null;
        $retval = null;

        exec('dd if=/dev/zero of=test.file bs=8k count=10k', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO sequential write of 8K benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    function benchServerLatency(){ //writes 512B 1000 times to determine server latency
        $output = null;
        $retval = null;

        exec('dd if=/dev/zero of=test.file bs=512 count=1000 oflag=dsync', $output, $retval);
        if ($retval != 0) {
            print "there was an error during DiskIO server latency benchmark\n";
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