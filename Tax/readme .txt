see example :-
https://github.com/abanoubsamirnaguib/grepper/tax_invoice
----------
nedd to install 
package hz/qr-invoice
package carlos-meneses/laravel-mpdf
----------
app for check 
https://play.google.com/store/apps/details?id=com.posbankbh.einvoiceqrreader&hl=ar&gl=US
https://play.google.com/store/apps/details?id=com.gazt.egazt&hl=ar&gl=US
---------
html a 
<a style="cursor: pointer" target="_blank" href="{{route('get-invoice',$order->id)}}">@lang('site.invoice')</a>
laverl route
Route::get('/get-invoice/{deliveryRequest}', [App\Http\Controllers\Dashboard\invoiceController::class, 'show'])->name('get-invoice');
------------