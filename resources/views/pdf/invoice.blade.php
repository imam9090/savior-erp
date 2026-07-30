<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; font-size: 12px; color: #333; margin: 0; padding: 30px; }

        .header { display: table; width: 100%; margin-bottom: 24px; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        .invoice-title { font-size: 22px; font-weight: bold; color: #1e293b; margin: 0 0 4px 0; }
        .invoice-number { color: #64748b; font-size: 11px; }
        .meta-row { margin-bottom: 4px; }
        .meta-label { color: #64748b; }
        .meta-value { font-weight: bold; color: #1e293b; }

        .bill-to { margin-top: 10px; margin-bottom: 20px; }
        .bill-to-label { color: #64748b; font-size: 10px; letter-spacing: 0.5px; margin-bottom: 6px; }
        .bill-to-name { font-size: 14px; font-weight: bold; color: #1e293b; margin-bottom: 3px; }
        .bill-to-detail { color: #475569; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f8fafc; text-align: left; padding: 10px 8px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        td { padding: 10px 8px; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
        .text-right { text-align: right; }

        .totals-wrapper { display: table; width: 100%; margin-top: 16px; }
        .totals { display: table-cell; width: 280px; float: right; }
        .totals-row { display: table; width: 100%; padding: 5px 0; }
        .totals-row .label { display: table-cell; text-align: left; color: #64748b; }
        .totals-row .value { display: table-cell; text-align: right; }
        .totals-row.ppn .value { color: #059669; }
        .totals-row.pph .value { color: #dc2626; }
        .totals-row.total { border-top: 2px solid #1e293b; margin-top: 6px; padding-top: 10px; }
        .totals-row.total .label,
        .totals-row.total .value { font-weight: bold; font-size: 15px; color: #1e293b; }

        .notes { clear: both; margin-top: 40px; padding: 14px; background: #f8fafc; border-radius: 6px; font-size: 11px; color: #475569; line-height: 1.5; }
        .notes-label { font-weight: bold; color: #1e293b; display: block; margin-bottom: 4px; }

        .signature { margin-top: 60px; text-align: right; }
        .signature-box { display: inline-block; text-align: center; }
        .signature-space { height: 50px; }
        .signature-line { border-top: 1px solid #333; padding-top: 6px; font-weight: bold; min-width: 180px; }
        .signature-role { font-weight: normal; font-size: 10px; color: #64748b; margin-top: 2px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <p class="invoice-title">INVOICE</p>
            <p class="invoice-number">{{ $invoice->invoice_number }}</p>
        </div>
        <div class="header-right">
            <div class="meta-row"><span class="meta-label">Tanggal Invoice: </span><span class="meta-value">{{ $invoice->issue_date->translatedFormat('d F Y') }}</span></div>
            <div class="meta-row"><span class="meta-label">Jatuh Tempo: </span><span class="meta-value">{{ $invoice->due_date->translatedFormat('d F Y') }}</span></div>
        </div>
    </div>

    <div class="bill-to">
        <p class="bill-to-label">TAGIHAN KEPADA</p>
        <p class="bill-to-name">{{ $invoice->client->name }}</p>
        <p class="bill-to-detail">Email: {{ $invoice->client->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Deskripsi Barang/Jasa</th>
                <th>Satuan</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->unit }}</td>
                    <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right">{{ rtrim(rtrim(number_format($item->quantity, 2, ',', '.'), '0'), ',') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-wrapper">
        <div class="totals">
            <div class="totals-row">
                <div class="label">Subtotal</div>
                <div class="value">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</div>
            </div>
            <div class="totals-row ppn">
                <div class="label">PPN ({{ rtrim(rtrim(number_format($invoice->ppn_rate, 2), '0'), '.') }}%)</div>
                <div class="value">+ Rp {{ number_format($invoice->ppn_amount, 0, ',', '.') }}</div>
            </div>
            <div class="totals-row pph">
                <div class="label">PPh ({{ rtrim(rtrim(number_format($invoice->pph_rate, 2), '0'), '.') }}%)</div>
                <div class="value">- Rp {{ number_format($invoice->pph_amount, 0, ',', '.') }}</div>
            </div>
            <div class="totals-row total">
                <div class="label">TOTAL BERSIH</div>
                <div class="value">Rp {{ number_format($invoice->total, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    @if ($invoice->notes)
        <div class="notes">
            <span class="notes-label">Terms & Notes</span>
            {{ $invoice->notes }}
        </div>
    @endif

    <div class="signature">
        <div class="signature-box">
            <div class="signature-space"></div>
            <div class="signature-line">
                [Nama Owner]
                <div class="signature-role">Owner, Savior Prime Indonesia</div>
            </div>
        </div>
    </div>
</body>
</html>