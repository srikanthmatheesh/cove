<?php

namespace App\Models;

use App\Services\AccountingService;

class Imvoice {
    
    private $accountingService;

    function __construct(){

        $this->accountingService = new AccountingService;

    }

    /**
     * Get await payment invoices.
     *
     * @param  null
     * @return array 
     */
    public function getPendingInvoices()
    {
        $params = [
            'tenant_id' => $this->id
        ];
        
        $invoices = $this->accountingService->getAllInvoices($params);

        $await_payment_invoices = [];
        
        if ($invoices) {

            // Loop through all invoices and choose only ones that await payment
            $await_payment_invoices = $this->filterInvoice($invoices, 'status', 'awaiting-payment');
            return $await_payment_invoices;
        }

        return null;

    }

    /**
     * Get Paid invoices.
     *
     * @param  null
     * @return array 
     */
    public function getPaidInvoices() {

        $paid_invoices = [];

        $params = [
            'tenant_id' => $this->id
        ];

        $invoices = $this->accountingService->getAllInvoices($params);
        
        if ($invoices) {

            $paid_invoices = $this->filterInvoice($invoices, 'status', 'paid');
            return $paid_invoices;

        }

        return null;

    }

    /**
     * Filter invoices based on the status.
     *
     * @param  array  $data
     * @param  string $filterKey
     * @param  string $status
     * @return array 
     */
    public function filterInvoice( $data = [], $filterKey, $status ) {
        
        $filtered_invoices = [];

        // Filter only specified status.
        $filtered_invoices = array_filter( $invoices, function( $invoice, $filterKey, $status ) {
            return $invoice[$filterKey] == $status;
        });

        return $filtered_invoices;
    }
}
