<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-add-category-main" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <!-- widget options:
           usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

           data-widget-colorbutton="false"
           data-widget-editbutton="false"
           data-widget-togglebutton="false"
           data-widget-deletebutton="false"
           data-widget-fullscreenbutton="false"
           data-widget-custombutton="false"
           data-widget-collapsed="true"
           data-widget-sortable="false"

        -->
        <header>
            <span class="widget-icon"> <i class="fa fa-building"></i> </span>
            <h2><?php echo e($f_name); ?> Page</h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body padding-10">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="sm-form<?php echo e($errors->has('menu_title') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('menu_title','Menu Title'); ?>

                            <?php echo Form::text('menu_title', null,['required'=>'','class'=>'form-control', 'placeholder'=>'Write your menu title here']); ?>

                            <?php if($errors->has('menu_title')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('menu_title')); ?></strong>
                                 </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php echo $__env->make("nptl-admin.common.common.title_n_slug", ['isEnabledSlug'=>true, 'table'=>'pages', 'name'=>'page_title'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <div class="col-sm-12">
                        <div class="sm-form<?php echo e($errors->has('page_subtitle') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('page_subtitle','Page Subtitle'); ?>

                            <?php echo Form::text('page_subtitle', null,['class'=>'form-control', 'placeholder'=>'Write your page subtitle here']); ?>

                            <?php if($errors->has('page_subtitle')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('page_subtitle')); ?></strong>
                                 </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group<?php echo e($errors->has('content') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('content','Page Content'); ?>

                            <?php echo Form::textarea('content', null,['class'=>'form-control ckeditor']); ?>

                            <?php if($errors->has('content')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('content')); ?></strong>
                                 </span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-category-publish" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-save"></i> </span>
            <h2>Page Publish</h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body padding-10">
				<?php
				$permission = SM::current_user_permission_array();
				if (SM::is_admin() || isset( $permission ) && isset( $permission['page']['page_status_update'] ) && $permission['page']['page_status_update'] == 1)
				{
				?>
                <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('status', 'Publication Status'); ?>

                    <?php echo Form::select('status',['1'=>'Publish','2'=>'Pending / Draft', '3'=>'Cancel'],null,['required'=>'','class'=>'form-control']); ?>

                    <?php if($errors->has('status')): ?>
                        <span class="help-block">
                             <strong><?php echo e($errors->first('status')); ?></strong>
                          </span>
                    <?php endif; ?>
                </div>
				<?php
				}
				?>
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="fa fa-save"></i>
                        <?php echo e($btn_name); ?> Page
                    </button>
                </div>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-banner-info" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-list"></i> </span>
            <h2>Banner Info</h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body padding-10">
                <div class="sm-form<?php echo e($errors->has('banner_title') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('banner_title','Banner Title'); ?>

                    <?php echo Form::text('banner_title', null,['class'=>'form-control', 'placeholder'=>'Write your banner title here']); ?>

                    <?php if($errors->has('banner_title')): ?>
                        <span class="help-block">
                                    <strong><?php echo e($errors->first('banner_title')); ?></strong>
                                 </span>
                    <?php endif; ?>
                </div>
                <div class="sm-form<?php echo e($errors->has('banner_subtitle') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('banner_subtitle','Banner Subtitle'); ?>

                    <?php echo Form::text('banner_subtitle', null,['class'=>'form-control', 'placeholder'=>'Write your banner subtitle here']); ?>

                    <?php if($errors->has('banner_subtitle')): ?>
                        <span class="help-block">
                                    <strong><?php echo e($errors->first('banner_subtitle')); ?></strong>
                                 </span>
                    <?php endif; ?>
                </div>
            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->

<?php
if ( old( 'banner_image' ) ) {
	$image = old( 'banner_image' );
} elseif ( isset( $page_info->banner_image ) ) {
	$image = $page_info->banner_image;
} else {
	$image = '';
}
?>
<?php echo $__env->make('nptl-admin/common/common/image_form',['header_name'=>'Page Banner',
'image'=>$image], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('nptl-admin/common/common/meta_info',['header_name'=>'Page',
'width'=>'col-lg-12'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>