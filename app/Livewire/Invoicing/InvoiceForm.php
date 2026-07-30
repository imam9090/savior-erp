<?php

namespace App\Livewire\Invoicing;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Product;

class InvoiceForm extends Component
{
    public ?int $client_id = null;
    public string $issue_date = '';
    public string $due_date = '';
    public float $ppn_rate = 11;
    public float $pph_rate = 0;
    public string $notes = 'Pembayaran jatuh tempo 7 hari sejak tanggal invoice. Keterlambatan pembayaran dikenakan denda 5% per bulan.';

    public array $items = [
    ['product_id' => '', 'description' => '', 'unit' => 'Unit', 'quantity' => 1, 'unit_price' => 0],
];

    public function mount(): void
    {
        $this->issue_date = today()->toDateString();
        $this->due_date = today()->addDays(14)->toDateString();
    }

   public function addItem(): void
{
    $this->items[] = ['product_id' => '', 'description' => '', 'unit' => 'Unit', 'quantity' => 1, 'unit_price' => 0];
}

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function selectProduct(int $index): void
    {
        $productId = $this->items[$index]['product_id'];

        if (! $productId) {
            return;
        }

        $product = Product::find($productId);

        if ($product) {
            $this->items[$index]['description'] = $product->name;
            $this->items[$index]['unit'] = $product->unit;
            $this->items[$index]['unit_price'] = (float) $product->price;
        }
    }

    public function getSubtotalProperty(): float
    {
        return collect($this->items)->sum(
            fn ($item) => (float) $item['quantity'] * (float) $item['unit_price']
        );
    }

    public function getPpnAmountProperty(): float
    {
        return round($this->subtotal * ($this->ppn_rate / 100), 2);
    }

    public function getPphAmountProperty(): float
    {
        return round($this->subtotal * ($this->pph_rate / 100), 2);
    }

    public function getTotalProperty(): float
    {
        return $this->subtotal + $this->ppnAmount - $this->pphAmount;
    }

    public function save(): void
    {
        $this->validate([
            'client_id' => 'required|exists:users,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'items.*.description' => 'required|min:2',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4)),
            'client_id' => $this->client_id,
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
            'ppn_rate' => $this->ppn_rate,
            'pph_rate' => $this->pph_rate,
            'notes' => $this->notes,
            'status' => 'draft',
        ]);

        foreach ($this->items as $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'unit' => $item['unit'] ?: 'Unit',
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        $invoice->recalculateTotals();

        session()->flash('success', 'Invoice berhasil dibuat: ' . $invoice->invoice_number);

        $this->redirectRoute('invoices.index');
    }

    public function render()
    {
        return view('livewire.invoicing.invoice-form', [
            'clients' => User::where('role', 'client')->get(),
            'products' => Product::orderBy('name')->get(),
        ]);
    }
}