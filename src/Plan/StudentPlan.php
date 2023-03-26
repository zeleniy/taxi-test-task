<?php


namespace Taxi\Plan;


use Taxi\Service\GpsService;
use Taxi\Driver;


/**
 * Тариф студенческий.
 */
class StudentPlan extends Plan {


  /**
   * Стоимость за километр.
   * @var integer
   */
  const PRICE_PER_KM = 4;
  /**
   * Стоимость за единицу времени.
   * @var integer
   */
  const PRICE_PER_TIME_UNIT = 1;
  /**
   * Поддерживаемые доп услуги.
   * @var array
   */
  const SUPPORTED_SERVICES = [
    GpsService::class
  ];


  /**
   * @param Driver $driver водитель.
   */
  protected function __construct(private Driver $driver) {

    parent::__construct($driver);

    if ($this->driver->getAge() > 25) {
      throw new \LogicException('Driver age should be less than 25');
    }
  }


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