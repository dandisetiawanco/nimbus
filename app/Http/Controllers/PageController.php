<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query()->with('author');
        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $pages = $query->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,review,published,archived',
            'published_at' => 'nullable|date',
        ]);
        
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = auth()->id();
        
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,'.$page->id,
            'content' => 'nullable|string',
            'status' => 'required|in:draft,review,published,archived',
            'published_at' => 'nullable|date',
        ]);
        
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = auth()->id();
        
        $page->update($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
