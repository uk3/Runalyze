<?php
/**
 * This file contains class::Series
 * @package Runalyze\View\Plot
 */

namespace Runalyze\View\Plot;

use \Plot;
use Runalyze\View\Activity\Plot\ActivityPlot;

/**
 * Plot series
 *
 * @author Hannes Christiansen
 * @package Runalyze\View\Plot
 */
class Series {
	/**
	 * @var string
	 */
	protected $Label;

	/**
	 * @var string
	 */
	protected $Color;

	/**
	 * @var array
	 */
	protected $Data;

	/**
	 * @var string
	 */
	protected $UnitString = '';

	/**
	 * @var int
	 */
	protected $UnitDecimals = 0;

	/**
	 * @var float
	 */
	protected $UnitFactor = 1;

	/**
	 * @var int
	 */
	protected $TickSize = false;

	/**
	 * @var int
	 */
	protected $TickDecimals = 0;

	/**
	 * @var boolean
	 */
	protected $ShowAverage = false;

	/**
	 * @var boolean
	 */
	protected $ShowMaximum = false;

	/**
	 * @var boolean
	 */
	protected $ShowMinimum = false;

	/**
	 * Manual average
	 * A manual average can be used instead of calculating the average of the series
	 * @var mixed
	 */
	protected $ManualAverage = false;

	/**
	 * @var null|int
	 */
	protected $YAxis = null;

	/**
	 * Set label
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->Label = $label;
	}

	/**
	 * @return string
	 */
	public function label() {
		return $this->Label;
	}

	/**
	 * Set color
	 * @param string $color
	 */
	public function setColor($color) {
		$this->Color = $color;
	}

	/**
	 * Set data
	 * @param array $data
	 */
	public function setData(array $data) {
		$this->Data = $data;
	}

	/**
	 * @return boolean
	 */
	public function isEmpty() {
		return empty($this->Data);
	}

	/**
	 * Set properties
	 * @param \Plot $Plot
	 * @param int $yAxis
	 * @param bool $addAnnotations [optional]
	 */
	public function addTo(Plot $Plot, $yAxis, $addAnnotations = true) {
		if (empty($this->Data)) {
			return;
		}

		$this->YAxis = $yAxis;

		if ($this->UnitString == 'time') {
			foreach ($this->Data as $k => $v)
				$this->Data[$k] = $v * "1000";
		}

		$Plot->Data[] = array('label' => $this->Label, 'color' => $this->Color, 'data' => $this->Data, 'yaxis' => $yAxis);

		if ($this->UnitString != '') {
			if ($this->UnitString == 'time') {
				$Plot->setYAxisAsTime($yAxis);
				$Plot->setYAxisTimeFormat('%H:%M:%S', $yAxis);
			} else
				$Plot->addYUnit($yAxis, $this->UnitString, $this->UnitDecimals);
		}

		if ($this->TickSize !== false) {
			$Plot->setYTicks($yAxis, $this->TickSize, $this->TickDecimals);
		}

		if ($addAnnotations && $this->ShowAverage && !empty($this->Data)) {
			$avg = $this->avg();

			$Plot->addThreshold('y'.$yAxis, $avg, 'rgba(0,0,0,0.5)');
			$Plot->addAnnotation(0, $avg, __('avg:').' '.$avg.' '.$this->UnitString);
		}

		if ($addAnnotations && $this->ShowMaximum) {
			$max = max($this->Data);
			$maxX = array_keys($this->Data, $max);

			$Plot->addAnnotation($maxX[0], round($max), round($max).$this->UnitString);
		}

		if ($addAnnotations && $this->ShowMinimum) {
			$min = min($this->Data);
			$minX = array_keys($this->Data, $min);

			$Plot->addAnnotation($minX[0], round($min), round($min).$this->UnitString);
		}
	}

	/**
	 * @param ActivityPlot $plot
	 */
	public function hideIn(ActivityPlot $plot) {
		if (null !== $this->YAxis) {
			$plot->hideYAxisAndSeries($this->YAxis);
		}
	}

	/**
	 * Average
	 * @param int $decimals [optional]
	 * @return int|float
	 */
	protected function avg($decimals = 0) {
		if ($this->ManualAverage !== false) {
			return $this->ManualAverage;
		}

		return round( array_sum($this->Data)/count($this->Data), $decimals );
	}

	/**
	 * @param int|float $value
	 */
	protected function setManualAverage($value) {
		$this->ManualAverage = $value;
	}
}
