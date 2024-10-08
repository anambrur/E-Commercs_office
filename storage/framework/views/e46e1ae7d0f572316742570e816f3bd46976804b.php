<?php $__env->startSection("content"); ?>
    <h1 style="font-weight: 500; font-size: 24px; color: #1d2d5d; line-height: 27px;">
        Contact Mail from <?php echo e($contact->fullname); ?></h1>
    <p style="margin: 0;">Subject : <?php echo $contact->subject; ?></p>
    <p style="margin: 0;">Email : <?php echo $contact->email; ?></p>
    <p style="margin: 0;">Message: <?php echo $contact->message; ?></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("email.email_master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>