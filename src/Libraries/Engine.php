<?php

namespace BambooSeeder\Libraries;

use Faker\Factory;

/**
 * Description of Engine
 *
 * @author Brett Millett <bmillett@bamboohr.com>
 */
class Engine {

	/**
	 *
	 * @param int $number Number of seed records to produce
	 * @param bool $supressHeaders
	 * @return array
	 */
	public static function render($number = 10, $supressHeaders = false) {
		$faker = Factory::create();
		$data = $supressHeaders ? [] : [Repository::getHeaders()];
		$locations = [];
		for ($i = 0; $i < 3; $i++) {
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
			$location = Repository::getRandom($locations);
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
				'',
				$faker->companyEmail,
				$faker->freeEmail,
				$faker->dateTimeThisDecade->format('n/j/Y'),
				Repository::getBiasEmploymentStatus($i),
				$faker->jobTitle,
				Repository::getRandomDepartment(), #Department
				Repository::getRandomDivision(), #Division
				$location, #Location
				$payRate, #Pay rate
				$payType, #Pay type
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
