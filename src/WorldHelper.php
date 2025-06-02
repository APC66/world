<?php

namespace Apc66\World;

use Exception;

class WorldHelper
{
	private array $availableActions = [
		'countries' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\Country',
			'action' => 'index',
		],
		'states' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\State',
			'action' => 'index',
		],
		'cities' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\City',
			'action' => 'index',
		],
		'timezones' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\Timezone',
			'action' => 'index',
		],
		'currencies' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\Currency',
			'action' => 'index',
		],
		'languages' => [
			'actionBasePath' => 'Apc66\\World\\Actions\\Language',
			'action' => 'index',
		],
	];

	/**
	 * @param $function
	 * @param  array  $args
	 * @return mixed
	 * @throws Exception
	 */
	public function __call($function, array $args = [])
	{
		list($actionBasePath, $action) = $this->fetchAction($function);

		return app($this->formActionClass($actionBasePath, $action))->execute(! empty($args) ? $args[0] : []);
	}

	/**
	 * @param  string  $function
	 * @return array
	 * @throws Exception
	 */
	private function fetchAction(string $function): array
	{
		if (! in_array(strtolower($function), array_keys($this->availableActions))) {
			throw new Exception('Method not found!');
		}

		['actionBasePath' => $actionBasePath, 'action' => $action] = $this->availableActions[strtolower($function)];

		return [$actionBasePath, $action];
	}

	/**
	 * @param  string  $actionBasePath
	 * @param  string  $function
	 * @return string
	 */
	private function formActionClass(string $actionBasePath, string $function): string
	{
		return implode('\\', [$actionBasePath, ucfirst($function)]) . 'Action';
	}

	/**
	 * @param string $requestLocale
	 * @return $this
	 */
	public function setLocale(string $requestLocale): self
	{
		$setLocale = in_array($requestLocale, config('world.accepted_locales'), true)
			? $requestLocale
			: config('app.fallback_locale');

		app()->setLocale($setLocale);

		return $this;
	}
}
