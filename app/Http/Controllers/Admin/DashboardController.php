<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use App\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'total_pages' => Page::count(),
            'total_users' => User::count(),
            'total_media' => Media::count(),
        ];

        $recentPosts = Post::with('author')->latest()->take(5)->get();
        $recentPages = Page::with('author')->latest()->take(5)->get();
        $scheduledPosts = Post::where('published_at', '>', now())->where('status', 'published')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentPages', 'scheduledPosts'));
    }
}
