<?php

namespace Tests\Feature\Controllers\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

it('show post v1', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();
    $this->getJson(route('v1.posts.show', $post->id))
        ->assertStatus(Response::HTTP_OK)
        ->assertExactJson(
            [
                'data' => [
                    'id'      => $post->id,
                    'title'   => $post->title,
                    'slug'    => $post->slug,
                    'excerpt' => $post->excerpt,
                    'content' => $post->content,
                ]
            ]
        );
});

it('list post v1', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    Post::factory()->count(2)->create();
    $this->getJson(route('v1.posts.index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                    '*' =>
                    [
                        'id',
                        'title',
                        'slug',
                        'excerpt',
                        'content',
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'path',
                    'per_page',
                    'to',
                ]
            ]
        );
});
