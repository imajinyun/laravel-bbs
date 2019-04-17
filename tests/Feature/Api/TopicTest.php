<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testStoreTopic(): void
    {
        $data = [
            'category' => 1,
            'body' => 'this is body',
            'title' => 'this is title',
        ];

        $token = \Auth::guard('api')->fromUser($this->user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/topics', $data);

        $fragment = [
            'category' => 1,
            'user_id' => $this->user->id,
            'body' => clean('this is body', 'user_topic_body'),
            'title' => 'this is title',
        ];

        $response->assertStatus(201)
            ->assertJsonFragment($fragment);
    }
}
