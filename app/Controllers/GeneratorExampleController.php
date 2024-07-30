<?php

declare(strict_types=1);

namespace App\Controllers;
use App\Attributes\Get;

class GeneratorExampleController
{
    #[Get(path:"/generator/example")]
    public function index()
    {
        $numbers = $this->usualRange(1,10000);

        echo '<pre>';
        foreach ($numbers as $index => $number) {
            echo "$index : $number <br />";
        }
        echo '<pre>';

    }

    public function lazyRange($start, $end): \Generator
    {
        for ($i = $start; $i <= $end; $i++) {
            yield $i;
        }
    }

    public function usualRange($start, $end): array
    {
        $result = [];
        for ($i = $start; $i <= $end; $i++) {
            $result[] = $i;
        }
        return $result;
    }
}
