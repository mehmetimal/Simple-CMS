<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
/*
 * Ürüne ait model yapısı her ürünün bir adet resimi her resim için 1 adet sınır konacak sekilde ayarlandı
 */
class Product extends Model implements HasMedia
{
    protected $guarded =[];
    use HasFactory,SoftDeletes,InteractsWithMedia;
    public  function  user(){

        return $this->belongsTo(User::class);


    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(368)
            ->height(232)
            ->sharpen(10);
        $this->addMediaConversion('medium')
            ->width(368)
            ->height(232)
            ->sharpen(10);
        $this->addMediaConversion('big')
            ->width(368)
            ->height(232)
            ->sharpen(10);
        $this->addMediaConversion('banner')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')->singleFile();

    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }
}
