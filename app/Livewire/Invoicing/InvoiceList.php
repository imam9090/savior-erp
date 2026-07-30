<?php

namespace App\Livewire\Invoicing;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceList extends Component
{
    use WithPagination;

    public function render()
    {
        $query = Invoice::with('client')->latest();

        if (Auth::user()->role->value === 'client') {
            $query->where('client_id', Auth::id());
        }

        return view('livewire.invoicing.invoice-list', [
            'invoices' => $query->paginate(15),
        ]);
    }
}