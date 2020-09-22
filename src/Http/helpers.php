<?php
    use Corbancode\Monnify\Monnify;

    if (! function_exists('monnify')) {
        function monnify()
        {
            return app()->make(Monnify::class);
        }
    }
?>
