<?php

namespace Apc66\World\Tests\Unit;

use Apc66\World\Actions\City;
use Apc66\World\Actions\Country;
use Apc66\World\Actions\Currency;
use Apc66\World\Actions\State;
use Apc66\World\Actions\Timezone;
use Apc66\World\Actions\Language;
use Apc66\World\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class CountryTest extends TestCase
{
	/** @test */
	public function can_respond_with_countries()
	{
		$action = app(Country\IndexAction::class)->execute();

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_country()
	{
		$action = app(Country\IndexAction::class)->execute([
			'filters' => [
				'iso2' => 'FR',
			],
		]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_states()
	{
		$action = app(State\IndexAction::class)->execute([
			'filters' => [
				'country_id' => 182,
			],
		]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_cities()
	{
		$action = app(City\IndexAction::class)->execute([
			'filters' => [
				'country_id' => 182,
			],
		]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_timezones()
	{
		$action = app(Timezone\IndexAction::class)->execute([
			'filters' => [
				'country_id' => 182,
			],
		]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_currencies()
	{
		$action = app(Currency\IndexAction::class)->execute([
			'filters' => [
				'country_id' => 182,
			],
		]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}

	/** @test */
	public function can_respond_with_languages()
	{
		$action = app(Language\IndexAction::class)->execute([]);

		self::assertTrue($action->success === true);
		self::assertNotEmpty($action->data);
		self::assertTrue($action->statusCode === Response::HTTP_OK);
	}
}
