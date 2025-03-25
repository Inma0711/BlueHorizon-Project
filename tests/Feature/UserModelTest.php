<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckItChecksIfUserIsAdmin()
    {
        $user = User::factory()->create(['isAdmin' => true]);

        $this->assertTrue($user->isAdmin());
    }

    public function test_CheckItChecksIfUserIsNotAdmin()
    {
        $user = User::factory()->create(['isAdmin' => false]);

        $this->assertFalse($user->isAdmin());
    }
}
