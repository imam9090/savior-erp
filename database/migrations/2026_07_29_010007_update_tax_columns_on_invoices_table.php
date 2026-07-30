<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['tax_type', 'tax_rate', 'tax_amount']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('ppn_rate', 5, 2)->default(0)->after('subtotal');
            $table->decimal('ppn_amount', 15, 2)->default(0)->after('ppn_rate');
            $table->decimal('pph_rate', 5, 2)->default(0)->after('ppn_amount');
            $table->decimal('pph_amount', 15, 2)->default(0)->after('pph_rate');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['ppn_rate', 'ppn_amount', 'pph_rate', 'pph_amount']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('tax_type')->nullable();
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
        });
    }
};