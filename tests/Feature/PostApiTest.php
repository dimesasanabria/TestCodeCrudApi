<?php

namespace Tests\Feature;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostApiTest extends TestCase
{

    use RefreshDatabase;
    /**
     * test get all posts
     */
    public function test_it_can_list_posts(): void
    {
        Post::factory()->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
    }

    /**
     * test create post
     */

    public function test_it_can_create_post(): void
    {
        $response = $this->postJson('/api/posts', [
            'UDDI' => 'test-Apiuddi',
            'name' => 'Test ApiPost',
            'code' => 'TP001',
            'description' => 'This is a test post.',
            'status' => 'active'
        ]);
        $response->assertStatus(201);
         $this->assertDatabaseHas('posts', [
            'UDDI' => 'test-Apiuddi',
        ]);
    }
 
    /**
     * Set up the test environment.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
    /**
     * test delete post
     */
    public function test_it_can_delete_a_post(): void
    {
        $post = Post::factory()->create();
        $response = $this->deleteJson("/api/posts/{$post->id}");
        $response->assertStatus(204);
    }
    /**
     * test update post
     */
    public function test_it_can_update_a_post(): void
    {
    $post = Post::factory()->create();
    $response = $this->putJson("/api/posts/{$post->id}", [
        'name' => 'Updated name',
        'UDDI' => 'updated-uddi',
        'description' => 'Updated description',
        'code' => 'UPD',
        'status' => 'active',
    ]);
    $response->assertStatus(200);
    }

       /**
     * test post validation fails
     */
    public function test_post_validation_fails(): void
    {
        $response = $this->postJson('/api/posts', []);
        $response->assertStatus(422);
    }
}

    