<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegister()
    {
       $response = $this->post('/register', [
           'name' => 'Truong',
           'email' => 'truongnguyennhat098@gmail.com',
           'password' => '12345678',
           'password_confirmation'=> '12345678',
       ]);
       $response->assertRedirect('/home');
    }
}
