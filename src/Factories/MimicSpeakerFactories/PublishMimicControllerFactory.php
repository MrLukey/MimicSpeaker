<?php

namespace App\Factories\MimicSpeakerFactories;
use App\Controllers\MimicSpeakerControllers\PublishMimicController;
use Psr\Container\ContainerInterface;

class PublishMimicControllerFactory
{
	public function __invoke(ContainerInterface $container): PublishMimicController
	{
		return new PublishMimicController($container);
	}
}