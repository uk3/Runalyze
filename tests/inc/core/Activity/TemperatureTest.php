<?php

namespace Runalyze\Activity;

use Runalyze\Configuration;
use Runalyze\Parameter\Application\TemperatureUnit;

class TemperatureTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$this->assertEquals('15.0', (new Temperature(15, new TemperatureUnit(TemperatureUnit::CELSIUS)))->string(false, 1));
		$this->assertEquals('59.0', (new Temperature(15, new TemperatureUnit(TemperatureUnit::FAHRENHEIT)))->string(false, 1));
	}

	public function testSettingInPreferredUnit()
	{
		$this->assertEquals(15, (new Temperature(0, new TemperatureUnit(TemperatureUnit::CELSIUS)))->setInPreferredUnit(15)->celsius(), '', 0.1);
		$this->assertEquals(15.00, (new Temperature(0, new TemperatureUnit(TemperatureUnit::FAHRENHEIT)))->setInPreferredUnit(59)->celsius(), '', 0.1);
	}

	public function testFromCelsius()
	{
		$Temperature = new Temperature();
		$Temperature->set(15);

		$this->assertEquals(15.00, $Temperature->celsius());
		$this->assertEquals(59.00, $Temperature->fahrenheit(), '', 0.01);
	}

	public function testFromFahrenheit()
	{
		$Temperature = new Temperature();
		$Temperature->setFahrenheit(59);

		$this->assertEquals(59.00, $Temperature->fahrenheit());
		$this->assertEquals(15, $Temperature->celsius(), '', 0.01);
	}

	public function testStaticMethod()
	{
		Configuration::General()->temperatureUnit()->set(TemperatureUnit::CELSIUS);
		$unit = '&nbsp;'.Configuration::General()->TemperatureUnit()->unit();

		$this->assertEquals('10.0'.$unit, Temperature::format(10, true, 1));
		$this->assertEquals('12.35'.$unit, Temperature::format(12.3456, true, 2));
	}

	public function testEmptyTemperature()
	{
		$Temperature = new Temperature();

		$this->assertTrue($Temperature->isEmpty());
		$this->assertNull($Temperature->value());
		$this->assertNull($Temperature->celsius());
		$this->assertNull($Temperature->fahrenheit());
	}

	public function testEmptyTemperatureAfterChanging()
	{
		$Temperature = new Temperature(13);
		$Temperature->setInPreferredUnit(null);

		$this->assertTrue($Temperature->isEmpty());
		$this->assertNull($Temperature->value());
		$this->assertNull($Temperature->celsius());
		$this->assertNull($Temperature->fahrenheit());
	}
}
