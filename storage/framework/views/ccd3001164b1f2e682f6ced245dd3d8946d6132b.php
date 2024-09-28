<?php
$productSecondLoop = 1;
?>
<?php if(count($productLists) > 0): ?>
    <?php $__currentLoopData = $productLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($product->product_type == 2): ?>
            <?php
            $att_data = SM::getAttributeByProductId($product->id);
            if (!empty($att_data->attribute_image)) {
                $attribute_image = $att_data->attribute_image;
            } else {
                $attribute_image = $product->image;
            }
            ?>
            <li class="col-sx-12 col-sm-4">
                <div class="product-container">
                    <div class="left-block">
                        <a href="<?php echo e(url('product/' . $product->slug)); ?>">
                            <img class="img-responsive" alt="<?php echo e($product->title); ?>"
                                src="<?php echo e(SM::sm_get_the_src($attribute_image, 268, 327)); ?>" />
                        </a>
                        <div class="quick-view">
                            <?php echo SM::quickViewHtml($product->id, $product->slug); ?>
                        </div>
                        <div class="add-to-cart">
                            <?php echo SM::addToCartButton($product->id, $product->regular_price, $product->sale_price); ?>
                        </div>
                    </div>
                    <div class="right-block">
                        <h5 class="product-name">
                            <a href="<?php echo e(url('product/' . $product->slug)); ?>"><?php echo e($product->title); ?></a>
                        </h5>
                        <div class="product-star">
                            <?php echo SM::product_review($product->id); ?>
                        </div>
                        <div class="content_price">
                            <span
                                class="price product-price"><?php echo e(SM::currency_price_value($att_data->attribute_price)); ?></span>

                        </div>
                        <div class="info-orther">
                            <p>Item Code: #453217907</p>
                            <p class="availability">Availability: <span><?php echo e($product->in_stock); ?></span></p>
                            <div class="product-desc">
                                <?php echo e($product->short_description); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </li>
        <?php else: ?>
            <li class="col-sx-12 col-sm-4">
                <div class="product-container">
                    <div class="left-block">
                        <a href="<?php echo e(url('product/' . $product->slug)); ?>">
                            <img class="img-responsive" alt="<?php echo e($product->title); ?>"
                                src="<?php echo e(SM::sm_get_the_src($product->image, 268, 327)); ?>" />
                        </a>
                        <div class="quick-view">
                            <?php echo SM::quickViewHtml($product->id, $product->slug); ?>
                        </div>
                        <div class="add-to-cart">
                            <?php echo SM::addToCartButton($product->id, $product->regular_price, $product->sale_price); ?>
                        </div>
                    </div>
                    <div class="right-block">
                        <h5 class="product-name">
                            <a href="<?php echo e(url('product/' . $product->slug)); ?>"><?php echo e($product->title); ?></a>
                        </h5>
                        <div class="product-star">
                            <?php echo SM::product_review($product->id); ?>
                        </div>

                        <div class="content_price">
                            <?php if($product->sale_price > 0): ?>
                                <span class="price product-price">
                                    <?php echo e(SM::currency_price_value($product->sale_price)); ?></span>
                                <span
                                    class="price old-price"><?php echo e(SM::currency_price_value($product->regular_price)); ?></span>
                            <?php else: ?>
                                <span
                                    class="price product-price"><?php echo e(SM::currency_price_value($product->regular_price)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="info-orther">
                            <p>Item Code: #453217907</p>
                            <p class="availability">Availability: <span><?php echo e($product->in_stock); ?></span></p>
                            <div class="product-desc">
                                <?php echo e($product->short_description); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="alert alert-info"><i class="fa fa-info"></i> No Product Found!</div>
<?php endif; ?>
<div class="col-md-12" style="margin-top: 25px;">
    <?php echo $productLists->links(); ?>

</div>
