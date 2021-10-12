<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'stock',
        'sell_price',
        'short_description',
        'long_description',
        'status',
        'subcategory_id',
        'provider_id',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeInfoSubCategoriesProviders($query)
    {
        return $query->join('sub_categories', 'sub_categories.id', 'products.subcategory_id')
            ->join('providers', 'providers.id', 'products.provider_id');
    }

    public function storeProduct($request)
    {
        $product = self::create([
            'code' => $request->code,
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'sell_price' => $request->sell_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'subcategory_id' => $request->subcategory_id,
            'provider_id' => $request->provider_id,
        ]);

        $product->tags()->attach($request->tags);
        $this->generateCode($product);
        $this->uploadImage($request, $product);
    }

    public function updateProduct($request)
    {
        $this->update([
            'code' => $request->code,
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'sell_price' => $request->sell_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'subcategory_id' => $request->subcategory_id,
            'provider_id' => $request->provider_id,
        ]);

        $this->tags()->sync($request->get('tags'));
        $this->generateCode($this);
        $this->uploadImage($request, $this);
    }

    public function generateCode($product)
    {
        $numero = $product->id;
        $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
        $product->update(['code' => $numeroConCeros]);
    }

    public function uploadImage($request, $product)
    {
        $urlimages = [];

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $name = time() . $image->getClientOrigenName();
                $url = public_path() . '/images';
                $image->move($url, $name);
                $urlimages[]['url'] = '/images/' . $name;
            }
        }
        $product->images()->createMany($urlimages);
    }
}
