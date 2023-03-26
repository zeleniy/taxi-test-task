<?php


namespace Taxi;


/**
 * Водитель.
 */
class Driver {


  /**
   * @param int $age возраст
   * @throws \LogicException
   */
  public function __construct(private int $age) {

    if ($this->age < 18 || $this->age > 65) {
      throw new \LogicException('Driver age should be between 18 and 65');
    }
  }


  /**
   * Получить возраст водителя.
   */
  public function getAge(): int {

    return $this->age;
  }
}