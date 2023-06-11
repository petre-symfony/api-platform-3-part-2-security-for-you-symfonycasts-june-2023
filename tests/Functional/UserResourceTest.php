<?php

namespace App\Tests\Functional;

use App\Factory\DragonTreasureFactory;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Test\ResetDatabase;

class UserResourceTest extends ApiTestCase {
	use ResetDatabase;

	public function testPostCreateUser(): void {
		$this->browser()
			->post('/api/users', [
				'json' => [
					'email' => 'ciolaci@gmail.com',
					'username' => 'ciolaci',
					'password' => 'password'
				]
			])
			->assertStatus(201)
			->post('/login', [
				'json' => [
					'email' => 'ciolaci@gmail.com',
					'password' => 'password'
				]
			])
			->assertSuccessful()
		;
	}

	public function testPatchToUpdateUser(): void {
		$user = UserFactory::createOne();

		$this->browser()
			->actingAs($user)
			->patch('/api/users/' . $user->getId(), [
				'json' => [
					'username' => 'changed'
				],
				'headers' => [
					'Content-Type' => 'application/merge-patch+json'
				]
			])
			->assertStatus(200)
		;
	}

	public function testTreasuresCannotBeStolen(): void {
		$user = UserFactory::createOne();
		$otherUser = UserFactory::createOne();
		$dragonTreasure = DragonTreasureFactory::createOne([
			'owner' => $otherUser
		]);

		$this->browser()
			->actingAs($user)
			->patch('/api/users/' . $user->getId(), [
				'json' => [
					'username' => 'changed',
					'dragonTreasures' => [
						'/api/treasures/' . $dragonTreasure->getId()
					]
				],
				'headers' => [
					'Content-Type' => 'application/merge-patch+json'
				]
			])
			->assertStatus(422)
		;
	}
}