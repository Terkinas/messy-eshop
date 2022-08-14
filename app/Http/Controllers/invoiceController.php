<?php

namespace App\Http\Controllers;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

class invoiceController extends Controller
{

    public function show()
    {
        $seller = new Party([
            'name'          => env('APP_NAME') . ' Inc.',
            'address'       => 'Gravrogku g. 19, Kaunas, Lithuania LT-51423',
            'phone'         => '37060038825',
            'custom_fields' => [
                'SWIFT' => 'HABALT22',
            ]
        ]);


        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test2@example.com',
            ],
        ]);

        $item[] = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);
        $item[] = (new InvoiceItem())->title('Service 2')->pricePerUnit(2);

        $invoice = Invoice::make()->seller($seller)
            ->buyer($customer)
            ->status('paid')

            ->shipping(10)
            ->taxRate(0)
            ->addItems($item);

        //->discountByPercent()

        return $invoice->stream();
    }
}
