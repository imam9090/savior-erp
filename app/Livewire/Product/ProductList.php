<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public function delete(Product $product): void
    {
        $product->delete();
        session()->flash('success', 'Item berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.product.product-list', [
            'products' => Product::latest()->paginate(15),
        ]);
    }
}