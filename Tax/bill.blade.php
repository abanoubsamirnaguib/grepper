<html>
    <head>
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <style>
            @font-face {
                font-family: ibmPlex;
                src: url({{asset('dashboard_files/fonts/IBMPlexArabic-Text.ttf')}});
                font-weight: normal;
                font-size:10px;
            }
            *:not(i),body:not(i){
                font-family: ibmPlex !important;
            }
        </style>
        <style>
            body.receipt .sheet { width: 58mm; height: 100mm } /* change height as you like */
            @media print { body.receipt { width: 58mm } } /* this line is needed for fixing Chrome's bug */
        </style>
    </head>
    <body class="receipt">
        <table style='width:100%'>
            <tr>
                <td class='text-center'>
                    {{-- <img src="{{asset('assets/img/logo-orange.png')}}" alt=""> --}}
                </td>
            </tr>
            <tr>
         
                <td class='text-center'><h3>فاتورة ضريبية مبسطة</h3></td>
            </tr>
            <tr>
                <td class='text-center'><h3>Simplified tax invoice</h3></td>
            </tr>
            <tr>
                <td class='text-center'><h3>الخيال</h3></td>
            </tr>
            <!-- <tr>
                <td class='text-center'><h3>الخيال </h3></td>
            </tr> -->
            <tr>
                <td class='text-center'><p> 
                 فرع   {{$branch_name}}     
                </p></td>
            </tr>
        </table>

        <table class="table">
                <tr>
                    <td>
                        رقم التعريف الضريبي
                        <br>
                        Tax identification number
                    </td>
                    <td>
                     {{$provider_tax_number}}  
                
                    </td>
                </tr>

                <tr>
                    <td>
                        رقم الفاتورة/رقم الطلب
                        <br>
                        Invoice number/Order request
                    </td>
                    <td>
                         {{$order_id}} 
                    </td>
                </tr>

                <tr>
                    <td>
                        تاريخ الفاتورة
                        <br>
                        Invoice date
                    </td>
                    <td>
                         {{date_format($order_date ,"Y/m/d H:i:s" )}} 
                    </td>
                </tr>

                <tr>
                    <td class='text-bold text-center' colspan="2">تفاصيل الفاتورة <br> Details</td>
                </tr>

                <tr>
                    <td>
                        رسوم التوصيل
                        <br>
                        Delivery fees
                    </td>
                    <td>
                         {{$order_before_tax}} @lang('site.sar_short') 
                    </td>
                </tr>

                <tr>
                    <td>
                        الخصم
                        <br>
                        Discount
                    </td>
                    <td>
                        {{$order_discount}} @lang('site.sar_short')
                    </td>
                </tr>

                <tr>
                    <td>
                        الإجمالي 
                        <br>
                        Sub total VAT inclusive
                    </td>
                    <td>
                         {{$order_after_tax}} @lang('site.sar_short') 
                    </td>
                </tr>
                  <tr>
                    <td>
                        عدد المنتجات             
                     <br>
                        products 
                    </td>
                    <td>
                        {{$files}} منتج
                    </td>
                </tr> 
                <!-- <tr>
                    <td>
                        معدل ضريبة القيمة المضافة
                        <br>
                        VAT
                    </td>
                    <td>
                        {{-- {{$tax_percent}} % --}}
                    </td>
                </tr> -->

                <!-- <tr>
                    <td>
                        إجمالي ضريبة القيمة المضافة التى تم جمعها
                        <br>
                        Total VAT Collected
                    </td>
                    <td>
                        {{-- {{$tax_cost}} @lang('site.sar_short') --}}
                    </td>
                </tr> -->

                <tr>
                    <td class='text-bold text-center' colspan="2">رمز الإستجابة السريع<br> QR Code</td>
                </tr>
                <tr>
                    <td class='text-center' colspan="2">
                         <img src="{{$displayQRCodeAsBase64}}" alt="QR Code" /> 
                    </td>
                </tr>
        </table>


    </body>
</html>