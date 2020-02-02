@extends('layout.app')
@section('title','Home Page')
{!! Html::style('css/pricing/style.css') !!}
@section('body')
<style>
    .logo {padding: 15px 0;}
</style>
<section id="service" class="pricing">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="price_outer">
                    @foreach ($plans as $plan)
                    <div class="price_main">
                        <div class="price_heading define_float">
                            <h2>{{ $plan->name }}</h2>
                        </div>
                        <div class="price_monthly define_float">
                            <span class="price_currency">$</span>
                            <span class="price_number">{{ number_format($plan->cost, 2) }}</span>
                            <span class="price_duration">/ Monthly</span>
                        </div>
                        <div class="price_features define_float">
                            <ul>
                                @if ($plan->description)
                                {!! $plan->description !!}
                                @endif
                            </ul>
                        </div>
                        <div class="price_cart_button define_float">
                            <a href="{{ url('/register?plan='.$plan->slug) }}">Add to cart</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
