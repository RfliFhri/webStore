<?php

namespace App\Data;

use App\Models\Tag;
use Spatie\LaravelData\Data;

class ProductCollectionData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public int $products_count,
    ) {}

    public static function formModel(Tag $tag) : self {
        return new self(
            $tag->id,
            $tag->name,
            $tag->slug,
            $tag->products_count,
        );
    } 
}
