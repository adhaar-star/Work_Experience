<?php
namespace App\Models\Billing;

use App\Models\Master\Material;
use App\Models\Sales\SalesOrderItem;
use Illuminate\Database\Eloquent\Model;
use Auth;

class BillingItem extends Model
{

    protected $table = 'billing_items';
    protected $primaryKey = 'billing_item_id';

    protected $fillable = [
        'billing_id',
        'sales_order_item_id',
        'sales_order_id',
        'milestone',
        'billing_type',

        'gross_price',
        'discount_amount',
        'tax_amount',
        'total_price',
        'description',

    ];


    public function salesItem()
    {
        return $this->belongsTo(SalesOrderItem::class,   'sales_order_item_id');
    }
}