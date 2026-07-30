<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ProductForm extends Component
{
    public string $name = '';
    public string $type = 'jasa';
    public string $unit = 'Unit';
    public float $price = 0;
    public string $description = '';

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2',
            'type' => 'required|in:barang,jasa',
            'unit' => 'required|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $this->name,
            'type' => $this->type,
            'unit' => $this->unit,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Item berhasil ditambahkan.');

        $this->redirectRoute('products.index');
    }

    public function render()
    {
        return view('livewire.product.product-form');
    }
}