<?php

namespace App\Livewire;

use App\Contract\CartServiceInterFace;
use App\Data\CartItemData;
use App\Data\ProductData;
use Livewire\Component;

class AddToCart extends Component
{

    public int $quantity;

    public string $sku;

    public float $price;

    public int $weight;

    public function mount(ProductData $product, CartServiceInterFace $cart) {
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->weight = $product->weight;
        $this->quantity = $cart->getItemBySku($product->sku)->quantity ?? 1;
    }

    public function addToCart(CartServiceInterFace $cart) {
        $cart->addOrUpdate(new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
