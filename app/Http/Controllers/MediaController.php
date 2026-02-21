<?php
namespace App\Http\Controllers;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller {
    public function index() {
        $media = Media::paginate(10);
        return view('admin.media.index', compact('media'));
    }
}