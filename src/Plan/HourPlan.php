<?php


namespace Taxi\Plan;


use Taxi\Service\GpsService;
use Taxi\Service\DriverService;


/**
 * Тариф почасовой
 */
class HourPlan extends Plan {


  /**
   * Стоимость за километр.
   * @var integer
   */
  const PRICE_PER_KM = 0;
  /**
   * Стоимость за единицу времени.
   * @var integer
   */
  const PRICE_PER_TIME_UNIT = 200;
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

    return ceil($time / 60) * self::PRICE_PER_TIME_UNIT;
  }
}