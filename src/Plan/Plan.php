<?php


namespace Taxi\Plan;


use Taxi\Driver;
use Taxi\Service\Service;


/**
 * Абстрактный класс тарифного плана.
 * @abstract
 */
abstract class Plan {


  /**
   * Доп услуги.
   * @var array
   */
  private $services = [];


  /**
   * Получить стоимость за пройденное расстояние.
   * @param int расстояние в киломентрах.
   * @return int стоимость.
   */
  abstract function getPricePerDistance(int $distance): int;


  /**
   * Получить стоимость за потраченное время.
   * @param int $time время в минутах.
   * @return int стоимость.
   */
  abstract function getPricePerTime(int $time): int;


  /**
   * Получить список поддерживаемых доп услуг.
   * @return int список услуг.
   */
  abstract function getSupportedServices(): array;


  /**
   * Получить инстанс класса.
   * @param Driver $driver водитель.
   * @return Plan тарифный план.
   */
  public static function getInstance(Driver $driver): Plan {

    return new static($driver);
  }


  /**
   * @param Driver $driver водитель.
   */
  protected function __construct(private Driver $driver) {

  }


  /**
   * Добавить доп услугу к поездке.
   * @param $service $service
   */
  public function addService(Service $service): Plan {

    if (in_array(get_class($service), $this->getSupportedServices())) {
      $this->services[] = $service;
    }

    return $this;
  }


  /**
   * Расчитать полную стоимость по тарифу.
   * @param int $time time in minutes
   * @param int $distance distance in kilometers
   * @return float
   */
  public function calculate(int $time, int $distance): int {

    $totalPrice = 0;

    foreach ($this->services as $service) {
      $totalPrice += $service->getPrice($time, $distance);
    }

    $totalPrice = $totalPrice + $this->getPricePerTime($time) + $this->getPricePerDistance($distance);

    $driverAge = $this->driver->getAge();
    if ($driverAge >= 18 && $driverAge <= 21) {
      $totalPrice = round($totalPrice * 1.1);
    }

    return (int) $totalPrice;
  }
}