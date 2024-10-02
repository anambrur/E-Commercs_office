<?php $__env->startSection("content"); ?>
    <?php if(isset($info->subject)): ?>
        <h1 style="font-weight: 500; font-size: 24px; color: #1d2d5d; line-height: 27px;"><?php echo e($info->subject); ?></h1>
    <?php endif; ?>
    <p style="margin: 0;">Message: <?php echo $info->message; ?></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("email.email_master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>