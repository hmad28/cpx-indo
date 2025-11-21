<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $casts = [
        'kelenihan' => 'array'
    ];
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'image', 'size_image', 'description', 'kelebihan', 'category_id', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // helper generate unique slug
    public static function generateUniqueSlug(string $name, $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 2;

        while (
            static::where('slug', $slug)
                  ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                  ->exists()
        ) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });

        static::updating(function ($product) {
            // regenerate slug jika name diubah dan slug belum diubah manual
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sizes() { return $this->belongsToMany(Size::class, 'product_size'); }
    public $timestamps = true;

    // app/Models/Product.php
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relasi ke Diskon (hasMany)
    public function diskons()
    {
        return $this->hasMany(Diskon::class);
    }
}
