<?php

namespace Apc66\World\Http\Controllers;

use Apc66\World\Http\Response\ResponseBuilder;
use Illuminate\Http\JsonResponse;

class BaseController
{
	protected string $requestBasePath = 'Apc66\\World\\Http\\Requests';

	protected string $actionBasePath = 'Apc66\\World\\Actions';

	/**
	 * @param $function
	 * @param  null  $args
	 * @return JsonResponse
	 */
	public function __call($function, $args = null): JsonResponse
	{
		// Request class
		$requestClass = $this->composeRequestClass($function);

		$actionArgs = class_exists($requestClass) ? app($requestClass)->validated() : null;

		// Action
		$responseBuilder = app($this->composeActionClass($function))
			->execute($actionArgs)
			->withResponse();

		// Response
		return $this->respond($responseBuilder);
	}

	/**
	 * @param  string  $function
	 * @return string
	 */
	private function composeRequestClass(string $function): string
	{
		return implode('\\', [$this->requestBasePath, ucfirst($function)]) . 'Request';
	}

	/**
	 * @param  string  $function
	 * @return string
	 */
	private function composeActionClass(string $function): string
	{
		return implode('\\', [$this->actionBasePath, ucfirst($function)]) . 'Action';
	}

	/**
	 * @param  ResponseBuilder  $responseBuilder
	 * @return JsonResponse
	 */
	public function respond(ResponseBuilder $responseBuilder): JsonResponse
	{
		return $responseBuilder->toJson();
	}
}
