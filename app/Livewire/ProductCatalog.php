<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductCollectionData;
use App\Data\ProductData;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class ProductCatalog extends Component
{
    public function render()
    {
        $collection_query = Tag::query()->withType('collection')->withCount('products')->get();
        $query = Product::paginate(6);
        // TODO make a DTO
        $products = ProductData::collect($query);
        $collections = ProductCollectionData::collect($collection_query);

        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
