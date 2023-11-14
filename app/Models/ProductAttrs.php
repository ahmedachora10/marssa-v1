<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttrs extends Model
{
    public $guarded = [];
    protected $table = "product_attrs";
    protected $fillable = ['product_id','attribute_id','vals','display_type',];
    /**
     * Get all of the comments for the ProductVariant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantAttribute()
    {
        return $this->hasMany(ProductVariantAttribute::class, 'product_variant_id');
    }
    /**
     * Get the user that owns the ProductAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    /**
     * Get the user that owns the ProductAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(ProductAttributes::class, 'attribute_id');
    }
}
