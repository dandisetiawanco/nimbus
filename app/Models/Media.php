<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['url'];

    public function uploadedBy() { return $this->belongsTo(User::class, 'uploaded_by'); }
    
    public function getUrlAttribute() {
        return Storage::disk($this->disk)->url($this->path);
    }
}