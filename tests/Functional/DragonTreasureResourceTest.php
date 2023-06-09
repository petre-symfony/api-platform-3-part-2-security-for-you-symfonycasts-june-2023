<?php

namespace Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\ResetDatabase;

class DragonTreasureResourceTest extends KernelTestCase {
	use HasBrowser;
	use ResetDatabase;

	public function testGetCollectionOfTreasures(): void {
		$this->browser()
			->get('/api/treasures')
			->assertJson()
			->assertJsonMatches('hydra:totalItems', 0)
		;
	}
}