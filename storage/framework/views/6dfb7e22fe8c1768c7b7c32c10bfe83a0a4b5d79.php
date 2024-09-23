<?php
$product_special_is_enable = SM::smGetThemeOption("product_special_is_enable", 1);
$product_show_category = SM::smGetThemeOption("product_show_category", 1);
$product_show_tag = SM::smGetThemeOption("product_show_tag", 1);
$product_show_brand = SM::smGetThemeOption("product_show_brand", 1);
$product_show_size = SM::smGetThemeOption("product_show_size", 1);
$product_show_color = SM::smGetThemeOption("product_show_color", 1);
$product_sidebar_add = SM::smGetThemeOption("product_sidebar_add", 1);
?>
<style>
    ul.sub-cat {
        margin-left: 20px;
    }
</style>
<div class="column col-xs-12 col-sm-3" id="left_column">
    <!-- block filter -->
    <div class="block left-module">
        <p class="title_block">Filter selection</p>
        <div class="block_content">
            <!-- layered -->
            <div class="layered layered-filter-price">
                <!-- filter categgory -->
                <?php if($product_show_category==1): ?>
                    <?php
                    $getProductCategories = SM::getProductCategories(0);
                    ?>
                    <?php if(count($getProductCategories)>0): ?>
                        <div class="layered_subtitle">CATEGORIES</div>
                        <div class="layered-content">
                            <ul class="check-box-list">
                                <?php $__currentLoopData = $getProductCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $segment = Request::segment(2);
                                    if ($segment == $cat->slug) {
                                        $selected = 'checked';
                                    } else {
                                        $selected = '';
                                    }

                                    $category_filter[] = $cat->id;
                                    $subcategory_id = \App\Model\Common\Category::where('parent_id', $cat->id)->get();
                                    $countProduct = $cat->total_products;;
                                    foreach ($subcategory_id as $item) {
                                        $category_filter[] = $item->id;
                                        $countProduct += $item->total_products;
                                    }
                                    ?>
                                    <li>
                                        <input <?php echo e($selected); ?> type="checkbox" id="c1_<?php echo e($cat->id); ?>"
                                               value="<?php echo e($cat->id); ?>"
                                               class="common_selector category"/>
                                        <label for="c1_<?php echo e($cat->id); ?>">
                                            <span class="button"></span>
                                            <?php echo e($cat->title); ?><span class="count">( <?php echo e($countProduct); ?> )</span>
                                        </label>
                                        <?php
                                        echo SM::category_tree_for_select_cat_id($cat->id, $segment);
                                        ?>
                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <!-- ./filter categgory -->
                <!-- filter price -->
                <?php
                $max_price = (int)\App\Model\Common\Product::max('regular_price');
                $min_price = (int)\App\Model\Common\Product::min('regular_price');
                ?>

                <div class="layered_subtitle">Price</div>
                <div class="layered-content slider-range">
                    <div data-label-reasult="Range:" data-min="<?php echo $min_price ?>"
                         data-max="<?php echo $max_price ?>"
                         data-unit="<?php echo e(SM::get_setting_value('currency')); ?>"
                         class="slider-range-price" data-value-min="<?php echo $min_price ?>"
                         data-value-max="<?php echo $max_price ?>">
                    </div>
                    <input type="hidden" id="hidden_minimum_price" value="<?php echo $min_price ?>"/>
                    <input type="hidden" id="hidden_maximum_price" value="<?php echo $max_price ?>"/>
                    <div class="amount-range-price">Range: <?php echo e(SM::product_price($min_price)); ?>

                        <?php echo e(SM::product_price($max_price)); ?>

                    </div>

                </div>
                <!-- ./filter price -->
                <!-- filter color -->
                <?php if($product_show_color==1): ?>
                    <?php
                    $getProductColors = SM::getProductColors(0);
                    ?>
                    <?php if(count($getProductColors)>0): ?>
                        <div class="layered_subtitle">Color</div>
                        <div class="layered-content filter-color">
                            <style>
                                /*                        .filter-color li label {
                                                             border: 1px solid #fff;
                                                             width: 20px;
                                                             height: 20px;
                                                             padding-top: 6px;
                                                             padding-left: 6px;
                                                            float: left;
                                                        }*/
                            </style>
                            <ul class="check-box-list">
                                <?php $__currentLoopData = $getProductColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input type="checkbox" id="color_<?php echo e($color->id); ?>" value="<?php echo e($color->id); ?>"
                                               class="common_selector color"/>
                                        <label style="" for="color_<?php echo e($color->id); ?>"><?php echo e($color->title); ?></label>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <!-- ./filter color -->
                <!-- ./filter brand -->
                <?php if($product_show_brand==1): ?>
                    <?php
                    $getProductBrands = SM::getProductBrands(0);
                    ?>
                    <?php if(count($getProductBrands)>0): ?>
                        <div class="layered_subtitle">brand</div>
                        <div class="layered-content filter-brand">
                            <ul class="check-box-list">
                                <?php $__currentLoopData = $getProductBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo e($brand->id); ?>" id="brand_<?php echo e($brand->id); ?>"
                                               class="common_selector brand"/>
                                        <label for="brand_<?php echo e($brand->id); ?>">
                                            <span class="button"></span>
                                            <?php echo e($brand->title); ?><span
                                                    class="count">( <?php echo e(count($brand->products )); ?>)</span>
                                        </label>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <!-- ./filter brand -->
                <!-- ./filter size -->
                <?php if($product_show_size==1): ?>
                    <?php
                    $getProductSizes = SM::getProductSizes(0);
                    ?>
                    <?php if(count($getProductSizes)>0): ?>
                        <div class="layered_subtitle">Size</div>
                        <div class="layered-content filter-size">
                            <ul class="check-box-list">
                                <?php $__currentLoopData = $getProductSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input type="checkbox" id="size_<?php echo e($size->id); ?>" value="<?php echo e($size->id); ?>"
                                               class="common_selector size"/>
                                        <label for="size_<?php echo e($size->id); ?>">
                                            <span class="button"></span><?php echo e($size->title); ?>

                                        </label>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- ./filter size -->
            </div>
            <!-- ./layered -->

        </div>
    </div>
    <!-- ./block filter  -->

    <!-- left silide -->
    <?php
    $product_sidebar_add_link = SM::smGetThemeOption("product_sidebar_add_link", "#");
    $product_sidebar_add = SM::smGetThemeOption("product_sidebar_add");
    ?>
    <?php if(empty(!$product_sidebar_add)): ?>

        <div class="col-left-slide left-module">
            <a href="<?php echo $product_sidebar_add_link; ?>">
                <img src="<?php echo SM::sm_get_the_src( $product_sidebar_add, 319,389 ); ?>" alt="slide-left">
            </a>
            <ul style="display: none;" class="owl-carousel owl-style2" data-loop="true" data-nav="false"
                data-margin="30"
                data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                data-autoplay="true">
                <li><a href="#"><img src="<?php echo e(asset('frontend/')); ?>/images/product/pi26.png" alt="slide-left"></a></li>
                <li><a href="#"><img src="<?php echo e(asset('frontend/')); ?>/images/product/pi25.png" alt="slide-left"></a></li>
                <li><a href="#"><img src="<?php echo e(asset('frontend/')); ?>/images/product/pi24.png" alt="slide-left"></a></li>
            </ul>
        </div>
    <?php endif; ?>
<!--./left silde-->
    <!-- SPECIAL -->
    <?php if($product_special_is_enable==1): ?>
        <?php
        $product_special_per_page = SM::smGetThemeOption("product_special_per_page", 1);
        $specialProducts = SM::getSpecialProduct($product_special_per_page);
        ?>
        <?php if(count($specialProducts)>0): ?>
            <div class="block left-module">
                <p class="title_block">SPECIAL PRODUCTS</p>
                <div class="block_content">
                    <ul class="products-block">
                        <?php $__currentLoopData = $specialProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($product->product_type==2): ?>
                                <?php
                                $att_data = $product->attributeProduct[0];
                                ?>
                                <li>
                                    <div class="products-block-left">
                                        <a href="<?php echo e(url('product/'.$product->slug)); ?>">
                                            <img src="<?php echo SM::sm_get_the_src( $att_data->attribute_image , 75, 75); ?>"
                                                 class="image-style"
                                                 alt="<?php echo e($product->title); ?>">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="<?php echo e(url('product/'.$product->slug)); ?>"><?php echo e($product->title); ?></a>
                                        </p>
                                        <div class="content_price">
                                            <p class="price product-price"> <?php echo e(SM::product_price($att_data->attribute_price)); ?></p>
                                        </div>
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
                                            <img src="<?php echo SM::sm_get_the_src( $product->image , 75, 75); ?>"
                                                 class="image-style"
                                                 alt="<?php echo e($product->title); ?>">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="<?php echo e(url('product/'.$product->slug)); ?>"><?php echo e($product->title); ?></a>
                                        </p>
                                        <div class="content_price">
                                            <?php if($product->sale_price>0): ?>
                                                <p class="price product-price"> <?php echo e(SM::product_price($product->sale_price)); ?></p>
                                            <?php else: ?>
                                                <p class="price product-price"><?php echo e(SM::product_price($product->regular_price)); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        
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
                    <div class="products-block">
                        <div class="products-block-bottom">
                            <a class="link-all" href="<?php echo e(url('/shop')); ?>">All Products</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<!-- ./SPECIAL -->
    <!-- TAGS -->
    <?php if($product_show_tag==1): ?>
        <?php
        $getTags = SM::getTags();
        ?>
        <?php if(count($getTags)>0): ?>
            <div class="block left-module">
                <p class="title_block">TAGS</p>
                <div class="block_content">
                    <div class="tags">
                        <?php $__currentLoopData = $getTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tag->title == ! ''): ?>
                                <a href="<?php echo url("tag/".$tag->slug); ?>"><span
                                            class="level2"><?php echo e($tag->title); ?></span></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<!-- ./TAGS -->
    <!-- Testimonials -->
    <?php
    $testimonialTitle = SM::smGetThemeOption("testimonial_title");
    $testimonials = SM::smGetThemeOption("testimonials");
    // $testimonialsCount = count($testimonials);
    ?>
    
    <?php if(!empty($testimonialsCount)): ?>
        <div class="block left-module">
            <p class="title_block"><?php echo e($testimonialTitle); ?></p>
            <div class="block_content">
                <ul class="testimonials owl-carousel" data-loop="true" data-nav="false" data-margin="30"
                    data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause="true"
                    data-items="1">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="client-mane">
                                <?php echo e($testimonial["title"]); ?>

                                
                            </div>
                            <div class="client-avarta">
                                <img src="<?php echo SM::sm_get_the_src($testimonial["testimonial_image"], 104, 104); ?>"
                                     alt="<?php echo e($testimonial["title"]); ?>">
                            </div>
                            <div class="testimonial">
                                <?php if(empty(!$testimonial["description"])): ?>
                                    <?php echo e($testimonial["description"]); ?>

                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
