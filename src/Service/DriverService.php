<?php


namespace Taxi\Service;


/**
 * Услуга дополнительного водителя.
 */
class DriverService extends Service {


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

    return self::PRICE;
  }
}