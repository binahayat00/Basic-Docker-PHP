<?php 

namespace App;

class CollectionAgency implements DebtCollector
{
    public function __construct()
    {

    }
    public function collect(float $owedAmount): float
    {
        $guaranteed = (int) $owedAmount * 0.5;
        // $maxGuaranteed = $owedAmount * 0.9;
        // $guaranteed = (time() % 2 === 0) ? $maxGuaranteed: $minGuaranteed;
        return mt_rand($guaranteed, $owedAmount);
    }
}