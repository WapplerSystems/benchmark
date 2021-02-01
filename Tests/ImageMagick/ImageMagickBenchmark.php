<?php
namespace WapplerSystems\Benchmark\Tests\ImageMagick;

class ImageMagickBenchmark {
    public function benchIM() {
        $output=null;
        $retval=null;

        //get test image from unsplash
        exec('wget -q -O test.jpg https://unsplash.com/photos/sYxxQaGK7tY/download?force=true',$output,$retval);
        if ($retval != 0) {
            print "there was an error during image download";
        }


        //resize benchmark
        exec('i=0;while [ $i -le 10 ];do convert test.jpg -resize 50% test_$i.jpg;i=$(( $i + 1 )); done;rm test_*.jpg',$output,$retval);
        if ($retval != 0) {
            print "there was an error during resize benchmark\n";
            print "error code: $retval\n";
            print_r($output);
        }

        //compression benchmark
        exec('i=0;while [ $i -le 10 ];do convert test.jpg -strip -interlace Plane -gaussian-blur 0.05 -quality 60% test_$i.jpg;i=$(( $i + 1 ));done;rm test_*.jpg;rm test.jpg;',$output,$retval);
        if ($retval != 0) {
            print "there was an error during compression benchmark";
            print_r($output);
        }
    }
}
?>