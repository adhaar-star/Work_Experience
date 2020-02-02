<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset="utf-8" />
        <title>Quotation PDF</title>

        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Roboto',arial !important;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            } 
            @page {
                margin: 0;
            }
            .book {
                width: 21cm;
                margin: auto;
                background: #fff;
                padding: 15px 15px 15px 15px;
            }
            @media print {
                .page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                }
            }
            p{
                margin: 0;
            }
            th {
                font-size: 14px;
            }
            td {
                padding: 5px 0;
            }
        </style>
    </head>
    <body>
        <div class="book" style="border:1px solid #000;">
            <div class="page">
                <h3>Quotation</h3>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td style="width:60%; vertical-align: top;">
                                <table>
                                    <tr>
                                        <td>Customer :</td>
                                        <td>{{$quotation_data->customer_name}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:40%;">
                                <table>
                                    <tr>
                                        <td>Quotation Number :</td>
                                        <td>&nbsp;&nbsp;{{$quotation_data->quotation_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Quotation Type :</td>
                                        <td>&nbsp;&nbsp;{{$quotation_data->quotation_type}}</td>
                                    </tr>
                                    <tr>
                                        <td>Inquiry Number :</td>
                                        <td>&nbsp;&nbsp;{{$quotation_data->inquiry}}</td>
                                    </tr>
                                    <tr>
                                        <td>Requested by :</td>
                                        <td>&nbsp;&nbsp;{{$quotation_data->employee_first_name}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 30px;">
                                <table border="1" width="100%" style="border-collapse: collapse;border:0;border-color: #ccc;text-align: center;">
                                    <thead>
                                        <tr>
                                            <th style="border:0; width:10%">Item No.</th>
                                            <th style="border:0; width:30%">Description</th>
                                            <th style="border:0; width:10%">Order Quantity</th>
                                            <th style="border:0; width:10%">Cost Unit</th>
                                            <th style="border:0; width:10%">Profit Margin</th>
                                            <th style="border:0">Discount</th>
                                            <th style="border:0">Sales tax</th>
                                            <th style="border:0">Net Price</th>
                                            <th style="border:0">Freight Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quotation_item as $item)
                                        <tr>
                                            <td style="width:10%">{{$item->item_no}}</td>
                                            <td style="width:30%">{{$item->short_description}}</td>
                                            <td style="width:10%">{{$item->order_qty}}</td>
                                            <td style="width:10%">{{$item->cost_unit}}</td>
                                            <td style="width:10%">{{$item->profit_margin}}</td>
                                            <td style="width:10%">{{$item->discount}}</td>
                                            <td style="width:10%">{{$item->sales_tax}}</td>
                                            <td style="width:10%">{{$item->net_price}}</td>
                                            <td style="width:10%">{{$item->freight_charges}}</td>
                                        </tr> 
                                        @endforeach
                                        <tr>
                                            <td colspan="6" rowspan="3" style="border: 0;"></td>
                                            <td colspan="2">Gross Price</td>
                                            <td>{{$quotation_data->quotation_gross_price}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Total Price</th>
                                            <td>{{$quotation_data->quotation_total_price}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
<!--                        <tr>
                            @if(!isset($flag))
                            <td colspan="2">
                                <table style="width: 100%;margin: 50px 0 30px;">
                                    <tr>
                                        <td>
                                            <a href="{{ route('quotation.export.pdf',$quotation_data->quotation_number.'/?email=pdf')}}" style="border: 1px solid #40d7b2;color: #fff;background:#40d7b2;padding: 8px 12px;border-radius: 4px;font-size: 16px;display: inline-block;text-decoration: none;">Email</a>
                                            <a href="{{ route('quotation.export.pdf',$quotation_data->quotation_number.'/?download=pdf')}}" style="border: 1px solid #ccc;color: #000;background:#fff;padding: 8px 12px;text-decoration: none;border-radius: 4px;font-size: 16px;display: inline-block;">PDF</a>
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{url('admin/quotation')}}" style="border: 1px solid #ccc;color: #000;padding: 8px 12px;border-radius: 4px;font-size: 16px;display: inline-block;text-decoration: none;">Cancel</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            @endif
                        </tr>-->
                    </tbody>
                </table>  
            </div>
        </div>
    </body>
</html>