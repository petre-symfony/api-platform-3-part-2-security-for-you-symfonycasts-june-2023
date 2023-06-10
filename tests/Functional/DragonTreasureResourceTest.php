<?php

namespace App\Tests\Functional;

use App\Entity\ApiToken;
use App\Factory\ApiTokenFactory;
use App\Factory\DragonTreasureFactory;
use App\Factory\UserFactory;
use Zenstruck\Browser\HttpOptions;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\ResetDatabase;

class DragonTreasureResourceTest extends ApiTestCase {
	use ResetDatabase;

	public function testGetCollectionOfTreasures(): void {
		DragonTreasureFactory::createMany(5);

		$json = $this->browser()
			->get('/api/treasures')
			->assertJson()
			->assertJsonMatches('"hydra:totalItems"', 5)
			->json();

		$this->assertSame(array_keys($json->decoded()['hydra:member'][0]), [
			'@id',
			'@type',
			'name',
			'description',
			'value',
			'coolFactor',
			'owner',
			'shortDescription',
			'plunderedAtAgo'
		]);
	}

	public function testPostCreateTreasure(): void {
		$user = UserFactory::createOne();

		$this->browser()
			->actingAs($user)
			->post('/api/treasures', [
				'json' => []
			])
			->assertStatus(422)
			->post('/api/treasures', HttpOptions::json([
					'name' => 'A shiny thing',
					'description' => 'It sparkles when I have it in the air',
					'value' => 1000,
					'coolFactor' => 5,
					'owner' => '/api/users/' . $user->getId()

			]))
			->assertStatus(201)
			->assertJsonMatches('name', 'A shiny thing')
		;
	}

	public function testPostToCreateTreasureWithApiKey(): void{
		$token = ApiTokenFactory::createOne([
			'scopes' => [ ApiToken::SCOPE_TREASURE_CREATE ]
		]);

		$this->browser()
			->post('/api/treasures', [
				'json' => [],
				'headers' => [
					'Authorization' => 'Bearer ' . $token->getToken()
				]
			])
			->dump()
			->assertStatus(422)
		;
	}
}