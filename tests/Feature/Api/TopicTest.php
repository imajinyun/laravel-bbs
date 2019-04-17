<?php

namespace Tests\Feature\Api;

use Auth;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\JWTTokenTrait;

class TopicTest extends TestCase
{
    use JWTTokenTrait;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testStoreTopic(): void
    {
        $data = [
            'category_id' => 1,
            'body' => 'this is body',
            'title' => 'this is title',
        ];

        $response = $this->withAuthorizationHeader($this->user)
            ->json('POST', '/api/topics', $data);

        $data['body'] = clean($data['body'], 'user_topic_body');
        $data['user_id'] = $this->user->id;

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }
}
