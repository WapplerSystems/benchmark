<?php

namespace WapplerSystems\Benchmark\Tests\Graphics;

class ImageMagickBench
{
    /**
     * @Iterations(5)
     */
    public function benchResizeIM() //resize benchmark
    {
        $output = null;
        $retval = null;

        exec('convert data/test.jpg -resize 50% test_$i.jpg;rm test_*.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during ImageMagick resize benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @Iterations(5)
     */
    public function benchCompressionIM() //compression benchmark
    {
        $output = null;
        $retval = null;

        exec('convert data/test.jpg -strip -interlace Plane -gaussian-blur 0.05 -quality 60% test_2.jpg;rm test_*.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during ImageMagick compression benchmark";
            print "error code: $retval\n";
            print_r($output);
        }
    }
}