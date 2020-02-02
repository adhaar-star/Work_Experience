@extends('layout.adminlayout')
@section('title','Portfolio Management | Portfolio Structure')
@section('body')
{!! Html::style('/css/Treant.css') !!}
{!! Html::style('/css/custom-colored.css') !!}
{!! Html::script('/js/raphael.js') !!}
{!! Html::script('/js/Treant.js') !!}
{!! Html::script('/js/portfolio-chart.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<style>
    .tree-struc {
        text-align: center;
    }
    .tree-struc .choose-port1 {
        float: none;
        margin-bottom: 25px;
        margin-right: 0;
        text-align: center;
        font-size:22px;
        margin-top:20px;
    }
    .tree-struc select {
        border-radius: 0;
        float: none;
        height: 46px;
        margin: 0 auto 20px;
        width: 40%;
    }
    .tree li a {
        background-color: #7a2100;
        border: 3px solid #fff;
        border-radius: 0;
        font-family: "Lato", sans;
        padding: 11px 20px;
        text-transform: uppercase;
    }

    .tree li a:hover, .tree li a:hover + ul li a {
        background: #ea6532 none repeat scroll 0 0;
        border: 3px solid #fff;
        color: #fff;
    }
</style>
<section id="client-information" class="client-information">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="tree-struc">
                    <form id="getPortfolioFrom" name="getPortfolioFrom" action="<?php echo url('admin/portfolioStructure/edit'); ?>" method="GET">


                        <!--<label class="choose-port1">Choose your portfolio:</label><br>-->
                        <select class="form-control portfolioStructure" onchange="renderPortfolioStructure(this);"  name="portfolio_id" id="portfolio_id">
                            <option selected="selected" value="">Choose your portfolio</option>
                            @foreach($portfolioAll as $port)
                            <option value="{{$port->id }}"  {{($port->id == $portfolioId) ? 'selected': ''}}>{{$port->name }}</option>
                            @endforeach
                        </select>
                    </form>	
                </div>
            </div>
            <?php
            if ((!empty($portfolio)) && (!empty($buckets)) && (!empty($subbuckets)) && (!empty($project))) {
                ?>
                <div class="col-md-12">
                    <div class="tree">
                        <ul>

                            <li>
                                <a href="#">{{$portfolio->name }}</a>

                                <ul>
                                    <!--li>
                                            <a href="#">Bucket</a>
                                            <ul>
                                                    <li>
                                                            <a href="#">Sub Bucket</a>
                                                    </li>
                                                    <li>
                                                            <a href="#">Sub Bucket</a>
                                                    </li>
                                            </ul>
                                    </li>
                                    <li>
                                            <a href="#">Bucket</a>
                                            <ul>
                                                    <li>
                                                            <a href="#">Sub Bucket</a>
                                                    </li>
                                                    <li>
                                                            <a href="#">Sub Bucket</a>
                                                    </li>
                                            </ul>
                                    </li-->
                                    <?php
                                    //echo "<pre>";
                                    //print_r($buckets);
                                    ?>



                                    <li>
                                        <a href="#">{{$buckets->name }}</a>
                                        <ul>
                                            @foreach($subbuckets as $subbuc)
                                            <li><a href="#">{{$subbuc->name }}</a>
                                                <ul>
                                                    @foreach($project as $pro)
                                                    <li>
                                                        <a href="#">{{$pro->project_Id }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                            <!--li>
                                                    <a href="#">Sub Bucket</a>
                                                    <ul>
                                                            <li>
                                                                    <a href="#">Project</a>
                                                            </li>
                                                            <li>
                                                                    <a href="#">Project</a>
                                                                    
                                                            </li>
                                                    </ul>
                                            </li-->

                                        </ul>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<div id="tree-chart">

</div>

@if($portfolioId != 0 || $portfolioId != null)
<script>

    $(document).ready(function () {
        $('#portfolio_id').trigger('change');
    });

</script>
@endif
<script>


//    $(function () {
//        $('#portfolio_id').change(function (e) {
//
//            $('#getPortfolioFrom').submit();
//
////alert("here");
//            var data = $(this).val();
//             //alert(data);
//             
//             $.ajax
//             ({
//             url: '{{ url('portfolioStructure/getpackages') }}/'+ data,
//             type: 'GET',
//             dataType: 'json',
//             success: function(data)
//             {
//             alert(data);
//             console.log(data);
//             }
//             });
//             
//        });
//
//    });



</script>

@endsection
