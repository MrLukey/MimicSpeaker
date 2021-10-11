<?php

namespace App\Factories\MimicSpeakerFactories;
use App\Controllers\MimicSpeakerControllers\BuildMimicSpeakerController;
use Psr\Container\ContainerInterface;

class BuildMimicSpeakerControllerFactory
{
	public function __invoke(ContainerInterface $container): BuildMimicSpeakerController
	{
		return new BuildMimicSpeakerController($container);
	}
}