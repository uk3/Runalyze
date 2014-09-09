<?php
/**
 * This file contains class::TrainingPlotPowerDistribution
 * @package Runalyze\Draw\Training
 */
/**
 * Training plot for power
 * @package Runalyze\Draw\Training
 */
class TrainingPlotPowerDistribution extends TrainingPlot {
	/**
	 * Selection enabled?
	 * @var bool
	 */
	protected $selecting = false;

	/**
	 * Uses standard x-axis?
	 * @var bool
	 */
	protected $useStandardXaxis = false;

	/**
	 * Labels
	 * @var array
	 */
	private $Labels = array();

	/**
	 * Is this plot visible?
	 * @return string
	 */
	public function isVisible() {
		return CONF_TRAINING_SHOW_PLOT_POWER;
	}

	/**
	 * Set key and title for this plot
	 */
	protected function setKeyAndTitle() {
		$this->key   = 'power_distribution';
		$this->title = 'Power Distribution';
	}

	/**
	 * Init data
	 */
	protected function initData() {
		$RawData = $this->Training->GpsData()->getPowerDistributionZonesAsFilledArrays();
		$num     = count($RawData);

		for ($i = 0; $i < $num; $i++) {
			$this->Labels[$i] = array($i, '');
			$this->Data[$i]   = 0;
		}

		foreach ($RawData as $key => $val) {
			$w = ($key + 1) * 25;
			if ($num < 20) {
				$label = $w.' W';
			} elseif ($num < 50) {
				$label = ($key%5 == 0 && $w > 0) ? $w.' W' : '';
			} elseif ($num < 100) {
				$label = ($key%10 == 0 && $w > 0) ? $w.' W' : '';
			} else {
				$label = ($key%50 == 0 && $w > 0) ? $w.' W' : '';
			}

			$this->Labels[$key] = array($key, $label);
			$this->Data[$key]   = $val*100;
		}


		$this->Plot->Data[] = array('label' => 'Power Distribution', 'color' => 'rgb(0,136,0)', 'data' => $this->Data);
	}

	/**
	 * Set all properties for this plot 
	 */
	protected function setProperties() {
		$this->Plot->addYUnit(1, "%");
		$this->Plot->setYLimits(1, 0, 100, false);
		$this->Plot->setXLabels($this->Labels);
		$this->Plot->showBars(true);
		$this->Plot->Options['xaxis']['show'] = true; // force to show xaxis-labels, even if no time or distance array is given
	}

	/**
	 * Get data
	 * @param TrainingObject $Training
	 * @return array
	 */
	static public function getData(TrainingObject &$Training) {
		return $Training->GpsData()->getPlotDataForPowerDistribution();
	}
}
