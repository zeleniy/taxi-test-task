<?php


use PHPUnit\Framework\TestCase;
use Taxi\Driver;
use Taxi\Plan\BasePlan;
use Taxi\Service\GpsService;
use Taxi\Service\DriverService;


/**
 * 
 */
final class BasePlanTest extends TestCase {


  /**
   * 
   */
  public function testGetPricePerDistance(): void {

    $testData = [
      0 => 0,
      1 => BasePlan::PRICE_PER_KM * 1,
      2 => BasePlan::PRICE_PER_KM * 2
    ];

    $plan = BasePlan::getInstance(new Driver(rand(18, 65)));

    foreach ($testData as $distance => $expectedPrice) {
      $this->assertEquals($expectedPrice, $plan->getPricePerDistance($distance));
    }
  }


  /**
   * 
   */
  public function testGetPricePerTime(): void {

    $testData = [
      0 => 0,
      1 => BasePlan::PRICE_PER_TIME_UNIT * 1,
      2 => BasePlan::PRICE_PER_TIME_UNIT * 2
    ];

    $plan = BasePlan::getInstance(new Driver(rand(18, 65)));

    foreach ($testData as $time => $expectedPrice) {
      $this->assertEquals($expectedPrice, $plan->getPricePerTime($time));
    }
  }


  /**
   * 
   */
  public function testCalculate(): void {

    $testData = [
      [
        'time' => 10,
        'distance' => 2,
        'driverAge' => 55,
        'services' => [],
        'expectedPrice' => 50
      ],
      [
        'time' => 10,
        'distance' => 2,
        'driverAge' => 20,
        'services' => [],
        'expectedPrice' => 55
      ],
      [
        'time' => 10,
        'distance' => 2,
        'driverAge' => 55,
        'services' => [new GpsService()],
        'expectedPrice' => 65
      ],
      [
        'time' => 10,
        'distance' => 2,
        'driverAge' => 20,
        'services' => [new GpsService(), new DriverService()],
        'expectedPrice' => 72
      ],
    ];

    foreach ($testData as $time => $testDatum) {

      $plan = BasePlan::getInstance(new Driver($testDatum['driverAge']));

      foreach ($testDatum['services'] as $service) {
        $plan->addService($service);
      }

      $this->assertEquals(
        $testDatum['expectedPrice'],
        $plan->calculate($testDatum['time'], $testDatum['distance'])
      );
    }
  }
}