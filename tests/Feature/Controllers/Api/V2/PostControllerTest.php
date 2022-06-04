<?php

namespace Tests\Feature\Controllers\Api\V2;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

it('show post v2', function ()
{
    $user = User::factory()->create();
    $this->actingAs($user);
    $post = Post::factory()->create();
    $this->getJson(route('v2.posts.show', $post->id))
        ->assertStatus(Response::HTTP_OK)
        ->assertExactJson(
            [
                'data' => [
                    'id'        => $post->id,
                    'post_name' => $post->title,
                    'slug'      => $post->slug,
                    'content'   => $post->content,
                    'author'    => [
                        'name'  => $post->user->name,
                        'email' => $post->user->email,
                    ],
                    'created_at' => $post->published_at,
                ]
            ]
        );
});

it('list post v2', function ()
{
    $user = User::factory()->create();
    $this->actingAs($user);
    Post::factory()->count(2)->create();
    $this->getJson(route('v2.posts.index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                    '*' =>
                    [
                        'id',
                        'post_name',
                        'slug',
                        'content',
                        'author' => [
                            'name',
                            'email',
                        ],
                        'created_at',
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
