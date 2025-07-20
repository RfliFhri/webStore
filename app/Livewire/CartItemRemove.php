<?php

namespace App\Livewire;

use App\Contract\CartServiceInterFace;
use App\Data\ProductData;
use Livewire\Component;

class CartItemRemove extends Component
{

    public string $sku;

    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;
    }

    public function remove(CartServiceInterFace $cart)
    {
        $cart->remove($this->sku);

        session()->flash('success', "Product {$this->sku} in cart has been Deleted");

        $this->dispatch('cart-updated');

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart-item-remove');
    }
}
