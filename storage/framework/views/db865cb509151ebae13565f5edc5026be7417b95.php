<div class="shipping-methods">
    <p class="title" style="width: 100%;padding-top: 33px;font-weight:bold;
">Please select a prefered shipping method to use on this order</p>
    <?php echo Form::open(['method'=>'post', 'url'=>'checkout_shipping_method', 'id'=>'shipping_mehtods_form', 'name'=>'shipping_mehtods']); ?>


    <?php if(count($shipping_methods)>0): ?>
        <div class="form-check">
            <div class="form-row">
                <ul class="list">
                    <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--<div class="heading">-->
                        <!--    <h2><?php echo e($shipping_method->title); ?></h2>-->
                        <!--    <hr>-->
                        <!--</div>-->
                        <li>
                            <input required class="shipping_data"
                                   id="<?php echo e($shipping_method->id); ?>" type="radio"
                                   name="shipping_method"
                                   value="<?php echo e($shipping_method->id); ?>"
                                   shipping_price="<?php echo e($shipping_method->charge); ?>"
                                   method_name="<?php echo e($shipping_method->title); ?>"
                                   <?php if(!empty(Session::get('shipping_method'))): ?>
                                   <?php if(Session::get('shipping_method.method_name') == $shipping_method->title): ?> checked
                                    <?php endif; ?> <?php endif; ?>
                            >
                            <label for="<?php echo e($shipping_method->id); ?>"><?php echo e($shipping_method->title); ?>

                                --- <?php echo e(SM::currency_price_value($shipping_method->charge)); ?></label>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="alert alert-danger alert-dismissible error_shipping" role="alert"
         style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        Please select your shipping method
    </div>
    <div class="submitButton">
        <button type="submit"
                class="btn btn-success">Continue
        </button>
    </div>
    <?php echo e(Form::close()); ?>

</div>