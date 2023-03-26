<?php


namespace Taxi\Service;


/**
 * Абстрактный класс услуги.
 * @abstract
 */
abstract class Service {


  /**
   * Расчитать стоимость услуги.
   * @param int $time время в минутах
   * @param int $distance пройденное расстояние
   * @return int
   */
  abstract function getPrice(int $time, int $distance): int;


  /**
   * Получить инстанс класса.
   * @return Service услуга.
   */
  public static function getInstance(): Service {

    return new static();
  }
}