<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'before' => 'json',
        'after' => 'json',
    ];
    public $timestamps = false;
    
    public function user() { return $this->belongsTo(User::class); }
}