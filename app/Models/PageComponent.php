<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageComponent extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'data' => 'json',
    ];

    public function page() { return $this->belongsTo(Page::class); }
    public function component() { return $this->belongsTo(Component::class); }
}