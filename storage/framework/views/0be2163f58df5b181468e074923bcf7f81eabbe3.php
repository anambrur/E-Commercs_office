<?php if (SM::check_this_method_access('media', 'upload')): ?>
<?php
$input_holder = isset($input_holder) ? $input_holder : 'image';
$input_name = isset($input_name) ? $input_name : 'image';
$img_holder = isset($img_holder) ? $img_holder : 'first_ph';
$input_holder_id = str_replace('[', '_', $input_holder);
$input_holder_id = str_replace(']', '', $input_holder_id);
?>
<div class="form-group" style="margin-bottom: 0px !important;">

    <div class="" id="<?php echo e($img_holder); ?>">
        <?php $image = isset($image) ? $image : '' ?>
        <img class="media_img" src="<?php echo e(SM::sm_get_the_src($image, 80, 80)); ?>" width="80px;"/>
    </div>
    <?php if($errors->has('image')): ?>
        <div class="sm-form has-error">
            <span class="help-block">
                <strong>The <?php echo e($header_name); ?> Image field is Required.</strong>
            </span>
        </div>
    <?php endif; ?>
</div>
<div class="form-group" style="margin-bottom: 0px !important;">
    
    <input type="hidden" name="<?php echo e($input_name); ?>" id="<?php echo e($input_holder_id); ?>" value="<?php echo e($image); ?>">
    <input input_holder="<?php echo e($input_holder_id); ?>" img_holder="<?php echo e($img_holder); ?>" is_multiple="0" media_width="165"
           type="button"
           class="btn btn-primary sm_media_modal_show" value="Upload File">

</div>
<?php endif; ?>