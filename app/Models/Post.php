<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $guarded = [ 'id' ];
    protected $with = ['category', 'pengguna'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function pengguna() {
        return $this->belongsTo(Pengguna::class);
    }

    public function scopeFilter($query, array $filters) {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%'.$search.'%')->orWhere('body', 'like', '%'.$search.'%');
        });

        $query->when($filters['category'] ??  false, function($query, $category) {
            return $query->whereHas('category', function($query) use($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ??  false, function($query, $author) {
            return $query->whereHas('Pengguna', function($query) use($author) {
                $query->where('username', $author);
            });
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
