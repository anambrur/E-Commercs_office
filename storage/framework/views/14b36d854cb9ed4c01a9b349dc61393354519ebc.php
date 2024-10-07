<?php $__env->startSection("title", "About"); ?>
<?php $__env->startSection('content'); ?>
    <!-- page wapper-->
    <?php
    $wwrTitle = SM::smGetThemeOption("wwr_title");
    $wwrSubtitle = SM::smGetThemeOption("wwr_subtitle");
    $wwrDescription = SM::smGetThemeOption("wwr_description");
    $ourMission = SM::smGetThemeOption("our_mission");
    $ourVision = SM::smGetThemeOption("our_vision");
    $histories = SM::smGetThemeOption("histories");
    $historiesCount = count($histories);
    $title = SM::smGetThemeOption("about_banner_title");
    $subtitle = SM::smGetThemeOption("about_banner_subtitle");
    $bannerImage = SM::smGetThemeOption("about_banner_image");
    ?>
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
        <?php echo $__env->make('frontend.common.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    <!-- block category -->
                    <?php if(count($pageInfo)>0): ?>
                        <div class="block left-module">
                            <p class="title_block">Infomations</p>
                            <div class="block_content">
                                <!-- layered -->
                                <div class="layered layered-category">
                                    <div class="layered-content">
                                        <ul class="tree-menu">
                                            <li class="active"><span></span><a href="<?php echo e(url('/about')); ?>">About Us</a>
                                            </li>
                                            <?php $__currentLoopData = $pageInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><span></span><a href="<?php echo e($page->slug); ?>"><?php echo e($page->page_title); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <li><span></span><a href="<?php echo e(url('/contact')); ?>">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- ./layered -->
                            </div>
                        </div>
                    <?php endif; ?>
                <!-- ./block category  -->
                    <?php
                    $about_page_add_link = SM::smGetThemeOption("about_page_add_link", "#");
                    $about_page_add = SM::smGetThemeOption("about_page_add");
                    ?>
                    <?php if(empty(!$about_page_add)): ?>
                    <!-- Banner silebar -->
                        <div class="block left-module">
                            <div class="banner-opacity">
                                <a href="<?php echo $about_page_add_link; ?>">
                                    <img src="<?php echo SM::sm_get_the_src( $about_page_add, 319,389 ); ?>"
                                         alt="ads-banner" class="image-style">
                                </a>
                            </div>
                        </div>
                        <!-- ./Banner silebar -->
                    <?php endif; ?>
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- page heading-->
                    <h2 class="page-heading">
                        <?php if(empty(!$title)): ?>
                            <span class="page-heading-title2"><?php echo e($title); ?></span>
                        <?php endif; ?>

                    </h2>
                    <!-- Content page -->
                    <div class="content-text clearfix">
                        <p><?php echo stripslashes($wwrDescription); ?></p>
                    </div>
                    <!-- ./Content page -->
                </div>
                <!-- ./ Center colunm -->
            </div>
            <!-- ./row-->
        </div>
    </div>
    <!-- ./page wapper-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>