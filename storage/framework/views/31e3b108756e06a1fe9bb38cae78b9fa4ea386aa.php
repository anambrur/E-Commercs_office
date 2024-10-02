<div class="table">
    <table class="table">
        <thead>
        <tr>
            <th class="cart_product">Product</th>
            <th>Description</th>
            <th>Unit price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr id="tr_<?php echo e($item->rowId); ?>" class="removeCartTrLi">
                <td class="cart_product">
                    <a href="<?php echo e(url('product/'.$item->options->slug)); ?>">
                        <img src="<?php echo e(SM::sm_get_the_src($item->options->image, 100, 100)); ?>"
                             alt="<?php echo e($item->name); ?>"></a>
                </td>
                <td class="cart_description">
                    <p class="product-name">
                        <a href="<?php echo e(url('product/'.$item->options->slug)); ?>"><strong><?php echo e($item->name); ?></strong> </a></p>
                    <br>
                    <small class="cart_ref">SKU : <?php echo e($item->options->sku); ?></small>
                    <br>
                    <?php if($item->options->colorname != ''): ?>
                        <small>Color : <?php echo e($item->options->colorname); ?></small>
                        <br>
                    <?php endif; ?>
                    <?php if($item->options->sizename != ''): ?>
                        <small>Size : <?php echo e($item->options->sizename); ?></small>
                    <?php endif; ?>
                </td>
                <td class="price"><span><?php echo e(SM::currency_price_value($item->price)); ?></span></td>
                <td class="qty">
                    <span><?php echo e($item->qty); ?></span>
                </td>
                <td class="price">
                    <span><?php echo e(SM::currency_price_value($item->price * $item->qty)); ?></span>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">
                    <p class="product-name" style="color: red">No data found!</p>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>