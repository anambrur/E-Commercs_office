@extends('frontend.master')
@section('content')
    @include('frontend.common.css2')
    <section class="site-content">
        <div class="container">
            <div class="breadcum-area">
                <div class="breadcum-inner">
                    <h3>@lang('website.Shopping cart')</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/')}}">@lang('website.Home')</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="cart-area">
                <div class="row">
                    <?php
                    $result['cart']= Cart::instance('cart')->content();
                    $price = 0;
                    ?>
                    @if(count($result['cart']) > 0)

                        <div class="col-12 col-lg-8 cart-left">
                            <div class="row">
                                @if(session()->has('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                                <form method='POST' id="update_cart_form" action='{{ URL::to('/updateCart')}}'>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th align="left">@lang('website.items')</th>
                                                <th align="right">@lang('website.Price')</th>
                                                <th align="right">@lang('website.Qty')</th>
                                                <th align="right">@lang('website.SubTotal')</th>
                                            </tr>
                                            </thead>

                                            @foreach( $result['cart'] as $products)
                                                <?php
                                                $price += $products->final_price * $products->customers_basket_quantity;
                                               
                                                ?>

                                                <tbody>
                                                <tr>
                                                    <td align="left" class="item">
                                                        <input type="hidden" name="cart[]"
                                                               value="{{$products->customers_basket_id}}">
                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"
                                                           class="cart-thumb">
                                                            <img class="img-fluid" src="{{ SM::sm_get_the_src($products->options->image, 100, 100) }}"
                                                                 alt="{{$products->products_name}}" alt="">
                                                        </a>
                                                        <div class="cart-product-detail">
                                                            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"
                                                               class="title">
                                                                {{$products->name}} {{$products->model}}
                                                            </a>

                                                        </div>
                                                    </td>

                                                    <td align="right" class="price">
                                                        <span>{{ SM::get_setting_value('currency') }}{{$products->price}}</span>
                                                    </td>
                                                    <td align="right" class="Qty">
                                                        <div class="input-group">
                                                  <span class="input-group-btn qtyminus_{{$products->customers_basket_id}}">
                                                    	<i class="fa fa-minus" aria-hidden="true"></i>
                                                  </span>
                                                            <input name="quantity[]" type="text" readonly
                                                                   value="{{$products->qty}}"
                                                                   class="form-control qty">
                                                            <span class="input-group-btn qtypluscart_{{$products->customers_basket_id}}">
                                                  		<i class="fa fa-plus" aria-hidden="true"></i>
                                                  </span>
                                                        </div>
                                                    </td>

                                                    <td align="right" class="subtotal"><span
                                                                class="cart_price_{{$products->customers_basket_id}}">{{ SM::get_setting_value('currency') }}{{$products->price * $products->qty}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="buttons">
                                                        <a href="{{ URL::to('/editcart?id='.$products->customers_basket_id)}}"
                                                           class="btn btn-sm btn-secondary">@lang('website.Edit')</a>
                                                        <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"
                                                           class="btn btn-sm btn-secondary">@lang('website.Remove Item')</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </form>
                            </div>

                            <div class="row button">
                                <div class="col-12 col-sm-6">
                                    <div class="row">
                                        <a href="{{ URL::to('/shop')}}"
                                           class="btn btn-dark">@lang('website.Back To Shopping')</a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row justify-content-end">
                                        <button class="btn btn-dark"
                                                id="update_cart">@lang('website.Update Cart')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 cart-right">
                            <div class="order-summary-outer">
                                <div class="order-summary">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th align="left" colspan="2">@lang('website.Order Summary') </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td align="left"><span>@lang('website.SubTotal')</span></td>
                                                <td align="right"
                                                    id="subtotal">{{ SM::get_setting_value('currency') }}{{Cart::instance('cart')->subTotal()}}</td>
                                            </tr>


                                            <tr>
                                                <td align="left"><span>@lang('website.Discount(Coupon)')</span></td>
                                                <td align="right"
                                                    id="discount">{{ SM::get_setting_value('currency') }}{{number_format((float)session('coupon_discount'), 2, '.', '')+0}}</td>
                                            </tr>
                                            <tr>
                                                <td class="last" align="left"><span>@lang('website.Total')</span></td>
                                                <td class="last" align="right"
                                                    id="total_price">{{ SM::get_setting_value('currency') }}{{ Cart::instance('cart')->total()}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="coupons">
                                    <!-- applied copuns -->

                                    <form id="apply_coupon" class="form-validate">
                                        <div class="form-group">
                                            <label>@lang('website.Coupon Code')</label>
                                            <input type="text" name="coupon_code" class="form-control" id="coupon_code">

                                            <div id="coupon_error" class="help-block" style="display: none"></div>
                                            <div id="coupon_require_error" class="help-block"
                                                 style="display: none">@lang('website.Please enter a valid coupon code')</div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-sm btn-dark">@lang('website.ApplyCoupon')</button>
                                    </form>


                                </div>

                                <div class="buttons">
                                    <a href="{{ URL::to('/checkout')}}"
                                       class="btn btn-block btn-secondary">@lang('website.proceedToCheckout')</a>
                                </div>
                            </div>
                        </div>

                    @else

                        <div class="col-xs-12 col-sm-12 page-empty">
                            <span class="fa fa-cart-arrow-down"></span>
                            <div class="page-empty-content">
                                <span>@lang('website.cartEmptyText')</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection


