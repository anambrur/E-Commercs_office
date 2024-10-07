<?php $__env->startSection("title",$page->page_title); ?>
<?php $__env->startSection("content"); ?>
    <!--CONTACT FORM START-->
    <!--BREADCRUMB START-->
    <section class="page-banner-section contact-banner-section">
        <div class="blog-banner-sec "
             style="background:url( <?php echo SM::sm_get_the_src( $page->banner_image ); ?>) no-repeat center center /cover">
            <div class="container">
                <div class="row">
                    <div class="blog-banner-contents text-center">
                        <?php if(empty(!$page->banner_title)): ?>
                            <h1><?php echo e($page->banner_title); ?></h1>
                        <?php endif; ?>
                        <?php if(isset($page->banner_subtitle) && $page->banner_subtitle != ''): ?>
                            <p><?php echo e($page->banner_subtitle); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="terms-privacy-policy">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sm-content">
						<?php echo stripslashes( $page->content ) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>