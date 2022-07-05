<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $plainPassword = '12345678';
        $user = User::create(
            [
                'name' => 'truong',
                'email' => 'truongnguyennhat098@gmail.com',
                'password'=>Hash::make($plainPassword),
            ]
            );
            $response = $this->post('/login', ['email'=>$user->email, 'password'=> $plainPassword]);
            $response->assertRedirect('/home');
            $response->assertStatus(302);
    }

    public function testLoginInCorrectPassword()
    {
        $plainPassword = '12345678';
        $user = User::create(
            [
                'name' => 'long',
                'email' => 'vanlong@gmail.com',
                'password'=>Hash::make($plainPassword),
            ]
            );
            $response = $this->post('/login', ['email'=>$user->email, 'password'=> '123456']);
            $response->assertRedirect('/');
            $response->assertStatus(302);
    }
}
