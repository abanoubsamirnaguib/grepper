<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\print\printorder;
use Hz\QrInvoice\GenerateQrCode;
use Hz\QrInvoice\Tags\InvoiceDate;
use Hz\QrInvoice\Tags\InvoiceTaxAmount;
use Hz\QrInvoice\Tags\InvoiceTotalAmount;
use Hz\QrInvoice\Tags\Seller;
use Hz\QrInvoice\Tags\TaxNumber; 
use Illuminate\Support\Facades\Storage;

class invoiceController extends Controller
{
    public function show(printorder $deliveryRequest){
        // dd($deliveryRequest->branch->name);
        $provider_name = 'elkhayal';
        $tax_number = '300431438300004';
        $invoice_date = date("c", strtotime($deliveryRequest->created_at));
        $invoice_total_amount = $deliveryRequest->total_price;
        $invoice_tax_amount = $deliveryRequest->total_price * .15;
        $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
            new Seller($provider_name),
            new TaxNumber($tax_number),
            new InvoiceDate($invoice_date),
            new InvoiceTotalAmount($invoice_total_amount),
            new InvoiceTaxAmount($invoice_tax_amount)
        ])->render();
        $data = [
            'displayQRCodeAsBase64'=>$displayQRCodeAsBase64,
            'provider_name'=>$provider_name,
            'provider_tax_number'=>$tax_number,
            'order_id'=>$deliveryRequest->id,
            'order_discount'=>0,
            'tax_percent'=>'15',
            'order_date'=>$deliveryRequest->created_at,
            'tax_cost'=>$invoice_tax_amount,
            'order_before_tax'=>$deliveryRequest->cost_of_delivery,
            'order_after_tax'=>$invoice_total_amount,
            'files'=>count($deliveryRequest->files),
            'branch_name' => $deliveryRequest->branch->name
        ];

        $id = $deliveryRequest->id;
        if (Storage::disk('public_uploads')->missing("invoices/invoice$id.pdf")) {         
            if (Storage::disk('public_uploads')->missing('invoices')) {
                Storage::disk('public_uploads')->makeDirectory('invoices');
            }
        }
         \PDF::loadView('invoice.bill', $data , [] , [
            'title' => $provider_name. " - ". $deliveryRequest->user->name
         ])
         ->save(public_path("uploads/invoices/invoice" . $id . ".pdf"));
      
        $myFile = public_path("uploads/invoices/invoice" . $id . ".pdf");
        $headers = ['Content-Type: application/pdf'];
        return response()->file($myFile, $headers);

        // return response()->download($myFile, $provider_name, $headers);
        // return  view('invoice.bill',$data);
    }

}

