<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Purchase;

class Item extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'items_image',
        'user_id',
        'item_comment',
        'condition',
        'brand_name',
        'is_sold',
    ];

    // 出品者

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // カテゴリ（多対多）
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category');
    }

    // 購入
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    //いいね
    public function likes()
{
    return $this->hasMany(\App\Models\Like::class);
}

// コメント
public function comments()
{
    return $this->hasMany(Comment::class);
}
}
