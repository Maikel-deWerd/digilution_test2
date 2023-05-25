<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    use HasFactory;

    //protected $guarded = []; //dit is het tegenovergestelde van fillable
    //protected $fillable = ['title', 'excerpt', 'body']; //deze stukken kunnen gebruikers zelf instellen, dus als hier een role tussen zou staan is het mogelijk om hun eigen rol aan te passen

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'category_id'];

    protected $with = ['category', 'author']; //cleaning up the code in webp
    //public function getRouteKeyName()
    //{
        //return 'slug';
    //}

    
public function scopeFilter($query, array $filters)
    {

        $query->when( $filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) =>
                $query->where('title', 'like' , '%' . $search .'%')
                ->orWhere('body', 'like' , '%' . $search .'%')));

        $query->when( $filters['category'] ?? false, fn($query, $category) => 
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category)
            ));

        $query->when( $filters['author'] ?? false, fn($query, $author) => 
            $query->whereHas('author', fn($query) => 
                $query->where('username', $author)
            ));
    }

    public function comments()
    {
        //onetomany
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        //onetomany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //onetomany
        return $this->belongsTo(User::class, 'user_id');
    }
}
