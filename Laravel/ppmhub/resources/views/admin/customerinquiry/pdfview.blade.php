<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        <meta charset="utf-8" />
        <title>Inquiry PDF</title>
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
            .book {
                width: 20.2cm;
                min-height: 1403px;
                margin:auto;
                background: #fff;
                padding: 15px 15px 15px 15px;
            }

            @page {
                size: A4;
                margin: 0;
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
            /*page header*/
            table.proposal-heading{
                border-collapse: collapse;
                width: 100%;
            }
            table.proposal-heading tr td {
                padding: 10px;
            }
            table.proposal-heading td .address p {
                line-height: 13px;
                font-family: 'arial';
                text-align: right;
                font-size: 12px;
            }
            table.proposal-heading td .pdf-from {
                margin-top: 10px;
            }
            table.proposal-heading td .pdf-from p {
                text-align: right;
                font-size: 12px;
                font-family: 'arial';
            }

            /*proposal information table*/
            .page-body-container {
                margin-top: 15px;
            }
            .page-body-container,.page-invoice-container {
                padding-left: 50px;
            }
            table.proposal-information{
                border-collapse: collapse;
                width: 100%;
            } 
            table.proposal-information tr td{
                /*border: 1px solid #ddd;*/
                padding: 5px 10px;
            }

            table.proposal-information tr.head-row  td:first-child {
                border-left: 2px solid #000;
                border-bottom: 1px solid #000;
            }
            table.proposal-information tr.head-row  td:last-child{
                border-bottom: 1px solid #000;
            }
            table.proposal-information tr.head-row  td:first-child p {
                text-align: left;
                font-size: 13px;
                font-weight: normal;
            }
            table.proposal-information tr.head-row  td:last-child p {
                text-align: left;
                font-size: 15px;
                font-weight: 600;
            }
            table.proposal-information tr.content-row td:first-child {
                border-right: 2px solid #000;
                vertical-align: top;
                font-size: 13px;
                font-weight: bold;
            }
            table.proposal-information tr.content-row  td:last-child{
                border-left: 2px solid #000;
                vertical-align: top;
                font-size: 13px;
                font-weight: normal;
            }
            table.proposal-information tr.content-row  td:first-child p{
                text-align: right;
            } 
            table.proposal-information tr.content-row  td:last-child .proposal-description{
                height: 30px;
            }
            /*proposal invoice data table*/
            .page-invoice-container{
                margin:15px 0px 15px 0px;
            }
            table.proposal-invoice-data,
            table.page-invoice-data{
                border-collapse: collapse;
                width: 100%;
            }
            table.proposal-invoice-data tr > td,
            table.page-invoice-data tr > td{
                padding: 5px 10px;
            }
            table.proposal-invoice-data tr.content-row:first-child > td:first-child,
            table.page-invoice-data tr.content-row:first-child > td:first-child{
                border-right: 2px solid #000;
                vertical-align: top;
                font-size: 13px;
                font-weight: bold;
            }
            table.proposal-invoice-data tr.content-row:first-child > td:last-child,
            table.page-invoice-data tr.content-row:first-child > td:last-child{
                border-left: 2px solid #000;
                border-top: 1px solid #000;
                vertical-align: top;
                font-size: 13px;
                font-weight: bold;
            }
            table.proposal-invoice-data tr.content-row  > td:first-child p,
            table.page-invoice-data tr.content-row > td:first-child p{
                text-align: right;
            }
            table.proposal-invoice-data tr.content-row > td:first-child,
            table.page-invoice-data tr.content-row > td:first-child{
                border-right: 2px solid #000;
                vertical-align: top;
                font-size: 13px;
                font-weight: bold;
            }
            table.proposal-invoice-data tr.content-row > td:last-child,
            table.page-invoice-data tr.content-row > td:last-child{
                vertical-align: top;
                font-size: 13px;
                font-weight: normal;
            }
            table.proposal-invoice-data tr.content-row > td .invoice-amount,
            table.page-invoice-data tr.content-row > td .invoice-amount{
                width: 90px;
                text-align: right;
            }
            .sign-area {
                display: inline-block;
                height: 103px;
                width: 100%;
            }
            .sign-area img{
                width: 200px;
                height: auto;
            }
            table.terms-condition-data {
                width: 100%;
                border-collapse: collapse;
            }
            table.terms-condition-data .terms {
                text-align: center;
                margin-bottom: 35px;
            }
            table.terms-condition-data .terms p{
                font-size: 11px;
            }
            table.terms-condition-data .terms p.conditions{
                font-size: 9px;
                margin-top: 3px;
            }
            table.terms-condition-data  .sign-by p {
                font-size: 13px;
            }
            .page-footer {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="book">
            <div class="page">
                <div class="subpage">
                    <div class="page-body-container">
                        <table class="proposal-information">
                            <tr class="head-row">
                                <td style="width: 18%;">
                                </td>
                                <td style="width: 82%;">
                                </td>
                            </tr>
                            @foreach($items as $item)
                            <tbody>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p>Inquiry Number:</p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="proposal-for">{{ $item->inquiry_number }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Description</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="field-title">{{ $item->inquiry_description }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Quotation</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <div>
                                            <p>{{ $item->quotation }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Sales Order</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                            <p>{{ $item->sales_order }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Inquiry Type</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="">{{ $item->inquiry_type }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Customer</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="">{{$item->customer}}</p>
                                        <!--<p class="">5/4 4cp+SSV/4cp</p>-->
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Sales Region</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="field-proofs">{{ $item->sales_region }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Created on</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="">{{ Carbon\Carbon::parse($item->created_on)->format('Y-m-d') }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Created By</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="">{{ $item->created_by }}</p>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td style="width: 18%;">
                                        <p><b>Requested By</b></p>
                                    </td>
                                    <td style="width: 82%;">
                                        <p class="">{{ $item->requested_by }}</p>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </body>
</html>