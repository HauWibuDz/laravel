<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'price','sale_price','image','description','status','category_id'];

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories() 
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function scopeSearch($query)
    {
        if(request()->keyword){
           $query = $query->where('name','like','%'.request()->keyword.'%');
        }
           return $query;
        
    }
}
