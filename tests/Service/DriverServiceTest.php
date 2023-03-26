<?php


use PHPUnit\Framework\TestCase;
use Taxi\Service\DriverService;


/**
 * 
 */
final class DriverServiceTest extends TestCase {


  /**
   * 
   */
  public function testGetPrice(): void {

    $this->assertSame(15, DriverService::getInstance()->getPrice(rand(), rand()));
  }
}