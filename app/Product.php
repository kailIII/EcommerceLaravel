<?php

namespace LaravelCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    						'category_id',
    						'name',
    						'description',
    						'price',
    						'featured',
    						'recommend'
    					];

    public function category()
    {
    	return $this->belongsTo('LaravelCommerce\Category');
    }

    public function images()
    {
        return $this->hasMany('LaravelCommerce\ProductImage');
    }

    // ManyToMany
    public function tags()
    {
        return $this->belongsToMany('LaravelCommerce\Tag');
    }    

    //  Accessors (get[name]Attribute and Lists
    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();
        return implode(',',$tags);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured','=','1');
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend','=','1');
    }

    public function scopeOfCategory($query, $id)
    {
       return $query->where('category_id','=',$id);
    }

    public function scopeOfName($query, $id)
    {
       return $query->where('name','like','%'.$id.'%');
    }

    public function scopeOfTag($query, $id)
    {
        $productsOfTag = $query->whereIn('id', function($subQuery) use ($id) {
            $subQuery->select('product_id')
                     ->from('product_tag')
                     ->where('tag_id','=',$id);
        });

       return $productsOfTag;
    }
}
