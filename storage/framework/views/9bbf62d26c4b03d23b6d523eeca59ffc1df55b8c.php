<?php
$product_best_sale_is_enable = SM::smGetThemeOption("product_best_sale_is_enable", 1);
$product_show_category = SM::smGetThemeOption("product_show_category", 1);
$product_show_tag = SM::smGetThemeOption("product_show_tag", 1);
$product_show_brand = SM::smGetThemeOption("product_show_brand", 1);
$product_show_size = SM::smGetThemeOption("product_show_size", 1);
$product_show_color = SM::smGetThemeOption("product_show_color", 1);
$product_detail_add = SM::smGetThemeOption("product_detail_add", 1);
?>
<div class="column col-xs-12 col-sm-3" id="left_column">
    <!-- block category -->
    <?php if($product_show_category==1): ?>
    <?php
    $getMainCategories = SM::getMainCategories(0);
    ?>
    <?php if(count($getMainCategories)>0): ?>
    <div class="block left-module">
        <p class="title_block">CATEGORIES</p>
        <div class="block_content">
            <!-- layered -->
            <div class="layered layered-category">
                <div class="layered-content">
                    <ul class="tree-menu">
                        <?php $__currentLoopData = $getMainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="active">
                            <span></span>
                            <a href="<?php echo url("category/".$cat->slug); ?>"><?php echo e($cat->title); ?></a>
                            <?php
                            $getSubCategories = \App\Model\Common\Category::where('parent_id', $cat->id)->get();
                            //                                            SM::getSubCategories($cat->id);
                            ?>
                            <?php if(empty(!$getSubCategories)): ?>
                            <ul>
                                <?php $__currentLoopData = $getSubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getSubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><span></span>
                                    <a href="<?php echo url("category/".$getSubCategory->slug); ?>"><?php echo e($getSubCategory->title); ?></a>
                                    <?php
                                    echo SM::category_tree_for_select_cat_id($getSubCategory->id);
                                    ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <!-- ./layered -->
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <!-- ./block category  -->
    <!-- block best sellers -->
    <?php if($product_best_sale_is_enable==1): ?>
    <?php
    $product_best_sale_per_page = SM::smGetThemeOption("product_best_sale_per_page", 6);
    $bestSaleProducts = SM::getBestSaleProduct($product_best_sale_per_page);
    //        var_dump($bestSaleProducts);
    //        exit();
    ?>
    <?php if(count($bestSaleProducts)>0): ?>
    <div class="block left-module">
        <p class="title_block">BEST SELLERS</p>
        <div class="block_content">
            <div class="owl-carousel owl-best-sell" data-loop="true" data-nav="false" data-margin="0"
                 data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause="true"
                 data-items="1">
                <?php $__currentLoopData = $bestSaleProducts->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="products-block best-sell">
                    <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($product->product_type == 2): ?>
                    <?php
                    $att_data = SM::getAttributeByProductId($product->id);
                    if (!empty($att_data->attribute_image)) {
                        $attribute_image = $att_data->attribute_image;
                    } else {
                        $attribute_image = $product->image;
                    }
                    ?>
                    <li>
                        <div class="products-block-left">
                            <a href="<?php echo e(url('product/'.$product->slug)); ?>">
                                <img src="<?php echo e(SM::sm_get_the_src($attribute_image, 75, 75)); ?>"
                                     alt="<?php echo e($product->title); ?>">
                            </a>
                        </div>
                        <div class="products-block-right">  
                            <p class="product-name">
                                <a href="<?php echo e(url('product/'.$product->slug)); ?>"><?php echo e($product->title); ?></a>
                            </p>
                            <p class="product-price"><?php echo e(SM::currency_price_value($att_data->attribute_price)); ?></p>
                            <p class="product-star">
                                <?php
                                echo SM::product_review($product->id);
                                ?>
                            </p>
                        </div>
                    </li>
                    <?php else: ?>
                    <li>
                        <div class="products-block-left">
                            <a href="<?php echo e(url('product/'.$product->slug)); ?>">
                                <img src="<?php echo e(SM::sm_get_the_src($product->image, 75, 75)); ?>"
                                     alt="<?php echo e($product->title); ?>">
                            </a>
                        </div>
                        <div class="products-block-right">
                            <p class="product-name">
                                <a href="<?php echo e(url('product/'.$product->slug)); ?>"><?php echo e($product->title); ?></a>
                            </p>
                            <?php if($product->sale_price>0): ?>
                            <p class="price product-price"> <?php echo e(SM::currency_price_value($product->sale_price)); ?></p>
                            <?php else: ?>
                            <p class="price product-price"><?php echo e(SM::currency_price_value($product->regular_price)); ?></p>
                            <?php endif; ?>
                            <p class="product-star">
                                <?php
                                echo SM::product_review($product->id);
                                ?>
                            </p>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- ./block best sellers  -->
    <?php endif; ?>
    <?php endif; ?>
    <?php
    $product_detail_add_link = SM::smGetThemeOption("product_detail_add_link", "#");
    $product_detail_add = SM::smGetThemeOption("product_detail_add");
    ?>
    <?php if(empty(!$product_detail_add)): ?>
    <div class="col-left-slide left-module">
        <div class="banner-opacity">
            <a href="<?php echo $product_detail_add_link; ?>">
                <img src="<?php echo SM::sm_get_the_src( $product_detail_add, 319,319 ); ?>" alt="ads-banner"
                     class="image-style"></a>
        </div>
    </div>
    <?php endif; ?>
    <!--./left silde-->
</div>