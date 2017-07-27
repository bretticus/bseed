<?php

namespace BambooSeeder\Libraries;

use Faker\Factory;
use BambooSeeder\Libraries\Repository;

/**
 * Description of Engine
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class Engine {

	/**
	 *
	 * @param int	$number				Number of seed records to produce. (defaults to 10)
	 * @param bool	$supressHeaders		Should we suppress the headers as the 1st row? (defaults to false)
	 * @param type	$numberLocations	Number of locations to generate (defaults to 3)
	 * @return array
	 */
	public static function render($number = 10, $supressHeaders = false, $numberLocations = 3) {
		$faker = Factory::create();
		$data = $supressHeaders ? [] : [Repository::getHeaders()];
		$locations = [];
		for ($i = 0; $i < $numberLocations; $i++) {
			$locations[] = $faker->city;
		}
		for ($i = 0; $i < $number; $i++) {
			$gender = Repository::getRandomGender();
			$firstName = $faker->firstName($gender);
			$lastName = $faker->lastName;
			$middleName = rand(0, 1) === 1 ? strtoupper($faker->randomLetter) : $faker->firstName($gender);
			if (rand(0, 1) === 1) {
				$payRate = $faker->numberBetween(3, 9) . $faker->numerify('#000.00');
				$payType = 'Salary';
			} else {
				$payRate = $faker->numberBetween(1, 4) . $faker->numerify('#.00');
				$payType = 'Hourly';
			}
			$data[] = [
				'Active',
				str_pad($faker->unique()->randomNumber(4), 6, '0', STR_PAD_LEFT),
				$firstName,
				'',
				$i % 2 === 0 ? $middleName : '',
				$lastName,
				$faker->dateTimeThisCentury->format('n/j/Y'),
				$faker->numerify('000-##-####'),
				ucfirst($gender),
				Repository::getRandomMaritalStatus(),
				'US',
				$faker->streetAddress,
				$faker->secondaryAddress,
				$faker->city,
				$faker->stateAbbr,
				$faker->postcode,
				$faker->phoneNumber,
				$faker->phoneNumber,
				$faker->phoneNumber,
				$i % 3 === 0 ? $faker->numerify('x###') : '',
				$faker->companyEmail,
				$faker->freeEmail,
				$faker->dateTimeThisDecade->format('n/j/Y'),
				Repository::getBiasEmploymentStatus($i),
				$faker->jobTitle,
				Repository::getRandomDepartment(), #Department
				Repository::getRandomDivision(), #Division
				Repository::getRandom($locations), #Location
				$payRate, #Pay rate
				Repository::getPayPeriod(), #Pay period
				'', #FLSA Code
				'', #Ethnicity
				'', #EEO Job Category
				'', #Veterans' status
				'', #Termination date
				'', #Eligible for rehire
				'', #Termination type
				'' #Termination reason
			];
		}
		return $data;
	}

}
