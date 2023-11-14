<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantAttribute extends Model
{
    public $guarded = [];
    protected $fillable = ['attribute_id','product_variant_id','value'];
    /**
     * Get the user that owns the ProductAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
    /**
     * Get the user that owns the ProductAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
