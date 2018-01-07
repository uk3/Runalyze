<?php
/**
 * This file contains class::VerticalOscillation
 * @package Runalyze\View\Activity\Plot
 */

namespace Runalyze\View\Activity\Plot;

use Runalyze\View\Activity;

/**
 * Plot for: Vertical oscillation
 * 
 * @author Hannes Christiansen
 * @package Runalyze\View\Activity\Plot
 */
class VerticalOscillation extends ActivityPlot {
	/**
	 * Set key
	 */
	protected function setKey() {
		$this->key   = 'verticaloscillation';
	}

	/**
	 * Init data
	 * @param \Runalyze\View\Activity\Context $context
	 */
	protected function initData(Activity\Context $context) {
		$this->addSeries(
			new Series\VerticalOscillation($context)
		);
	}
}
