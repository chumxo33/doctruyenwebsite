<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $user;
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->user);
    }
    public function test_table_name()
    {
        $this->assertEquals('users', $this->user->getTable());
    }
    public function test_fillable()
    {
        $this->assertEquals([
            'name',
            'email',
            'password',
            'google_id',
        ], $this->user->getFillable());
    }
    public function test_hidden()
    {
        $this->assertEquals([
            'password',
            'remember_token'
        ], $this->user->getHidden()
        );
    }

    public function test_database_user()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'truong'
        ]);
    }
}
