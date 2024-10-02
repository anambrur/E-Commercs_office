<div class="payment-area">
    <div class="heading">
        <h2>Payment Methods</h2>
        <hr>
    </div>
    <div class="payment-methods">
        <p class="title">Please select a prefered payment method to use on this
            order</p>


        <div class="alert alert-danger error_payment" style="display:none" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>Please select your payment method'</button>
            
        </div>
        <ul class="list">
            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <label for="payment_method_<?php echo e($payment_method->id); ?>">
                        <input required type="radio" id="payment_method_<?php echo e($payment_method->id); ?>"
                            name="payment_method_id" class="payment_method" value="<?php echo e($payment_method->id); ?>">
                        <?php echo e($payment_method->title); ?>

                    </label>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="submitButton">
        <button class="btn btn-success">Order Now</button>
    </div>
</div>
