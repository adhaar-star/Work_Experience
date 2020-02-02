<!DOCTYPE html>
<html>
    <head lang="en">
    </head>
    <body class="theme-dark menu-top menu-static colorful-enabled" ng-controller="MainCtrl">
    <center>
        <table>
            <tr>
                <td>Approve the Sales Order Request : </td>
                <td><a href="{{url('admin/sales_order/'.$sales_order->id.'/approval/'.$sales_order->approver_token)}}">Approve</a></td>
                </tr>
        </table>
            
    </center>   
            <div class="cwt__footer__bottom">
                <div class="row">
                    <div class="col-md-8">
                        <div class="cwt__footer__company">

                            <span>
                                © 2017 <a href="ppmhub.com.au" class="cwt__footer__link" target="_blank">PPM HUB</a>
                                <br>
                                All rights reserved
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-backdrop"><!-- --></div>

</body>
</html>