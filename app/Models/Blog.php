<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['category', 'author'];

    protected $fillable = [
        'title',
        'intro',
        'slug',
        'body',
        'category_id',
        'thumbnail',
        'user_id', // Add user_id to the fillable array
    ];
    
    public function scopeFilter($query, $filer)
    {
        $query->when($filer['search']??false, function ($query, $search) {
            //logical grouping
            $query->where(function ($query) use ($search){
                $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('body', 'LIKE', '%' . $search . '%');
            });
            
        });
        $query->when($filer['category']??false, function ($query, $slug) {
            //logical grouping
            $query->whereHas('category', function ($query) use ($slug){
                $query->where('slug', $slug);
            });
        });
        $query->when($filer['username']??false, function ($query, $username) {
            $query->whereHas('author', function ($query) use ($username){
                $query->where('username', $username);
            });
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
