<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->url = 'api/user';
        $this->model = 'users';
    }

    public function testGetData()
    {
        $this->get($this->url)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email'
                    ]
                ]
            ]);
    }

    public function testShowDataSuccess()
    {
        $this->get("{$this->url}/{$this->user->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);

    }

    public function testShowDataFail()
    {
        $this->get("{$this->url}/0")
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['error','code']);
    }

    public function testCreateDataSuccess()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);
    }

    public function testCreatePasswordNotSame()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => '12345678',
            'password_confirmation' => '1234567',
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }

    public function testCreateDataNullName()
    {
        $this->data = [
            'name' => null,
            'email' => $this->faker->email(),
            'password' => '123456',
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }

    public function testCreateDataNullEmail()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => null,
            'password' => '123456',
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }

    public function testCreateDataEmailExist()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => $this->user->email,
            'password' => '123456',
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }

    public function testCreateDataNullPassword()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => $this->user->email,
            'password' => null,
        ];

        $this->post($this->url, $this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }

    public function testDeleteDataSuccess()
    {
        $this->delete("{$this->url}/{$this->user->id}")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['message']);
    }

    public function testDeleteDataFail()
    {
        $this->delete("{$this->url}/0")
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['error']);
    }

    public function testUpdateDataSuccess()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'email' => $this->user->email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->put("{$this->url}/{$this->user->id}",$this->data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function testUpdateDataFail()
    {
        $this->data = [
            'name' => $this->faker->name(),
            'emails' => $this->user->email,
        ];

        $this->put("{$this->url}/{$this->user->id}",$this->data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message']);
    }
}
