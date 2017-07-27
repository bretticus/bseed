<?php

namespace BambooSeeder\Libraries;

/**
 * Description of Repository
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class Repository {

	/**
	 *
	 * @return array
	 */
	public static function getDivisions() {
		return [
			'Administration',
			'Corporate Office',
			'Executive',
			'Field',
			'Manufacturing',
			'Training',
			'HR'
		];
	}

	/**
	 *
	 * @return array
	 */
	public static function getDepartments() {
		return [
			'Accounting &amp; Finance',
			'Engineering',
			'HR',
			'Industrial',
			'Manufacturing',
			'Office Administration',
			'Projects',
			'Training',
		];
	}

	/**
	 *
	 * @return array
	 */
	public static function getHeaders() {
		return [
			'Status',
			'Employee #',
			'First name',
			'Nickname',
			'Middle name',
			'Last name',
			'Birth Date',
			'SSN',
			'Gender',
			'Marital status',
			'Country',
			'Address line 1',
			'Address line 2',
			'City',
			'State',
			'ZIP code',
			'Mobile phone',
			'Home phone',
			'Work phone',
			'Ext.',
			'Work email',
			'Home email',
			'Hire date',
			'Employment status',
			'Job title',
			'Department',
			'Division',
			'Location',
			'Pay rate',
			'Pay type',
			'Pay period',
			'FLSA Code',
			'Ethnicity',
			'EEO Job Category',
			'Veteran Status',
			'Termination date',
			'Eligible for rehire',
			'Termination type',
			'Termination reason'
		];
	}

	/**
	 *
	 * @return string
	 */
	public static function getRandomDivision() {
		$divisions = static::getDivisions();
		return static::getRandom($divisions);
	}

	/**
	 *
	 * @return string
	 */
	public static function getRandomDepartment() {
		$departments = static::getDivisions();
		return static::getRandom($departments);
	}

	/**
	 *
	 * @return string
	 */
	public static function getRandomGender() {
		return rand(0, 1) === 1 ? 'male' : 'female';
	}

	/**
	 *
	 * @return string
	 */
	public static function getRandomMaritalStatus() {
		return rand(0, 1) === 1 ? 'Married' : 'Single';
	}

	/**
	 *
	 * @param int $counter count in loop
	 * @return string
	 */
	public static function getBiasEmploymentStatus($counter) {
		return $counter % 7 === 0 ? 'Part-Time' : 'Full-Time';
	}

	/**
	 *
	 * @param array $array
	 * @return string
	 */
	public static function getRandom($array) {
		return $array[mt_rand(0, count($array) - 1)];
	}

	/**
	* @return string
	**/
	public static function getPayPeriod() {
		return self::getRandom([
			'Daily',
			'Weekly',
			'Every other week',
			'Twice a month',
			'Monthly',
			'Quarterly',
			'Twice a year',
			'Yearly'
		]);
	}

}
