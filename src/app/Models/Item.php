<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // カテゴリ（多対多）
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // 購入
    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
