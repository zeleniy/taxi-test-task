<?php


use PHPUnit\Framework\TestCase;
use Taxi\Driver;


/**
 * 
 */
final class DriverTest extends TestCase {


  /**
   * 
   */
  public function testGetAge(): void {

    $age = rand(18, 65);
    $driver = new Driver($age);

    $this->assertEquals($age, $driver->getAge());
  }
}