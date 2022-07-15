<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    public $guarded = [];

    public function invoiceDetails(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'service_id');
    }
}
