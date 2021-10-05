<?php
namespace App\Factories\ModelFactories;
use App\Models\MimicSpeakerModel;
use Psr\Container\ContainerInterface;

class MimicSpeakerModelFactory
{
	public function __invoke(ContainerInterface $container): MimicSpeakerModel
	{
		$db = $container->get('pdo');
		$errorLogger = $container->get('errorLoggerModel');
		return new MimicSpeakerModel($db, $errorLogger);
	}
}