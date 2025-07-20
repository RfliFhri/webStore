<?php

namespace App\Livewire;

use App\Contract\CartServiceInterFace;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{

    public int $count;

    public function mount(CartServiceInterFace $cart) 
    {
        $this->count = $cart->all()->total_quantity;
    }

    #[On('cart-updated')]
    public function updated(CartServiceInterFace $cart)
    {
        $this->count = $cart->all()->total_quantity;
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
