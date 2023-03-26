<?php


use PHPUnit\Framework\TestCase;
use Taxi\Driver;
use Taxi\Plan\BasePlan;
use Taxi\Service\GpsService;
use Taxi\Service\DriverService;
use Taxi\Plan\DayNightPlan;
use Taxi\Plan\HourPlan;


/**
 * 
 */
final class DayNightPlanTest extends TestCase {


  /**
   * 
   */
  public function testGetPricePerDistance(): void {

    $testData = [
      0 => 0,
      1 => DayNightPlan::PRICE_PER_KM * 1,
      2 => DayNightPlan::PRICE_PER_KM * 2
    ];

    $plan = DayNightPlan::getInstance(new Driver(rand(18, 65)));

    foreach ($testData as $distance => $expectedPrice) {
      $this->assertEquals($expectedPrice, $plan->getPricePerDistance($distance));
    }
  }


  /**
   * 
   */
  public function testGetPricePerTime(): void {

    $day = 3600 * 24;

    $testData = [
      [
        'time' => $day - 1,
        'expectedPice' => DayNightPlan::PRICE_PER_TIME_UNIT * 1
      ],
      [
        'time' => $day,
        'expectedPice' => DayNightPlan::PRICE_PER_TIME_UNIT * 1
      ],
      [
        'time' => $day + 29,
        'expectedPice' => DayNightPlan::PRICE_PER_TIME_UNIT * 1
      ],
      [
        'time' => $day + 30,
        'expectedPice' => DayNightPlan::PRICE_PER_TIME_UNIT * 2
      ]
    ];

    $plan = DayNightPlan::getInstance(new Driver(rand(18, 65)));

    foreach ($testData as $i => $testDatum) {
      $this->assertEquals($testDatum['expectedPice'], $plan->getPricePerTime($testDatum['time']), sprintf('Interation %d', $i));
    }
  }
}