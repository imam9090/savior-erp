<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'client_id',
        'project_id',
        'issue_date',
        'due_date',
        'subtotal',
        'ppn_rate',
        'ppn_amount',
        'pph_rate',
        'pph_amount',
        'total',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        $ppnAmount = round($subtotal * ($this->ppn_rate / 100), 2);
        $pphAmount = round($subtotal * ($this->pph_rate / 100), 2);

        $this->update([
            'subtotal' => $subtotal,
            'ppn_amount' => $ppnAmount,
            'pph_amount' => $pphAmount,
            'total' => $subtotal + $ppnAmount - $pphAmount,
        ]);
    }
}