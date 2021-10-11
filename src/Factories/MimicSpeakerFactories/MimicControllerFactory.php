<?php

namespace App\Factories\MimicSpeakerFactories;
use App\Controllers\MimicSpeakerControllers\MimicController;
use Psr\Container\ContainerInterface;

class MimicControllerFactory
{
	public function __invoke(ContainerInterface $container): MimicController
	{
		return new MimicController($container);
	}
}