<?php
/**
 * This file contains class::Object
 * @package Runalyze\Model\Route
 */

namespace Runalyze\Model\Route;

use Runalyze\Model;

/**
 * Route object
 * 
 * @author Hannes Christiansen
 * @package Runalyze\Model\Route
 */
class Object extends Model\ObjectWithID {
	/**
	 * Cities separator
	 * @var string
	 */
	const CITIES_SEPARATOR = ' - ';

	/**
	 * Key: name
	 * @var string
	 */
	const NAME = 'name';

	/**
	 * Key: cities
	 * @var string
	 */
	const CITIES = 'cities';

	/**
	 * Key: distance
	 * @var string
	 */
	const DISTANCE = 'distance';

	/**
	 * Key: elevation
	 * @var string
	 */
	const ELEVATION = 'elevation';

	/**
	 * Key: elevation up
	 * @var string
	 */
	const ELEVATION_UP = 'elevation_up';

	/**
	 * Key: elevation down
	 * @var string
	 */
	const ELEVATION_DOWN = 'elevation_down';

	/**
	 * Key: latitudes
	 * @var string
	 */
	const LATITUDES = 'lats';

	/**
	 * Key: longitudes
	 * @var string
	 */
	const LONGITUDES = 'lngs';

	/**
	 * Key: elevations original
	 * @var string
	 */
	const ELEVATIONS_ORIGINAL = 'elevations_original';

	/**
	 * Key: elevations corrected
	 * @var string
	 */
	const ELEVATIONS_CORRECTED = 'elevations_corrected';

	/**
	 * Key: elevations source
	 * @var string
	 */
	const ELEVATIONS_SOURCE = 'elevations_source';

	/**
	 * Key: startpoint latitude
	 * @var string
	 */
	const STARTPOINT_LATITUDE = 'startpoint_lat';

	/**
	 * Key: startpoint longitude
	 * @var string
	 */
	const STARTPOINT_LONGITUDE = 'startpoint_lng';

	/**
	 * Key: endpoint latitude
	 * @var string
	 */
	const ENDPOINT_LATITUDE = 'endpoint_lat';

	/**
	 * Key: endpoint longitude
	 * @var string
	 */
	const ENDPOINT_LONGITUDE = 'endpoint_lng';

	/**
	 * Key: minimal latitude
	 * @var string
	 */
	const MIN_LATITUDE = 'min_lat';

	/**
	 * Key: minimal longitude
	 * @var string
	 */
	const MIN_LONGITUDE = 'min_lng';

	/**
	 * Key: maximal latitude
	 * @var string
	 */
	const MAX_LATITUDE = 'max_lat';

	/**
	 * Key: maximal longitude
	 * @var string
	 */
	const MAX_LONGITUDE = 'max_lng';

	/**
	 * Key: in routenet
	 * @var string
	 */
	const IN_ROUTENET = 'in_routenet';

	/**
	 * Construct
	 * @param array $data
	 */
	public function __construct(array $data = array()) {
		parent::__construct($data);

		$this->checkArraySizes();
	}

	/**
	 * All properties
	 * @return array
	 */
	static public function allProperties() {
		return array(
			self::NAME,
			self::CITIES,
			self::DISTANCE,
			self::ELEVATION,
			self::ELEVATION_UP,
			self::ELEVATION_DOWN,
			self::LATITUDES,
			self::LONGITUDES,
			self::ELEVATIONS_ORIGINAL,
			self::ELEVATIONS_CORRECTED,
			self::ELEVATIONS_SOURCE,
			self::STARTPOINT_LATITUDE,
			self::STARTPOINT_LONGITUDE,
			self::ENDPOINT_LATITUDE,
			self::ENDPOINT_LONGITUDE,
			self::MIN_LATITUDE,
			self::MIN_LONGITUDE,
			self::MAX_LATITUDE,
			self::MAX_LONGITUDE,
			self::IN_ROUTENET
		);
	}

	/**
	 * Properties
	 * @return array
	 */
	public function properties() {
		return static::allProperties();
	}

	/**
	 * Is the property an array?
	 * @param string $key
	 * @return bool
	 */
	public function isArray($key) {
		switch ($key) {
			case self::ELEVATIONS_ORIGINAL:
			case self::ELEVATIONS_CORRECTED:
			case self::LATITUDES:
			case self::LONGITUDES:
				return true;
		}

		return false;
	}

	/**
	 * Synchronize internal models
	 */
	public function synchronize() {
		parent::synchronize();

		$this->synchronizeStartAndEndpoint();
		$this->synchronizeBoundaries();
	}

	/**
	 * Synchronize start- and endpoint
	 */
	protected function synchronizeStartAndEndpoint() {
		if ($this->numberOfPoints == 0) {
			$this->Data[self::STARTPOINT_LATITUDE] = '';
			$this->Data[self::STARTPOINT_LONGITUDE] = '';
			$this->Data[self::ENDPOINT_LATITUDE] = '';
			$this->Data[self::ENDPOINT_LONGITUDE] = '';
		} else {
			$this->Data[self::STARTPOINT_LATITUDE] = reset($this->Data[self::LATITUDES]);
			$this->Data[self::STARTPOINT_LONGITUDE] = reset($this->Data[self::LONGITUDES]);
			$this->Data[self::ENDPOINT_LATITUDE] = end($this->Data[self::LATITUDES]);
			$this->Data[self::ENDPOINT_LONGITUDE] = end($this->Data[self::LONGITUDES]);
		}
	}

	/**
	 * Synchronize boundaries
	 */
	protected function synchronizeBoundaries() {
		if ($this->numberOfPoints == 0) {
			$this->Data[self::MIN_LATITUDE] = '';
			$this->Data[self::MIN_LONGITUDE] = '';
			$this->Data[self::MAX_LATITUDE] = '';
			$this->Data[self::MAX_LONGITUDE] = '';
		} else {
			$this->Data[self::MIN_LATITUDE] = min($this->Data[self::LATITUDES]);
			$this->Data[self::MIN_LONGITUDE] = min($this->Data[self::LONGITUDES]);
			$this->Data[self::MAX_LATITUDE] = max($this->Data[self::LATITUDES]);
			$this->Data[self::MAX_LONGITUDE] = max($this->Data[self::LONGITUDES]);
		}
	}

	/**
	 * Number of points
	 * @return int
	 */
	public function num() {
		return $this->numberOfPoints;
	}

	/**
	 * Name
	 * @return string
	 */
	public function name() {
		return $this->Data[self::NAME];
	}

	/**
	 * Cities as array
	 * @return array
	 */
	public function citiesAsArray() {
		return explode(self::CITIES_SEPARATOR, $this->Data[self::CITIES]);
	}

	/**
	 * Distance
	 * @return float
	 */
	public function distance() {
		return $this->Data[self::DISTANCE];
	}

	/**
	 * Elevation
	 * @return int
	 */
	public function elevation() {
		return $this->Data[self::ELEVATION];
	}

	/**
	 * Elevation up
	 * @return int
	 */
	public function elevationUp() {
		return $this->Data[self::ELEVATION_UP];
	}

	/**
	 * Elevation down
	 * @return int
	 */
	public function elevationDown() {
		return $this->Data[self::ELEVATION_DOWN];
	}

	/**
	 * Latitudes
	 * @return array
	 */
	public function latitudes() {
		return $this->Data[self::LATITUDES];
	}

	/**
	 * Longitudes
	 * @return array
	 */
	public function longitudes() {
		return $this->Data[self::LONGITUDES];
	}

	/**
	 * Has position data?
	 * @return boolean
	 */
	public function hasPositionData() {
		return $this->has(self::LATITUDES) && $this->has(self::LONGITUDES);
	}

	/**
	 * Original elevations
	 * @return array
	 */
	public function elevationsOriginal() {
		return $this->Data[self::ELEVATIONS_ORIGINAL];
	}

	/**
	 * Corrected elevations
	 * @return array
	 */
	public function elevationsCorrected() {
		return $this->Data[self::ELEVATIONS_CORRECTED];
	}

	/**
	 * Is in routenet?
	 * @return boolean
	 */
	public function inRoutenet() {
		return ($this->Data[self::IN_ROUTENET] == 1);
	}
}