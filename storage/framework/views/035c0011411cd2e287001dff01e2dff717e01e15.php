<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('content'); ?>
    <!-- page wapper-->
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <?php echo $__env->make('frontend.common.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading no-line" style="display: none;">
                <span class="page-heading-title2">Shopping Cart Summary</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                <div class="heading-counter warning">Your shopping cart contains:
                    <span><?php echo e(count($cart)); ?> Product</span>
                </div>
                <div class="order-detail-content ">
                    <table class="table table-bordered table-responsive cart_summary cart_table">
                        <thead>
                            <tr>
                                <th class="cart_product">Product</th>
                                <th>Description</th>
                                <th>Unit price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr id="tr_<?php echo e($item->rowId); ?>" class="removeCartTrLi">
                                    <td class="cart_product">
                                        <a href="<?php echo e(url('product/' . $item->options->slug)); ?>">
                                            <img src="<?php echo e(SM::sm_get_the_src($item->options->image, 100, 100)); ?>"
                                                alt="<?php echo e($item->name); ?>"></a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name">
                                            <a href="<?php echo e(url('product/' . $item->options->slug)); ?>"><strong><?php echo e($item->name); ?></strong>
                                            </a>
                                        </p>
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
                                    <td class="price"><span><?php echo e(SM::currency_price_value($item->price)); ?> </span></td>
                                    <td class="qty">
                                        <style>
                                            .input-group-btn {
                                                font-size: unset;
                                            }
                                        </style>
                                        <div class="input-group">
                                            <span id="" class="input-group-btn dec"
                                                data-row_id="<?php echo e($item->rowId); ?>"><i class="fa fa-minus"
                                                    aria-hidden="true"></i></span>
                                            <input type="text" name="qty" class="form-control input-sm qty-inc-dc"
                                                id="<?php echo e($item->rowId); ?>" value="<?php echo e($item->qty); ?>">
                                            <span class="input-group-btn inc" data-row_id="<?php echo e($item->rowId); ?>"
                                                id=""><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="price">
                                        <span><?php echo e(SM::currency_price_value($item->price * $item->qty)); ?> </span>
                                    </td>
                                    <td class="action">
                                        <a data-product_id="<?php echo e($item->rowId); ?>" class="remove_link removeToCart"
                                            title="Delete item" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>

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
                        <tfoot>
                            <tr>
                                <td colspan="2" rowspan="3"></td>
                                <td colspan="3">Sub Total</td>
                                <td colspan="2"><?php echo e(SM::product_price(Cart::instance('cart')->subTotal())); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>Tax</strong></td>
                                <td colspan="2"><strong><?php echo e(SM::product_price(Cart::instance('cart')->tax())); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>Total</strong></td>
                                <td colspan="2">
                                    <strong><?php echo e(SM::product_price(Cart::instance('cart')->total())); ?></strong></td>
                            </tr>

                        </tfoot>
                    </table>
                    <div class="cart_navigation">
                        <?php if(Auth::check()): ?>
                            <a class="next-btn" href="<?php echo e(url('/checkout')); ?>">Proceed to checkout</a>
                        <?php else: ?>
                            <a class="next-btn" data-toggle="modal" data-target="#loginModal" href="#">Proceed to
                                checkout</a>
                        <?php endif; ?>
                    </div>
                    <div class="cart_navigation">
                        <a class="prev-btn" href="<?php echo e(url('/shop')); ?>">Continue shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./page wapper-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>