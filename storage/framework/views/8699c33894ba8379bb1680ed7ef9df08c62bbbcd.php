<?php
/**
 * Created by PhpStorm.
 * User: mrksohag
 * Date: 10/30/17
 * Time: 12:28 PM
 */
?>


<?php $__env->startSection('title','Login'); ?>

<?php $__env->startSection('reff_page_link'); ?>
    <span id="extr-page-header-space"> <span class="hidden-mobile">Need an account?</span> <a href="<?php echo e(url(config('constant.smAdminSlug').'/register')); ?>" class="btn btn-danger">Create account</a> </span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="well no-padding">
        <form class="smart-form client-form" id="login-form" role="form" method="POST" action="<?php echo e(url(config('constant.smAdminSlug').'/login')); ?>">
            <?php echo csrf_field(); ?>


            <header>
                Sign In
            </header>

            <fieldset>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <?php if(Session::has('w_message')): ?>
                    <div class="warning">
                        <?php echo Session::get('w_message'); ?>

                    </div>
                <?php endif; ?>
                <?php if(Session::has('s_message')): ?>
                    <div class="success">
                        <i class="fa fa-check"></i> <?php echo Session::get('s_message'); ?>

                    </div>
                <?php endif; ?>
                <section>
                    <label class="label">Username / E-mail</label>
                    <label class="input <?php echo e($errors->has('email') ? ' state-error' : ''); ?>"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="email" value="<?php echo e(old('email')); ?>">
                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                    <?php if($errors->has('email')): ?>
                        <em class="invalid" for="email"><?php echo e($errors->first('email')); ?></em>
                    <?php endif; ?>
                </section>

                <section>
                    <label class="label">Password</label>
                    <label class="input <?php echo e($errors->has('password') ? ' state-error' : ''); ?>"> <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password">
                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                    <?php if($errors->has('password')): ?>
                        <em class="invalid" for="password">Please enter your password</em>
                    <?php endif; ?>
                    <div class="note">
                        <a href="<?php echo e(url(config('constant.smAdminSlug').'/password/reset')); ?>">Forgot password?</a>
                    </div>
                </section>

                <section>
                    <label class="checkbox">
                        <input type="checkbox" name="remember" checked="">
                        <i></i>Stay signed in</label>
                </section>
            </fieldset>
            <footer>
                <button type="submit" class="btn btn-primary">
                    Sign in
                </button>
            </footer>
        </form>

    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('validation_script'); ?>
    <script type="text/javascript">
        runAllForms();
        $(function () {
// Validation
            $("#login-form").validate({
// Rules for form validation
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    }
                },
// Messages for form validation
                messages: {
                    email: {
                        required: 'Please enter your email address or username'
                    },
                    password: {
                        required: 'Please enter your password'
                    }
                },
// Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('nptl-admin/Auth/AuthLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>