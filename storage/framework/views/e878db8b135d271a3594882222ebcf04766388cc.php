<?php $__env->startSection('title', 'Shop'); ?>
<?php $__env->startSection('content'); ?>
    <?php
    $countStickyPost = count($stickyProductPost);
    $isBreadcrumbEnable = SM::smGetThemeOption("product_is_breadcrumb_enable", false);

    $pagination = [
        [
            "title" => "Product"
        ]
    ];
    $title = SM::smGetThemeOption("product_banner_title");
    $subtitle = SM::smGetThemeOption("product_banner_subtitle");
    $bannerImage = SM::smGetThemeOption("product_banner_image");
    ?>
    <?php $__env->startPush('style'); ?>
        <style>
            #loading {
                text-align: center;
                background: url('loader.gif') no-repeat center;
                height: 150px;
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
            <?php echo $__env->make('frontend.products.product_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- category-slider -->
                    <div class="category-slider">
                        <img src="<?php echo e(SM::sm_get_the_src($bannerImage, 1017, 336)); ?>"
                             alt="<?php echo e($title); ?>">
                    </div>
                    <!-- ./category-slider -->
                    <!-- view-product-list-->
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <span class="page-heading-title"><?php echo e($title); ?></span>
                        </h2>
                        <ul class="display-product-option" style="width: 253px !important;">
                            <li>
                                <div class="sortPagiBar">
<!--                                    <div class="show-product-item">
                                        <select name="common_selector limitProduct" class="common_selector limitProduct">
                                            <option >select</option>
                                            <option value="10">Show 10</option>
                                            <option value="18">Show 18</option>
                                            <option value="20">Show 20</option>
                                            <option value="50">Show 50</option>
                                            <option value="100">Show 100</option>
                                        </select>
                                    </div>-->
                                    <div class="sort-product">
                                        <select name="common_selector orderByPrice" class="common_selector orderByPrice">
                                            <option value="">Popularity</option>
                                            <option value="1">Price low to high</option>
                                            <option value="2">Price high to low</option>
                                        </select>
                                        <div class="sort-product-icon">
                                            <i class="fa fa-sort-alpha-asc"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>

                        </ul>

                        <!-- PRODUCT LIST -->
                        
                        
                        
                        <ul class="row product-list grid " id="ajax_view_product_list">
                            <!--<?php echo $__env->make('frontend.products.product_list_item', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>-->
                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->

                </div>
                <!-- ./ Center colunm -->
            </div>
            <!-- ./row-->
        </div>
    </div>

    <!-- ./page wapper-->
    <?php $__env->startPush('script'); ?>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>