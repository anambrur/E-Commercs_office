<?php if(count($relatedProduct) > 0): ?>
    <div class="page-product-box">
        <h3 class="heading">Related Products</h3>
        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav="true"
            data-margin="30" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
            <?php $__currentLoopData = $relatedProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rProductSingle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="product-container">
                        <div class="left-block">
                            <a href="<?php echo e(url('product/'.$rProductSingle->slug)); ?>">
                                <img class="img-responsive" alt="<?php echo e($rProductSingle->title); ?>"
                                     src="<?php echo SM::sm_get_the_src( $rProductSingle->image , 297, 297); ?>"/>
                            </a>
                            <div class="quick-view">
                                <?php echo SM::quickViewHtml($rProductSingle->id, $rProductSingle->slug);?>

                            </div>
                            <div class="add-to-cart">
                                <?php echo SM::addToCartButton($rProductSingle->id, $rProductSingle->regular_price, $rProductSingle->sale_price);?>

                            </div>
                            <?php if($rProductSingle->sale_price>0): ?>
                                <div class="price-percent-reduction2">
                                    <?php echo e(SM::productDiscount($rProductSingle->id)); ?>% OFF
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a
                                        href="<?php echo e(url('product/'.$rProductSingle->slug)); ?>"><?php echo e($rProductSingle->title); ?></a>
                            </h5>
                            <div class="product-star">
                                <?php echo SM::product_review($rProductSingle->id); ?>
                            </div>
                            <div class="content_price">
                                <?php if($rProductSingle->sale_price>0): ?>
                                    <span class="price product-price"><?php echo e(SM::product_price($rProductSingle->sale_price)); ?></span>
                                    <span class="price old-price"><?php echo e(SM::product_price($rProductSingle->regular_price)); ?></span>
                                <?php else: ?>
                                    <span class="price product-price"><?php echo e(SM::product_price($rProductSingle->regular_price)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>