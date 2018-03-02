<?php

require __DIR__.'/vendor/autoload.php';
use Investment\Loan;
use Investment\Tranch;
use Investment\Investor;
use Investment\Report;

$loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
$tranchA = new Tranch('A', 0.03, 1000);
$tranchB = new Tranch('B', 0.06, 1000);
$loan->tranch($tranchA)->tranch($tranchB);

$investor1 = new Investor('Investor 1', 1000);
$investor2 = new Investor('Investor 2', 1000);
$investor3 = new Investor('Investor 3', 1000);
$investor4 = new Investor('Investor 4', 1000);

try {
    $investor1->invest($tranchA, 1000, new DateTime('2015-10-03'));
} catch (\Exception $e){
    error_log("[ERROR]: {$e->getMessage()}");
}
try{
    $investor2->invest($tranchA, 1,    new DateTime('2015-10-04'));
} catch (\Exception $e){
    error_log("[ERROR]: {$e->getMessage()}");
}
try{
    $investor3->invest($tranchB, 500,  new DateTime('2015-10-10'));
} catch (\Exception $e){
    error_log("[ERROR]: {$e->getMessage()}");
}
try{
    $investor4->invest($tranchB, 1100, new DateTime('2015-10-25'));
} catch (\Exception $e){
    error_log("[ERROR]: {$e->getMessage()}");
}
$report = new Report($loan);
echo $report->report(new DateTime('2015-10-31'));
