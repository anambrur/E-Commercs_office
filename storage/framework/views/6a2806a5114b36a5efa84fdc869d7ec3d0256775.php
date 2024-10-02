<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.common.css2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php
    $shipping_method_charge = Session::get('shipping_method.method_charge');
    $shipping_method_name = Session::get('shipping_method.method_name');
    $coupon_code = Session::get('coupon.coupon_code');
    $coupon_amount = Session::get('coupon.coupon_amount');
    $net_sub_total = $sub_total + $tax + $shipping_method_charge - $noraml_discount_amount;
    $grand_total = $sub_total + $tax + $shipping_method_charge - $coupon_amount - $noraml_discount_amount;
    ?>
    <section class="site-content">
        <div class="container">
            <div class="breadcum-area">
                <div class="breadcum-inner">
                    <h3>Checkout</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Checkout</a></li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <?php if(session('step') == 0): ?>
                                    Shipping Address
                                <?php elseif(session('step') == 1): ?>
                                    Billing Address
                                <?php elseif(session('step') == 2): ?>
                                    Shipping Methods
                                <?php elseif(session('step') == 3): ?>
                                    Order Detail
                                <?php endif; ?>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="checkout-area">
                <div class="row">
                    <div class="col-12 col-lg-8 checkout-left">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php if(session('step') == 0): ?> active <?php elseif(session('step') > 0): ?> active-check <?php endif; ?>"
                                    id="shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab"
                                    aria-controls="pills-shpping" aria-expanded="true">Shipping Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(session('step') == 1): ?> active <?php elseif(session('step') > 1): ?> active-check <?php endif; ?>"
                                    <?php if(session('step') >= 1): ?> id="billing-tab" data-toggle="pill" href="#pills-billing"
                                   role="tab" aria-controls="pills-billing"
                                   aria-expanded="true" <?php endif; ?>>Billing
                                    Address</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(session('step') == 2): ?> active <?php elseif(session('step') > 2): ?> active-check <?php endif; ?>"
                                    <?php if(session('step') >= 2): ?> id="shipping-methods-tab" data-toggle="pill"
                                   href="#pills-shipping-methods" role="tab" aria-controls="pills-shipping-methods"
                                   aria-expanded="true" <?php endif; ?>>Shipping
                                    Methods</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(session('step') == 3): ?> active <?php elseif(session('step') > 3): ?> active-check <?php endif; ?>"
                                    <?php if(session('step') >= 3): ?> id="order-tab" data-toggle="pill" href="#pills-order"
                                   role="tab" aria-controls="pills-order"
                                   aria-expanded="true" <?php endif; ?>>Order
                                    Detail</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade <?php if(session('step') == 0): ?> show active in <?php endif; ?>"
                                id="pills-shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <?php echo $__env->make('frontend.checkout.shipping_address', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="tab-pane fade <?php if(session('step') == 1): ?> show active in <?php endif; ?>"
                                id="pills-billing" role="tabpanel" aria-labelledby="billing-tab">
                                <?php echo $__env->make('frontend.checkout.billing_address', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="tab-pane fade <?php if(session('step') == 2): ?> show active in <?php endif; ?>"
                                id="pills-shipping-methods" role="tabpanel" aria-labelledby="shipping-methods-tab">
                                <?php echo $__env->make('frontend.checkout.shipping_method', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="tab-pane fade <?php if(session('step') == 3): ?> show active in <?php endif; ?>"
                                id="pills-order" role="tabpanel" aria-labelledby="order-tab">
                                <?php echo Form::open(['method' => 'post', 'url' => 'place_order', 'id' => 'place_order']); ?>

                                <div class="order-review">
                                    <?php echo $__env->make('frontend.checkout.order_review', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                                <?php echo $__env->make('frontend.checkout.order_note_summary', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php echo $__env->make('frontend.checkout.payment_method', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <input type="hidden" name="sub_total" value="<?php echo e($sub_total); ?>">
                                <input type="hidden" name="discount" value="<?php echo e($noraml_discount_amount); ?>">
                                <input type="hidden" name="tax" value="<?php echo e($tax); ?>">
                                <input type="hidden" name="coupon_code" class="coupon_code" value="<?php echo e($coupon_code); ?>">
                                <input type="hidden" name="coupon_amount" class="coupon_amount"
                                    value="<?php echo e($coupon_amount); ?>">
                                <input type="hidden" name="grand_total" class="grand_total" value="<?php echo e($grand_total); ?>">
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div> <!--CHECKOUT LEFT CLOSE-->
                    <?php echo $__env->make('frontend.checkout.right_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <!--CHECKOUT RIGHT CLOSE-->
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>