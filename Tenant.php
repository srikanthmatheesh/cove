<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Services\AccountingService;

class Tenant extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the accounting service that of the tenant.
     */
    public function accounting_service()
    {
        
        return $this->belongsTo(AccountingService::class, 'tenant_id', 'id');

    }

    public function getPendingInvoices($id)
    {
        $await_payment_invoices = [];

        $await_payment_invoices = AccountingService::where([
            'tenant_id' => $id,
            'status' => 'awaiting-payment'
        ])->get();

        return $await_payment_invoices;

    }

    public function getPaidInvoices() {

        $paid_invoices = [];

        $paid_invoices = AccountingService::where([
            'tenant_id' => $id,
            'status' => 'paid'
        ])->get();

        return $paid_invoices;

    }

}
