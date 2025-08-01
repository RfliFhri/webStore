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

    public int $stock;

    public float $price;

    public int $weight;

    public bool $incart = false;

    public function mount(ProductData $product, CartServiceInterFace $cart ) {
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->weight = $product->weight;
        $this->quantity = $cart->getItemBySku($product->sku)->quantity ?? 1;

        $this->validate();
    }

    protected function rules() : array {
        return [
            'quantity' => ['required', 'integer', 'min:1', "max:{$this->stock}"]
        ];
    }

    public function addToCart(CartServiceInterFace $cart) {

        $this->validate();

        $cart->addOrUpdate(new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        if ($this->incart === true) {
            session()->flash('success', 'Quantity has been Updated!');
        } else {
            session()->flash('success', 'Product Add to cart');
        }
        
        

        $this->dispatch('cart-updated');

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
