<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author() { return $this->belongsTo(User::class, 'created_by'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }
    public function featuredImage() { return $this->belongsTo(Media::class, 'featured_image_id'); }
    public function pageComponents() { return $this->hasMany(PageComponent::class)->orderBy('order'); }
}