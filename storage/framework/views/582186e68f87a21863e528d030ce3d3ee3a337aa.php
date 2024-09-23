<?php $__env->startSection("title", $product->title); ?>
<?php $__env->startSection("content"); ?>
<?php $__env->startPush('style'); ?>
<style>
    .back-label {
        width: 30px;
        height: 30px;
        border-radius: 30px;
    }

    .qty-inc-dc {
        text-align: center;
        /*font-size: 13px;*/
        /*height: 41px;*/
        font-weight: bold;
        border: 1px solid #ededed;
    }
    .disable-size {
        pointer-events: none;
        /* background: blue; */
        color: #968585 !important;
    }
    .click_size {
        cursor: pointer;
    }
    span.out-stock {
        color: #fa110d;
        font-weight: 700;
    }
    span.in-stock {
    color: #009966;
}
</style>
<?php $__env->stopPush(); ?>

<!-- page wapper-->
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <?php echo $__env->make('frontend.common.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <?php echo $__env->make('frontend.products.product_detail_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- Product -->
                <div id="product">
                    <div class="primary-box row">
                        <div class="pb-left-column col-xs-12 col-sm-6">
                            <!-- product-imge-->
                            <div class="product-image">
                                <div class="product-full">
                                    <?php
                                    if (!empty($product->image_gallery)) {
                                        $myString = $product->image_gallery;
                                        $myArray = explode(',', $myString);
                                        ?>
                                        <img id="product-zoom"
                                             src="<?php echo SM::sm_get_the_src( $myArray[0] , 500, 500); ?>"
                                             data-zoom-image="<?php echo SM::sm_get_the_src( $myArray[0] , 1000, 1000); ?>"
                                             class="image-style" alt="<?php echo e($product->title); ?>">
                                         <?php } else { ?>
                                        <?php if(empty(!$product->image)): ?>
                                        <img id="product-zoom"
                                             src="<?php echo SM::sm_get_the_src( $product->image , 500, 500); ?>"
                                             data-zoom-image="<?php echo SM::sm_get_the_src( $product->image , 1000, 1000); ?>"
                                             class="image-style" alt="<?php echo e($product->title); ?>">
                                        <?php endif; ?>
                                    <?php } ?>
                                </div>
                                <?php if(empty(!$product->image_gallery)): ?>
                                <div class="product-img-thumb" id="gallery_01">
                                    <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false"
                                        data-margin="20" data-loop="true">
                                            <?php
                                            $myString = $product->image_gallery;
                                            $myArray = explode(',', $myString);
                                            ?>
                                        <?php $__currentLoopData = $myArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="#"
                                               data-image="<?php echo SM::sm_get_the_src( $v_data, 500, 500); ?>"
                                               data-zoom-image="<?php echo SM::sm_get_the_src( $v_data , 1000, 1000); ?>">
                                                <img alt="<?php echo e($product->title); ?>" id="product-zoom"
                                                     src="<?php echo SM::sm_get_the_src( $v_data, 103, 125); ?>"/>
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- product-imge-->
                        </div>
                        <div class="pb-right-column col-xs-12 col-sm-6">
                            <h1 class="product-name"><?php echo e($product->title); ?></h1>
                            <div class="product-comments">
                                <div class="product-star">
                                    <?php
                                    echo SM::product_review($product->id);
                                    ?>
                                </div>
                            </div>
                            <?php
                            $discount = 0;
                            ?>
                            <div class="product-price-group">
                                <?php if ($product->product_type == 2) { ?>
                                    <span class="price product_price"></span>
                                <?php } else {
                                    ?>
                                    <?php if($product->sale_price>0): ?>
                                    <?php
                                    $value = $product->regular_price - $product->sale_price;
                                    $discount = $value * 100 / $product->regular_price;
                                    ?>
                                    <span class="price product-price"><?php echo e(SM::currency_price_value($product->sale_price)); ?></span>
                                    <span class="old-price "><?php echo e(SM::currency_price_value($product->regular_price)); ?></span>
                                    <?php echo Form::hidden('price',$product->sale_price, ['class' => 'price']); ?>

                                    <?php else: ?>
                                    <span class="price product-price"><?php echo e(SM::currency_price_value($product->regular_price)); ?></span>
                                    <?php echo Form::hidden('price',$product->regular_price, ['class' => 'price']); ?>

                                    <?php endif; ?>
                                    <?php if($discount>0): ?>
                                    <span class="discount">-<?php echo e(ceil($discount)); ?>%</span>
                                    <?php endif; ?>
                                <?php } ?>
                            </div>
                            <div class="info-orther">
                                <p>SKU: <?php echo e($product->sku); ?></p>
                                <p>Availability: 
                                    <?php
                                    if ($product->product_qty > 0) {
                                        ?>
                                        <span class="in-stock"><?php echo e($product->stock_status); ?></span>
                                    <?php } else { ?>
                                        <span class="out-stock">Stock Out</span>
                                    <style>
                                        .addToCart {
                                            pointer-events: none;
                                            background: #d1b5b5;
                                        }
                                    </style>
                                <?php } ?>


                                </p>
                                
                            </div>
                            <?php if(!empty($product->short_description)): ?>
                            <div class="product-desc">
                                <?php echo $product->short_description; ?>

                            </div>
                            <?php endif; ?>
                            <?php
                            $item = Cart::instance('cart')->content()->where('id', $product->id)->first();
                            ?>
                            <div class="form-option">
                                <?php if ($product->product_type == 2) { ?>
                                    
                                    <?php echo $__env->make('frontend.products.product_attribute', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    
                                <?php } ?>
                                <div class="attributes">
                                    <div class="attribute-label">Qty:</div>

                                    <div class="sinolo">
                                        <?php if(!empty($item)): ?>
                                        <a onclick="var less = parseInt($('.up_qty').val()) - 1; $('.up_qty').val(less);" data-row_id="<?php echo e($item->rowId); ?>"class="decDetail btn btn-default btn-sm"><i class="fa fa-minus"></i>
                                        </a>
                                        <input type="text" value="<?php echo e($item->qty); ?>" class="qty-inc-dc up_qty"
                                               id="<?php echo e($item->rowId); ?>">
                                        <a onclick="var add = parseInt($('.up_qty').val()) + 1; $('.up_qty').val(add);"
                                           data-row_id="<?php echo e($item->rowId); ?>"
                                           class="incDetail btn btn-default btn-sm"><i class="fa fa-plus"></i>
                                        </a>
                                        <?php else: ?>
                                        <a onclick="var less = parseInt($('#qty').val()) - 1; $('#qty').val(less);"
                                           id="" class="btn btn-default btn-sm"><i
                                                class="fa fa-minus"></i> </a>
                                        <input type="text" value="1" class="productCartQty qty-inc-dc" id="qty">
                                        <a onclick="var add = parseInt($('#qty').val()) + 1; $('#qty').val(add);"
                                           id="" class="btn btn-default btn-sm"><i
                                                class="fa fa-plus"></i> </a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                            <div class="form-action">
                                <div class="button-group add-to-cart">
                                    <button data-add_class=" btn-add-cart" data-product_id="<?php echo e($product->id); ?>"
                                            data-regular_price="<?php echo e($product->regular_price); ?>"
                                            data-sale_price="<?php echo e($product->sale_price); ?>"
                                            class="addToCart btn-add-cart"
                                            title="add To Cart">Add To Cart
                                    </button>

                                </div>
                                <div class="button-group">
                                    <?php
                                    echo SM::wishlistHtml($product->id);
                                    ?>
                                    <?php
                                    echo SM::compareHtml($product->id);
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- tab product -->
                    <div class="product-tab">
                        <ul class="nav-tab">
                            <li class="active">
                                <a aria-expanded="false" data-toggle="tab" href="#product-detail">Product
                                    Details</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews">reviews</a>
                            </li>
                        </ul>
                        <div class="tab-container">
                            <div id="product-detail" class="tab-panel active">
                                <?php echo $product->long_description; ?>

                            </div>
                            <?php echo $__env->make('frontend.products.product_review', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                    <!-- ./tab product -->
                    <!-- related product -->
                    <?php echo $__env->make('frontend.products.related_products', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- ./related product -->

                </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<!-- ./page wapper-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>