<?php
/**
 * Created by PhpStorm.
 * User: mrksohag
 * Date: 10/26/17
 * Time: 4:43 PM
 */
$name=(isset($name) && $name != '') ? trim($name) : 'title';
?>
<div class="sm-title-section ">
    <div class="sm-form <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
        <?php echo e(Form::label('title', 'Title', array('class' => 'requiredStar'))); ?>

        
        <?php echo Form::text($name, null, ['id'=>'title','required'=>'', 'data-table'=>$table, 'class'=>'form-control', 'placeholder'=>__("common.title")]); ?>

        <?php echo Form::hidden('id', null, ['id'=>'current_info_id']); ?>

        <?php if($errors->has('title')): ?>
            <span class="help-block">
            <strong><?php echo e($errors->first('title')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <?php if($isEnabledSlug): ?>
        <div class="sm-form<?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
            <?php echo Form::label('slug', "URL Slug"); ?>

            <?php echo Form::text('slug', null, ['required'=>'','data-table'=>$table, 'class'=>'form-control', 'placeholder'=>"Customize your slug or make it default."]); ?>

            <?php if($errors->has('slug')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('slug')); ?></strong>
            </span>
            <?php endif; ?>
            <span style="color: #999;">After changing the title or slug a unique slug will automatically generate.</span>
        </div>
    <?php endif; ?>
</div>