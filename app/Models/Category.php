<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'description'];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public static function getIcons ()
    {
        [
        'icon-fruits',
         'icon-broccoli-1',
         'icon-beef',
         'icon-fish',
         'icon-fast-food',
         'icon-honey',
         'icon-grape',
         'icon-onions',
         'icon-avocado'
        ];
    }

    public function storeCategory($request)
    {
        self::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $request->icon,
            'description ' => $request->description
        ]);
    }

    public function updateCategory($request)
    {
        $this->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $request->icon,
            'description ' => $request->description
        ]);
    }
}
