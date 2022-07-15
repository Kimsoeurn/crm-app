<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceDetails(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }

    public function updateTotal()
    {
        $total = 0;

        foreach ($this->invoiceDetails()->get() as $detail) {
            $total += $detail->price * $detail->qty;
        }

        $this->total = $total;
        $this->save();
    }
}
