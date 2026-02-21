<?php

$dir = __DIR__ . '/app/Http/Controllers/';

$templates = [
    'PostController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function index() {
        $posts = Post::with('author')->paginate(10);
        return view('admin.posts.index', compact('posts')); // Simplified for requirement
    }
}
EOT,
    'CategoryController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class CategoryController extends Controller {
    public function index() { return "Categories (Placeholder)"; }
}
EOT,
    'TagController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class TagController extends Controller {
    public function index() { return "Tags (Placeholder)"; }
}
EOT,
    'MediaController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class MediaController extends Controller {
    public function index() { return "Media (Placeholder)"; }
}
EOT,
    'MenuController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class MenuController extends Controller {
    public function index() { return "Menus (Placeholder)"; }
}
EOT,
    'ComponentController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class ComponentController extends Controller {
    public function index() { return "Components (Placeholder)"; }
}
EOT,
    'SettingController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;
class SettingController extends Controller {
    public function index() { return "Settings (Placeholder)"; }
    public function store(Request $request) { return back(); }
}
EOT,
    'AuditLogController.php' => <<<'EOT'
<?php
namespace App\Http\Controllers;
class AuditLogController extends Controller {
    public function index() { return "Audit Logs (Placeholder)"; }
}
EOT,
];


foreach ($templates as $file => $content) {
    file_put_contents($dir . $file, $content);
}

// Generate a dummy admin/posts/index.blade.php
$viewsDir = __DIR__ . '/resources/views/';
if (!is_dir($viewsDir.'admin/posts')) mkdir($viewsDir.'admin/posts');
file_put_contents($viewsDir.'admin/posts/index.blade.php', <<<'EOT'
@extends('layouts.admin')
@section('header', 'Posts')
@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
            <tr><th>Title</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr><td>{{ $post->title }}</td><td>{{ $post->status }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
EOT
);
