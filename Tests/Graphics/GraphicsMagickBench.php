<?php


namespace WapplerSystems\Benchmark\Tests\Graphics;


class GraphicsMagickBench
{
    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    public function benchResizeGM() //resize benchmark
    {
        $output = null;
        $retval = null;

        exec('gm convert -resize 50% data/test.jpg test_2.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during GraphicsMagick resize benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }
    }

    /**
     * @AfterMethods({"removeFile"})
     * @Iterations(5)
     */
    public function benchCompressionGM() //compression benchmark
    {
        $output = null;
        $retval = null;

        exec('gm convert data/test.jpg -strip -interlace Plane -gaussian-blur 0.05 -quality 60% test_2.jpg', $output, $retval);
        if ($retval != 0) {
            print "there was an error during GraphicsMagick compression benchmark";
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