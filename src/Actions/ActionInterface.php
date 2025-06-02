<?php

namespace Apc66\World\Actions;

interface ActionInterface
{
	public function execute(array $args): self;
}
