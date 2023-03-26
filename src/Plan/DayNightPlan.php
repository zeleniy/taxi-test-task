<?php


namespace Taxi\Plan;


use Taxi\Service\GpsService;
use Taxi\Service\DriverService;


/**
 * Тариф суточный
 */
class DayNightPlan extends Plan {


  /**
   * Стоимость за километр.
   * @var integer
   */
  const PRICE_PER_KM = 1;
  /**
   * Стоимость за единицу времени.
   * @var integer
   */
  const PRICE_PER_TIME_UNIT = 1000;
  /**
   * Поддерживаемые доп услуги.
   * @var array
   */
  const SUPPORTED_SERVICES = [
    DriverService::class,
    GpsService::class
  ];


  /**
   * {@inheritDoc}
   * @see \Taxi\Plan\Plan::getSupportedServices()
   */
  function getSupportedServices(): array {

    return self::SUPPORTED_SERVICES;
  }


  /**
   * {@inheritDoc}
   * @see \Taxi\Plan\Plan::getPricePerDistance($distance)
   */
  function getPricePerDistance(int $distance): int {

    return $distance * self::PRICE_PER_KM;
  }


  /**
   * {@inheritDoc}
   * @see \Taxi\Plan\Plan::getPricePerTime($time)
   */
  function getPricePerTime(int $time): int {

    $day = 3600 * 24;

    $daysFree = floor($time / $day);
    $daysUsed = floor(($time + 30) / $day);

    $mins = 0;

    if ($daysFree === $daysUsed) {
      $mins = $time % $day;
    }

    if ($mins >= 30) {
      $daysUsed ++;
    }

    return $daysUsed * self::PRICE_PER_TIME_UNIT;
  }
}