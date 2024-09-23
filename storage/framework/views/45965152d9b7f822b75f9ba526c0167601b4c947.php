<?php
$countFiles = count($files);
$smPaginationMedia = config("constant.smPaginationMedia");
?>
<div>

    <input type="text" class="form-control media_search pull-left" style="width: 200px;" placeholder="Search...">
    Total Media = <strong><span class="" id="media_count"><?php echo e($countFiles); ?></span></strong>
</div>
<div class="row">
    <!-- SuperBox -->
    <div class="superbox col-sm-12 media_search_data">
        <?php if($countFiles>0): ?>
            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $filename = $file->slug;
                $img = \App\SM\SM::sm_get_galary_src_data_img($filename, $file->is_private == 1 ? true : false);
                $src = $img['src'];
                $data_img = $img['data_img'];
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                ?>
                <div class="superbox-list sm_file_<?php echo e($file->id); ?>">
                    <?php if($file->is_private == 1): ?>
                        <span class="private_media" title="Private File"><i class="fa fa-lock"></i></span>
                    <?php endif; ?>
                    <img title="<?php echo e($file->title); ?>" src="<?php echo e($src); ?>" data-img="<?php echo e($data_img); ?>" img_id="<?php echo e($file->id); ?>"
                         is_private="<?php echo e($file->is_private); ?>"
                         img_slug="<?php echo e($filename); ?>" alt="<?php echo e($file->alt); ?>"
                         ftype="<?php echo e($extension); ?>"
                         caption="<?php echo e($file->caption); ?>" description="<?php echo e($file->description); ?>"
                         class="superbox-img">
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-warning fade in">
                <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                <i class="fa-fw fa fa-warning"></i>
                <strong><?php echo e(__("media.warning")); ?></strong>
                <?php echo e(__("media.noMediaFileFound")); ?>

            </div>
        <?php endif; ?>
        <div class="superbox-float"></div>
    </div>
    <div class="col-sm-12 text-center" style="<?php echo e($countFiles >= $smPaginationMedia ? '': 'display:none;'); ?>">
        <button class="btn btn-block btn-primary" id="sm_media_load_more"
                data-need_to_load="<?php echo e($smPaginationMedia); ?>"
                data-loaded="<?php echo e($countFiles); ?>"><i class="fa fa-refresh"></i> Load More
        </button>
    </div>
    <!-- /SuperBox -->
    <div class="superbox-show" style="height:300px; display: none">
    </div>
</div>
<?php $__env->startSection('footer_script'); ?>
    <script type="text/javascript">
        $('.media_search').on('keyup', function () {
            var search = $(this).val();
            $.ajax({
                type: 'get',
                url: '<?php echo e(URL::route('media_search')); ?>',
                data: {'search': search},
                success: function (data) {
                    $('.media_search_data').html(data.media_output_data);
                    $('#media_count').html(data.total_media_data);
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>
