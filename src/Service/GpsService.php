<?php


namespace Taxi\Service;


/**
 * Услуга GPS в салоне.
 */
class GpsService extends Service {


  /**
   * Базовая стоимость услуги.
   * @var integer
   */
  const PRICE = 15;


  /**
   * {@inheritDoc}
   * @see \Taxi\Service\Service::getPrice()
   */
  function getPrice(int $time, int $distance): int {

    return self::PRICE * ceil($time / 60);
  }
}