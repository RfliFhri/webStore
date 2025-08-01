<?php

namespace App\Livewire;

use App\Actions\ValidateCartStock;
use App\Contract\CartServiceInterFace;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Cart extends Component
{

    public string $sub_total;

    public string $total;

    public function mount(CartServiceInterFace $cart)
    {
        $all = $cart->all();

        $this->sub_total = $all->total_formatted;
        $this->total = $this->sub_total;
    }

    public function getItemsProperty(CartServiceInterFace $cart) : Collection
    {
        return $cart->all()->items->toCollection();
    }

    public function checkout() 
    {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart', [
            'items' => $this->items
        ]);
    }
}
