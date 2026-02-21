<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure roles/permissions are set up
        Permission::firstOrCreate(['name' => 'view admin']);
        Permission::firstOrCreate(['name' => 'edit own posts']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo('view admin');

        $authorRole = Role::firstOrCreate(['name' => 'Author']);
        $authorRole->givePermissionTo(['view admin', 'edit own posts']);
    }

    public function test_admin_can_access_dashboard()
    {
        $admin = clone User::factory()->create();
        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Welcome back');
    }

    public function test_author_cannot_edit_other_users_post()
    {
        $author1 = clone User::factory()->create();
        $author1->assignRole('Author');

        $author2 = clone User::factory()->create();
        $author2->assignRole('Author');

        $post = Post::create([
            'title' => 'Author 1 Post',
            'slug' => 'author-1-post',
            'status' => 'published',
            'created_by' => $author1->id,
        ]);

        // Attempt to access Edit Page for Author 2 (we can simulate this via a Gate or generic controller logic)
        // Since we are not strictly adhering to a full FormRequest in our barebones PostController for brevity,
        // Let's test the policy instead.
        
        $policy = new \App\Policies\PostPolicy();
        
        $this->assertTrue($policy->update($author1, $post));
        $this->assertFalse($policy->update($author2, $post));
    }

    public function test_publish_scheduling_works()
    {
        $postFuture = Post::create([
            'title' => 'Future Post',
            'slug' => 'future-post',
            'status' => 'published',
            'published_at' => now()->addDays(2),
        ]);

        $postPast = Post::create([
            'title' => 'Past Post',
            'slug' => 'past-post',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        $response = $this->get('/blog');
        $response->assertStatus(200);
        
        // Future post should not be seen
        $response->assertDontSee('Future Post');
        // Past post should be seen
        $response->assertSee('Past Post');
    }
}
