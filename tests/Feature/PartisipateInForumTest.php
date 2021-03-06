<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartisipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    //** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $reply = factory('App\Reply')->create();

        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
