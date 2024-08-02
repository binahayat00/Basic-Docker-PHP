<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    CONST UPDATED_AT = null;
    
    protected $casts = [
        'created_at' => 'datetime',
        'status' => InvoiceStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function (Invoice $invoice){
            if($invoice->isClean('status')){
                $invoice->status = InvoiceStatus::VOID;
            }
        });
    }
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
