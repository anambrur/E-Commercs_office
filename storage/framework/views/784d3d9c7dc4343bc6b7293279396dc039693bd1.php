<?php $__env->startSection("title", "Order Complete"); ?>
<?php $__env->startSection("content"); ?>
    <?php
    //        Session::forget('step');
    //        Session::forget('shipping');
    //        Session::forget('billing');
    //        Session::forget('shipping_method');
//    var_dump(Session::get('step'));
//    var_dump(Session::get('shipping'));
//    var_dump(Session::get('billing'));
//    var_dump(Session::get('shipping_method'));
//    var_dump(Session::get('coupon'));
//    exit();
    ?>
    <section class="common-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="account-panel">
                        <h2>Order Complete</h2>
                        <div class="account-panel-inner">
                            <div class="row">
                                <h4>Thank you for your order</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>