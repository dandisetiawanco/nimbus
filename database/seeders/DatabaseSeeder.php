<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Settings
        Setting::insert([
            ['key' => 'site_name', 'value' => 'NIMBUS CMS', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'A powerful Laravel CMS', 'group' => 'seo'],
        ]);

        // Permissions
        $permissions = [
            'manage pages',
            'manage posts',
            'manage media',
            'manage menus',
            'manage components',
            'create own posts',
            'edit own posts',
            'upload media',
            'view admin', // for viewer
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $authorRole = Role::firstOrCreate(['name' => 'Author']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer']);

        // Assign Permissions
        $adminRole->givePermissionTo(Permission::all());
        $editorRole->givePermissionTo(['manage pages', 'manage posts', 'manage media', 'manage menus', 'manage components', 'view admin']);
        $authorRole->givePermissionTo(['create own posts', 'edit own posts', 'upload media', 'view admin']);
        $viewerRole->givePermissionTo(['view admin']);

        // Default Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@nimbuscms.test'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        $author = User::firstOrCreate(
            ['email' => 'author@nimbuscms.test'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $author->assignRole('Author');

        // Example Categories & Tags
        $cat1 = Category::firstOrCreate(['slug' => 'news'], ['name' => 'News']);
        $cat2 = Category::firstOrCreate(['slug' => 'tutorials'], ['name' => 'Tutorials']);

        $tag1 = Tag::firstOrCreate(['slug' => 'laravel'], ['name' => 'Laravel']);
        $tag2 = Tag::firstOrCreate(['slug' => 'ui'], ['name' => 'UI']);

        // Example Pages
        Page::firstOrCreate(
            ['slug' => '/'], // use '/' for Home
            [
                'title' => 'Home',
                'status' => 'published',
                'content' => '<h1>Welcome to NIMBUS CMS</h1><p>This is the home page.</p>',
                'published_at' => now(),
                'created_by' => $admin->id,
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'status' => 'published',
                'content' => '<h2>About Nimbus CMS</h2><p>Nimbus is built to be fast, scalable, and easy to use.</p>',
                'published_at' => now(),
                'created_by' => $admin->id,
            ]
        );

        // Example Posts
        $post1 = Post::firstOrCreate(
            ['slug' => 'hello-world'],
            [
                'title' => 'Hello World in Nimbus',
                'excerpt' => 'Our first post in our new CMS.',
                'body' => '<p>Welcome to your new CMS instance. Feel free to modify or delete this post.</p>',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $admin->id,
            ]
        );
        $post1->categories()->sync([$cat1->id]);
        $post1->tags()->sync([$tag1->id]);

        $post2 = Post::firstOrCreate(
            ['slug' => 'another-update'],
            [
                'title' => 'Another Update',
                'excerpt' => 'This is an author post.',
                'body' => '<p>Look at what our authors can do!</p>',
                'status' => 'published',
                'published_at' => now(),
                'created_by' => $author->id,
            ]
        );
        $post2->categories()->sync([$cat2->id]);
        $post2->tags()->sync([$tag1->id, $tag2->id]);
    }
}
