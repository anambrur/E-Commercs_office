<?php if(!isset($width)): ?>
	<?php $width = "col-md-8 col-lg-8"; ?>
<?php endif; ?>
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 <?php echo e($width); ?>">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-add-prod-seo" data-widget-editbutton="false" data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
            <h2><?php echo e($header_name); ?> SEO (Meta Information)</h2>

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
                    <div class="col-md-4">
                        <div class="form-group<?php echo e($errors->has('seo_title') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('seo_title','SEO Title'); ?>

                            <?php echo Form::textarea('seo_title', null,['class'=>'form-control', 'placeholder'=>'Write your seo title here', 'rows'=>4]); ?>

                            <p class="red"><span id="seo_title_length">70</span> characters left!</p>
                            <?php if($errors->has('seo_title')): ?>
                                <span class="help-block">
                                      <strong><?php echo e($errors->first('seo_title')); ?></strong>
                                   </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group<?php echo e($errors->has('meta_key') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('meta_key','Meta Keywords'); ?>

                            <?php echo Form::textarea('meta_key', null,['class'=>'form-control', 'placeholder'=>'Write your Meta keywords here', 'rows'=>4]); ?>

                            <?php if($errors->has('meta_key')): ?>
                                <span class="help-block">
                                  <strong><?php echo e($errors->first('meta_key')); ?></strong>
                               </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group<?php echo e($errors->has('meta_description') ? ' has-error' : ''); ?>">
                            <?php echo Form::label('meta_description','Meta Description'); ?>

                            <?php echo Form::textarea('meta_description', null,['class'=>'form-control', 'placeholder'=>'Write your Meta Description here', 'rows'=>4]); ?>

                            <p class="red"><span id="meta_description_length">215</span> characters left!</p>
                            <?php if($errors->has('meta_description')): ?>
                                <span class="help-block">
                                  <strong><?php echo e($errors->first('meta_description')); ?></strong>
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