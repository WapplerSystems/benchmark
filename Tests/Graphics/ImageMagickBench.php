<?php

namespace WapplerSystems\Benchmark\Tests\Graphics;

class ImageMagickBench
{
    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    public function benchResizeIM() //resize benchmark
    {
        $output = null;
        $retval = null;

        exec('convert data/test.jpg -resize 50% test_2.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during ImageMagick resize benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    public function benchCompressionIM() //compression benchmark
    {
        $output = null;
        $retval = null;

        exec('convert data/test.jpg -strip -interlace Plane -gaussian-blur 0.05 -quality 60% test_2.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during ImageMagick compression benchmark";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    function removeFile(){
        $output = null;
        $retval = null;

        exec('rm test_2.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during removal of the temporary test image\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }
}