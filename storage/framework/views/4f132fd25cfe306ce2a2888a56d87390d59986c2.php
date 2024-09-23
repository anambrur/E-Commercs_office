<?php $__env->startSection("title", $categoryInfo->title); ?>
<?php $__env->startSection('content'); ?>
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
                        <img src="<?php echo e(SM::sm_get_the_src($categoryInfo->image, 1017, 336)); ?>"
                             alt="<?php echo e($categoryInfo->title); ?>">

                    </div>
                    <!-- ./category-slider -->
                    <!-- view-product-list-->
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <span class=""><?php echo e(count($categoryInfo->products)); ?> items found in Category:<?php echo e($categoryInfo->title); ?></span>
                        </h2>
                        <ul class="display-product-option" style="width: 63px;!important;">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul>
                        <!-- PRODUCT LIST -->
                        <ul class="row product-list grid " id="ajax_view_product_list">
                        <!--<?php echo $__env->make('frontend.products.product_list_item', ['productLists'=>$products], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>-->
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