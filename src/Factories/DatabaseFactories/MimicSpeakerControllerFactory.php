<?php

namespace App\Factories\DatabaseFactories;
use App\Controllers\DatabaseControllers\MimicSpeakerController;
use Psr\Container\ContainerInterface;

class MimicSpeakerControllerFactory
{
	public function __invoke(ContainerInterface $container): MimicSpeakerController
	{
		return new MimicSpeakerController($container);
	}
}