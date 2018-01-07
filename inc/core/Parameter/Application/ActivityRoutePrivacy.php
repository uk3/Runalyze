<?php
/**
 * This file contains class::ActivityRoutePrivacy
 * @package Runalyze\Parameter\Application
 */

namespace Runalyze\Parameter\Application;

/**
 * Activity route privacy
 * @author Hannes Christiansen
 * @package Runalyze\Parameter\Application
 */
class ActivityRoutePrivacy extends \Runalyze\Parameter\Select {
	/**
	 * Show route: never
	 * @var string
	 */
	const NEVER = 'never';

	/**
	 * Show route: for races
	 * @var string
	 */
	const RACE = 'race';

	/**
	 * Show route: always
	 * @var string
	 */
	const ALWAYS = 'always';

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct(self::ALWAYS, array(
			'options'		=> array(
				self::NEVER			=> __('never'),
				self::RACE			=> __('only for race results'),
				self::ALWAYS		=> __('always')
			)
		));
	}

	/**
	 * Show never
	 * @return bool
	 */
	public function showNever() {
		return ($this->value() == self::NEVER);
	}

	/**
	 * Show only for races
	 * @return bool
	 */
	public function showRace() {
		return ($this->value() == self::RACE);
	}

	/**
	 * Show always
	 * @return bool
	 */
	public function showAlways() {
		return ($this->value() == self::ALWAYS);
	}
}
