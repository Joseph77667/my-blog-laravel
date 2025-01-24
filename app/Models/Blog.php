<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use HasFactory, Notifiable;

    protected $with = ['category', 'author'];
    protected $fillable = ['title', 'intro', 'body'];

    public function scopeFilter($query, $filer)
    {
        $query->when($filer['search']??false, function ($query, $search) {
            //logical grouping
            $query->where(function ($query) use ($search){
                $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('body', 'LIKE', '%' . $search . '%');
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
