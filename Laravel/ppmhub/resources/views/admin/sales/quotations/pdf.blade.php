<style type="text/css">
    * {
        font-family: "Lato", sans;
        margin: 0;
        padding: 0;
    }
    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
        color: #24222f;
    }
    .text-center {
        text-align: center;
    }
    .h2{
        font-size: 32px;;
    }
    .panel .row {
        margin-right: -16px;
        margin-left: -16px;
    }

    .table-responsive {
        display: block;
        width: 100%;
        min-height: .01%;
        overflow-x: auto;
    }
    .table-bordered {
        border: 1px solid #eceeef;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-spacing: 0;
        border-collapse: collapse;
    }



    .table-bordered thead td, .table-bordered thead th {
        border-bottom-width: 1px;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 1px solid #eceeef;
        font-size: 12px;
    }


    .table tr td {

        font-size: 12px;
    }



    .table td, .table th {
        padding: 8px;
        line-height: 1.5;
        vertical-align: top;
        border-top: 1px solid #eceeef;
    }

    th {
        text-align: left;
    }

    td, th {
        padding: 0;
    }
    .table tbody tr:first-child td {
        border-top: none;
    }

    .table td, .table th {
        border-color: #eceff4;
    }

    .table-bordered th {
        border-top: 1px solid #eceeef;
        border-right: 1px solid #eceeef;
        border-left: 1px solid #eceeef;
        border-bottom: none;
    }
    .table-bordered td{
        border: 1px solid #eceeef;
    }

    .text-right {
        text-align: right !important;
    }

    .text-muted {
        color: #333;
    }

    .text-center {
        text-align: center !important;
    }
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
        height: 0;
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
    }

.active{
    font-weight: bold;
}

</style>

<!-- Page Content -->
<div class="content content-boxed" style="margin: 15px;">
    <!-- Invoice -->
    <div class="block">
        <div class="block-content block-content-narrow">
            <!-- Invoice Info -->
            <div class="h2 text-center" style="margin-top: 40px; ">Company Information</div>
            <hr>
            <div class="row items-push-2x">
                <table class="table">
                    <tr>
                        <td>
                        @if(!empty($customer))
                                <p class="h3 font-w400 push-5">{{ $customer->name }}</p>
                                <address style="font-style: normal; font-size: 12px;">
                                    {{ $customer->street }}<br>
                                    {{ $customer->city }}, {{ $customer->postal_code }}<br>
                                    {{ $customer->state }} @if(!empty($customer->countryInfo)), {{ $customer->countryInfo->country_name }}@endif<br>
                                    <strong>{{ $customer->office_phone }}</strong>
                                </address>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <p class="h6 font-w400 push-5">Date: {{ \Carbon\Carbon::parse($quotation->created_at)->format('d/m/y') }}</p>
                            <p class="h6 font-w400 push-5">Quotation No.: {{ $quotation->sales_quotation_no }}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive push-50">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No.</th>
                            <th>Description</th>

                            @if($quotation->sales_order_type =='goods')
                                <th class="text-center" style="width: 40px;">Qty</th>
                                <th class="text-right" style="width: 60px;">Unit Price</th>
                            @endif

                            <th class="text-right" style="width: 60px;">Gross Price</th>
                            <th class="text-right" style="width: 60px;">GST</th>
                            @if($quotation->sales_order_type =='goods')
                                <th class="text-right" style="width: 60px;">Freight Charges</th>
                            @endif
                            <th class="text-right" style="width: 60px;">Discount</th>
                            <th class="text-right" style="width: 60px;">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if($quotationItems->count())
                        @forelse($quotationItems as $quotationItem)
                            <tr>
                                <td class="text-center">{{$quotationItem->sales_quotation_item_no}}</td>
                                <td>
                                    @if($quotation->sales_order_type =='goods')

                                        @if(!empty($quotationItem->material)  &&  !empty($quotationItem->salesMaterial))
                                            <p class="font-w600 push-5">{{$quotationItem->material_no}} - {{$quotationItem->salesMaterial->name}}</p>
                                            <div class="text-muted">{{$quotationItem->salesMaterial->description}}</div>
                                        @endif

                                    @else

                                        @if( !empty($quotationItem->project_id)  &&  !empty($quotationItem->salesProject) )
                                            <p class="font-w600 push-5"> {{ $quotationItem->salesProject->project_Id }} - {{ $quotationItem->salesProject->project_name }}</p>
                                            <div class="text-muted">{{ $quotationItem->salesProject->project_desc }}</div>
                                        @endif

                                    @endif
                                </td>

                                @if($quotation->sales_order_type =='goods')
                                    <td class="text-center"><span class="badge badge-primary">{{$quotationItem->material_quantity}}</span></td>
                                    <td class="text-right">${{ $quotationItem->unit_price }}</td>
                                @endif

                                <td class="text-right">${{ $quotationItem->gross_price }}</td>
                                <td class="text-right">${{ $quotationItem->tax_amount }}</td>
                                @if($quotation->sales_order_type == 'goods')
                                    <td class="text-right">${{ $quotationItem->freight_charges }}</td>
                                @endif

                                <td class="text-right">${{ $quotationItem->discount_amount }}</td>
                                <td class="text-right">${{ $quotationItem->total_price }}</td>
                            </tr>
                        @endforeach
                    @endif



                    <tr>
                        <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Total Gross Amount</td>
                        <td class="text-right">${{ $quotation->gross_price }}</td>
                    </tr>

                    <tr>
                        <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Total GST</td>
                        <td class="text-right">${{ $quotation->tax_amount }}</td>
                    </tr>
                    @if($quotation->sales_order_type == 'goods')
                        <tr>
                            <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Freight Charges</td>
                            <td class="text-right">${{ $quotation->freight_charges }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Discount</td>
                        <td class="text-right">${{ $quotation->discount_amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w600 text-right">Down Payment</td>
                        <td class="text-right">${{ $quotation->down_payment }}</td>
                    </tr>

                    <tr class="active">
                        <td colspan="{{ ($quotation->sales_order_type == 'goods') ? 8 : 5 }}" class="font-w700 font-w600 text-uppercase text-right">Total Amount Payable</td>
                        <td class=" font-w700 text-right"><strong>${{ $quotation->total_price -$quotation->down_payment }}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <p class="text-muted text-center"><small>Thank you very much for doing business with us. We look forward to working with you again!</small></p>
            <!-- END Footer -->
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END Page Content -->