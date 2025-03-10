<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;

uses(DatabaseTransactions::class);

test('mass assignable attributes are set correctly', function () {
    $user = new User();
    expect($user->getFillable())->toBe(['name', 'email', 'password']);
});

test('hidden attributes are set correctly', function () {
    $user = new User();
    expect($user->getHidden())->toBe(['password', 'remember_token']);
});

test('casts attributes are set correctly', function () {
    $user = new User();
    expect($user->getCasts())->toBe(['id' => 'int', 'email_verified_at' => 'datetime', 'password' => 'hashed']);
});

test('can create user with valid attributes', function () {
    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password123'),
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});
