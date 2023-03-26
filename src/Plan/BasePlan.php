<?php


namespace Taxi\Plan;


use Taxi\Service\GpsService;


/**
 * Тариф базовый
 */
class BasePlan extends Plan {


  /**
   * Стоимость за километр.
   * @var integer
   */
  const PRICE_PER_KM = 10;
  /**
   * Стоимость за единицу времени.
   * @var integer
   */
  const PRICE_PER_TIME_UNIT = 3;
  /**
   * Поддерживаемые доп услуги.
   * @var array
   */
  const SUPPORTED_SERVICES = [
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

    return $time * self::PRICE_PER_TIME_UNIT;
  }
}