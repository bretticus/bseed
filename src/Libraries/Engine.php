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
	 * @return array
	 */
	public static function render($number = 10) {
		$faker = Factory::create();
		$data = [];
		for ($i = 0; $i < $number; $i++) {
			$gender = rand(0, 1) === 1 ? 'male' : 'female';
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
				$faker->unique()->randomNumber(5),
				$firstName,
				'',
				$i % 2 === 0 ? $middleName : '',
				$lastName,
				$faker->dateTimeThisCentury->format('n/d/Y'),
				$faker->numerify('000-##-####'),
				ucfirst($gender),
				rand(0, 1) === 1 ? 'Married' : 'Single',
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
				$faker->dateTimeThisDecade->format('n/d/Y'),
				'Active',
				$faker->jobTitle,
				'', #Department
				'', #Division
				'', #Location
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
