<?php

namespace App\Factories\EntityFactories;
use App\Entities\MimicSpeakerEntity;

class MimicSpeakerEntityFactory
{
	public function __invoke(): MimicSpeakerEntity
	{
		return new MimicSpeakerEntity();
	}
}