<?php
namespace App\Http\Middleware;
use Closure;
use App\Models\VendorPermission;
use App\Models\Helper;
use Illuminate\Contracts\Auth\Guard;
 


class VendorMiddleware
{

  protected $auth;
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */

  public function __construct(Guard $auth)
  {
      $this->auth = $auth;
  }

  public function handle($request, Closure $next)
  {
    $vendorPr = VendorPermission::groupBy("type")->get();
    $permissions = $vendorPr->toArray();
    $dealPr = unserialize($permissions[0]['permissions']);
    $eventPr = unserialize($permissions[1]['permissions']);
    $productPr = unserialize($permissions[2]['permissions']);
    $ac = $request->route()->getAction();
    $exploded = explode('@', $ac['controller']);
    $method = $exploded[1];
    $cont = explode("\\",$exploded[0]) ;
    $controller = $cont[4];
    $status = true;

    switch($controller){

      case "ProductController":
        switch ($method) {
          case 'getCreate':
            if($productPr['add'] != 1){
              $status = false;
              $type = "product";
              $act = "add";
            }
            break;

          case 'getEdit':
            if($productPr['edit'] != 1){
              $status = false;
              $type = "product";
              $act = "edit";
            }
            break;

          case 'getDelete':
            if($productPr['delete'] != 1){
              $status = false;
              $type = "product";
              $act = "delete";
            }
            break;   

          default:
            break;
        }
        break;

      case "DealController":
        switch ($method) {
          case 'getCreate':
            if($dealPr['add'] != 1){
              $status = false;
              $type = "deal";
              $act = "add";
            }
            break;

          case 'getEdit':
            if($dealPr['edit'] != 1){
              $status = false;
              $type = "deal";
              $act = "edit";
            }
            break;

          case 'getDelete':
            if($dealPr['delete'] != 1){
              $status = false;
              $type = "deal";
              $act = "delete";
            }
            break;   

          default:
            break;
        }
        break;

      case "EventController":
        switch ($method) {
          case 'getCreate':
            if($eventPr['add'] != 1){
              $status = false;
              $type = "event";
              $act = "add";
            }
            break;

          case 'getEdit':
            if($eventPr['edit'] != 1){
              $status = false;
              $type = "event";
              $act = "edit";
            }
            break;

          case 'getDelete':
            if($eventPr['delete'] != 1){
              $status = false;
              $type = "event";
              $act = "delete";
            }
            break;   

          default:
            break;
        }
        break;

      default:
        break;
    }

    if($status == false){

        \Session::flash('message',['class'=> 'alert-warning','text' => "You do not have permission to access this page."]);

          return redirect("vendor/dashboard");
    }
    return $next($request);
  }
}

?>