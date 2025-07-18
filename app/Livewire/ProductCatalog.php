<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Livewire\Component;

class ProductCatalog extends Component
{
    public function render()
    {
        $query = Product::paginate(6);
        // TODO make a DTO
        $products = ProductData::collect($query);

        return view('livewire.product-catalog', compact('products'));
    }
}
