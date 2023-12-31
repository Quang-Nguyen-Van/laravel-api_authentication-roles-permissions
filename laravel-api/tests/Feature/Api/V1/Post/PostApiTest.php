<?php

namespace Tests\Feature\Api\V1\Post;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use App\Events\Models\Post\PostUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        // load data in db
        $posts = Post::factory(10)->create();
        $postIds = $posts->map(fn ($post) => $post->id);

        // call index endpoint
        $response = $this->json('get', '/api/v1/posts');

        // assert status
        $response->assertStatus(200);

        // verify records
        // $data = $response->json('data.9.id'); // Access post has index 9 and get id
        $data = $response->json('data');
        collect($data)->each(fn ($post) => $this->assertTrue(in_array($post['id'], $postIds->toArray())));

        // dump($data);
    }

    public function test_show()
    {
        $dummy = Post::factory()->create();

        $response = $this->json('get', '/api/v1/posts/' . $dummy->id);

        $result = $response->assertStatus(200)->json('data');

        $this->assertEquals(data_get($result, 'id'), $dummy->id, 'Response ID not the same as model id.');
    }

    public function test_create()
    {
        // Event::fake([PostCreated::class,]);

        $dummy = Post::factory()->make();

        $dummyUser = User::factory()->create();

        $response = $this->json('post', '/api/v1/posts', array_merge($dummy->toArray(), ['user_ids' => [$dummyUser->id]]));

        $result = $response->assertStatus(201)->json('data');
        // Event::assertDispatched(PostCreated::class);

        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function ($value, $field) use($dummy){
            $this->assertSame(data_get($dummy, $field), $value, 'Fillable is not the same.');
        });
    }


    public function test_updated()
    {
        $dummy = Post::factory()->create();
        $dummy2 = Post::factory()->make();

        // Event::fake();

        $fillables = collect((new Post())->getFillable());

        $fillables->each(function ($toUpdate) use($dummy, $dummy2){
            $response = $this->json('patch', '/api/v1/posts/' . $dummy->id, [
                $toUpdate => data_get($dummy2, $toUpdate),
            ]);

            $result = $response->assertStatus(200)->json('data');
            // Event::assertDispatched(PostUpdated::class);
            $this->assertSame(data_get($dummy2, $toUpdate), data_get($dummy->refresh(), $toUpdate), 'Failed to update model.');
        });
    }

    public function test_delete()
    {
        // Event::fake([PostDeleted::class]);
        $dummy = Post::factory()->create();

        $response = $this->json('delete', '/api/v1/posts/' . $dummy->id);

        $result = $response->assertStatus(200);
        // Event::assertDispatched(PostDeleted::class);
        $this->expectException(ModelNotFoundException::class);

        Post::query()->findOrFail($dummy->id);
    }
}
