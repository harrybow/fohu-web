<?php

use App\Models\User;
use App\Models\Workday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

// Guests should be redirected to the login page when attempting to sign up
// or cancel participation.

test('guest cannot sign up for a workday', function () {
    $workday = Workday::create(['day' => '2025-06-10']);

    $response = $this->post(route('workdays.signup', $workday), ['status' => 'A']);

    $response->assertRedirect('/login');
    $this->assertDatabaseEmpty('user_workday');
});

test('guest cannot cancel signup', function () {
    $workday = Workday::create(['day' => '2025-06-10']);

    $response = $this->delete(route('workdays.cancel', $workday));

    $response->assertRedirect('/login');
});

// Regular users are able to sign up for a workday and later cancel.

test('user can sign up for a workday', function () {
    $user = User::factory()->create();
    $workday = Workday::create(['day' => '2025-06-11']);

    $this->actingAs($user)
        ->post(route('workdays.signup', $workday), ['status' => '0.5'])
        ->assertRedirect();

    $this->assertDatabaseHas('user_workday', [
        'user_id' => $user->id,
        'workday_id' => $workday->id,
        'status' => '0.5',
    ]);
});

test('user can cancel a workday signup', function () {
    $user = User::factory()->create();
    $workday = Workday::create(['day' => '2025-06-12']);

    $user->workdays()->attach($workday->id, ['status' => '1']);

    $this->actingAs($user)
        ->delete(route('workdays.cancel', $workday))
        ->assertRedirect();

    $this->assertDatabaseMissing('user_workday', [
        'user_id' => $user->id,
        'workday_id' => $workday->id,
    ]);
});

// Administrators have the same ability as regular users.

test('admin can sign up and cancel as well', function () {
    Role::create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $workday = Workday::create(['day' => '2025-06-13']);

    $this->actingAs($admin)
        ->post(route('workdays.signup', $workday), ['status' => 'A'])
        ->assertRedirect();

    $this->assertDatabaseHas('user_workday', [
        'user_id' => $admin->id,
        'workday_id' => $workday->id,
        'status' => 'A',
    ]);

    $this->actingAs($admin)
        ->delete(route('workdays.cancel', $workday))
        ->assertRedirect();

    $this->assertDatabaseMissing('user_workday', [
        'user_id' => $admin->id,
        'workday_id' => $workday->id,
    ]);
});

