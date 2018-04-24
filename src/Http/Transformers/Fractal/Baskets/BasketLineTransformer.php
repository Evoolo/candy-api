<?php

namespace GetCandy\Api\Http\Transformers\Fractal\Baskets;

use GetCandy\Api\Core\Baskets\Models\BasketLine;
use GetCandy\Api\Http\Transformers\Fractal\BaseTransformer;
use GetCandy\Api\Http\Transformers\Fractal\Products\ProductVariantTransformer;

class BasketLineTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'variant',
    ];

    public function transform(BasketLine $line)
    {
        $data = [
            'id' => $line->encodedId(),
            'quantity' => $line->quantity,
            'total' => $line->current_total,
            'tax' => $line->current_tax,
        ];

        return $data;
    }

    protected function includeVariant(BasketLine $line)
    {
        return $this->item($line->variant, new ProductVariantTransformer);
    }
}
