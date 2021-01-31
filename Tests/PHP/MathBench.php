<?php
namespace WapplerSystems\Benchmark\Tests\PHP;

class MathBench
{
    public function benchMath()
    {

        $mathFunctions = ["abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan", "sqrt"];
        for ($i = 0; $i < 30; $i++) {
            foreach ($mathFunctions as $function) {
                call_user_func_array($function, [$i]);
            }
        }

    }
}