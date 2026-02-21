<?php
namespace Tests\Feature;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_admin_views_load_successfully()
    {
        $this->seed();
        $admin = User::first();
        $routes = [
            '/admin/dashboard',
            '/admin/users',
            '/admin/roles',
            '/admin/posts',
            '/admin/pages',
            '/admin/media',
            '/admin/settings',
            '/admin/audit-logs'
        ];
        
        foreach ($routes as $route) {
            $response = $this->actingAs($admin)->get($route);
            $response->assertStatus(200);
        }
    }
}
