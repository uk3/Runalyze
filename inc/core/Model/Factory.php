<?php
/**
 * This file contains class::Factory
 * @package Runalyze\Model
 */

namespace Runalyze\Model;

use DB;
use Cache;

/**
 * Model factory
 * 
 * @author Hannes Christiansen
 * @package Runalyze\Model
 */
class Factory {
	/**
	 * Database
	 * @var \PDOforRunalyze
	 */
	protected $DB;

	/**
	 * Account ID
	 * @var int
	 */
	protected $AccountID;

	/**
	 * Factory
	 * @param int $accountID [optional]
	 */
	public function __construct($accountID = null) {
		$this->DB = DB::getInstance();
		$this->AccountID = $accountID;
	}

	/**
	 * Has account id?
	 * @return bool
	 */
	protected function hasAccountID() {
		return !is_null($this->AccountID);
	}

	/**
	 * Trackdata
	 * @param int $activityid
	 * @return \Runalyze\Model\Trackdata\Object
	 */
	public function trackdata($activityid) {
		$Data = $this->arrayByPK('trackdata', $activityid);

		return new Trackdata\Object($Data);
	}

	/**
	 * Array by primary key
	 * @param string $tablename
	 * @param int $id
	 * @param int $cachetime [optional]
	 * @return array
	 */
	protected function arrayByPK($tablename, $id, $cachetime = 3600) {
		if (!$cachetime) {
			return $this->fetch($tablename, $id);
		}

		$Data = Cache::get($tablename.$id);
		if (is_null($Data)) {
			$Data = $this->fetch($tablename, $id);

			Cache::set($tablename.$id, $Data, $cachetime);
		} else {
			//Cache::touch($tablename.$id);
		}

		return $Data;
	}

	/**
	 * Fetch data
	 * @param string $tablename
	 * @param int $id
	 * @return array
	 */
	protected function fetch($tablename, $id) {
		$field = $this->primaryKey($tablename);
		$AndAccountID = $this->hasAccountID() && $this->tableHasAccountid($tablename) ? 'AND `accountid`='.(int)$this->AccountID : '';

		return $this->DB->query('SELECT * FROM `'.PREFIX.$tablename.'` WHERE `'.$field.'`='.(int)$id.' '.$AndAccountID.' LIMIT 1')->fetch();
	}

	/**
	 * Get primary key
	 * @param string $tablename
	 * @return string
	 */
	protected function primaryKey($tablename) {
		switch ($tablename) {
			case 'trackdata':
				return 'activityid';
		}

		return 'id';
	}

	/**
	 * Has the table a column 'accountid'?
	 * @param string $tablename
	 * @return boolean
	 */
	protected function tableHasAccountid($tablename) {
		switch ($tablename) {
			case 'account':
			case 'plugin_conf':
				return false;
		}

		return true;
	}
}