<table class="table table-striped">
    <thead>
        <tr>
            <th>Item No.</th>
            <th>Project</th>
            @if($order->sales_order_type == 'goods')
                <th>Material</th>
                <th>Quantity</th>
                <th>Unit Price</th>
            @endif
            <th>Total Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orderItems as $item)
            <tr>
                <td>{{ $item->sales_quotation_item_no }}</td>
                <td>@if(!empty($item->project_id) && !empty($item->salesProject)) {{ $item->salesProject->project_name }} @endif</td>
                @if($order->sales_order_type == 'goods')
                    <td>{{ $item->material_no }}</td>
                    <td>{{ $item->material_quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                @endif
                <td>{{ $item->total_price }}</td>
                <td>
                    <button class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{ $item->sales_quotation_item_id }}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    @if($order->status == 'created')
                        <a href="{{ route('sales-order-quotation-items', $item->sales_quotation_id) }}?update_item={{ $item->sales_quotation_item_id }}" class="btn btn-primary btn-xs margin-right-1"><i class="fa fa-pencil"></i></a>
                        <button  class="btn btn-danger btn-xs margin-right-1 deleteGlobalBtn" data-url="{{ route('sales-order-quotation-items-delete', $item->sales_quotation_item_id ) }}"  ><i class="fa fa-trash-o"></i></button>
                    @endif
                    <div class="modal fade table-view-popup" id="table-view-popup_{{ $item->sales_quotation_item_id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="text-align:left;">
                            <div class="modal-content" style="border-radius: 0;">
                                <div class="modal-header">
                                    <h3 class="model-list-striped-title">Quotation Item</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body model-list-striped">
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Item No.</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static">{{ $item->sales_quotation_item_no }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4"><p class="form-control-static">Delivery Date</p></div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static">@if( !empty($item->delivery_date) ) {{ Carbon\Carbon::parse($item->delivery_date)->format('d/m/y') }} @endif</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Project</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static">@if(!empty($item->project_id) && !empty($item->salesProject)) {{ $item->salesProject->project_Id }} {{ $item->salesProject->project_name }} @endif</p>
                                            </div>
                                        </div>
                                        @if($order->sales_order_type == 'goods')
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <p class="form-control-static">Material</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">{{$item->material_no}} @if(!empty($item->material) && !empty($item->salesMaterial)) {{ $item->salesMaterial->name }} @endif </p>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Description</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static">{{ $item->description }}</p>
                                            </div>
                                        </div>

                                        @if($order->sales_order_type == 'goods')
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <p class="form-control-static">Material Unit Price</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ $item->unit_price }}</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <p class="form-control-static">Material Quantity</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ $item->material_quantity }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group bg-success" >
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Gross Amount</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static"> {{ $item->gross_price }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">{{ $item->profit_margin }}% Profit Margin</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static"> {{ $item->profit_margin_amount }}</p>
                                            </div>
                                        </div>

                                        @if($order->sales_order_type == 'goods')
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <p class="form-control-static">Freight Charges</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> {{ $item->freight_charges }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Subtotal</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static"> {{ $item->gross_price +  $item->freight_charges + $item->profit_margin_amount }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">Discount Amount</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static"> {{ $item->discount_amount }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <p class="form-control-static">After Discount</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="form-control-static"> {{ $item->gross_price +  $item->freight_charges + $item->profit_margin_amount - $item->discount_amount}}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4"><p class="form-control-static">{{ $item->tax }}% Tax</p></div>
                                            <div class="col-sm-8"><p class="form-control-static"> {{ $item->tax_amount }}</p></div>
                                        </div>
                                        <div class="form-group bg-warning">
                                            <div class="col-sm-4"><p class="form-control-static">Total Amount</p></div>
                                            <div class="col-sm-8"><p class="form-control-static">{{ $item->total_price }}</p></div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    @if($order->sales_order_status == 'created' )
                                        <span class="edit-btn"><a href="{{ route('sales-order-items', $item->sales_quotation_id) }}?update_item={{ $item->sales_quotation_item_id }}" class="btn btn-primary">Edit Item</a></span>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    @else
                                        <button type="button" class="btn btn-danger pull-right" style="margin-right:20px;" data-dismiss="modal">Close</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>