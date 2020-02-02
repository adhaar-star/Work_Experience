<!DOCTYPE html>
<html>
    <head lang="en">
    </head>
    <body class="theme-dark menu-top menu-static colorful-enabled" ng-controller="MainCtrl">
    <center>
        <table>
            <tr>
                @foreach($sales_order as $key=>$sales)
                <th> {{$key}} </th>
                @endforeach
            </tr>
            <tr>
                @foreach($sales_order as $key=>$sales)
                <th> {{$sales}} </th>
                @endforeach
            </tr>



            @foreach($sales_item as $item)
                @if ($loop->first)
                <tr>
                    @foreach($item as $key=>$data)
                    <th>{{$key}}</th>
                    @endforeach
                </tr> 
                <tr>
                    @foreach($item as $key=>$data)
                    <td>{{$data}}</td>
                    @endforeach
                </tr> 
                @else

                <tr>
                @foreach($item as $key=>$data)
                    <td>{{$data}}</td>
                @endforeach
                </tr>
            
                @endif

            @endforeach

        </table>

    </center>   
    <div class="cwt__footer__bottom">
        <div class="row">
            <div class="col-md-8">
                <div class="cwt__footer__company">

                    <span>
                        © 2017 <a href="ppmhub.com.au" class="cwt__footer__link" target="_blank">PPMHUB</a>
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