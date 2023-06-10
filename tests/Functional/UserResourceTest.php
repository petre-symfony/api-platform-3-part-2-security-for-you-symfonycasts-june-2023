<?php

namespace App\Tests\Functional;

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
				]
			])
			->assertStatus(200)
		;
	}
}