<?php $__env->startSection('title','Menus'); ?>
<?php $__env->startSection('content'); ?>
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-6">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-list-of-pages-link"
                 data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false"
                 data-widget-fullscreenbutton="false" data-widget-collapsed="false">
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
                    <span class="widget-icon"> <i class="fa fa-pagelines"></i> </span>
                    <h2 class="font-md"><strong>List of Links</strong></h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <div class="col-sm-12 col-lg-12">

                            <div class="row">


                                <div class="panel-group smart-accordion-default" id="accordion-2">



                                    <!---  Page Menu Accordion  -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion-2"
                                                   href="#acc_pages">
                                                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                    Pages </a>
                                            </h4>
                                        </div>
                                        <div id="acc_pages" class="panel-collapse collapse in">
                                            <div class="panel-body">

                                                <div class="smart-form add_custom_menu" id="add_page_div">
                                                    <?php $i = 2; ?>
                                                    <?php if(isset($pages) && count($pages)>0): ?>
                                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox"
                                                               value="<?php echo e($i); ?>">
                                                        <i></i>
                                                        <input type="hidden" id="page_checkbox_<?php echo e($i); ?>"
                                                               value="/page/<?php echo e($page->slug); ?>"
                                                               menu_title="<?php echo e($page->menu_title); ?>"
                                                               menu_type="page">
                                                        <?php echo e($page->menu_title); ?>

                                                    </label>
                                                    <?php $i ++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <?php endif; ?>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-sm btn-primary add_posts_menu_button"><i class="fa fa-plus"></i> Add
                                                        Menu</a>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                             <!---  Package Menu Accordion  -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion-2"
                                                   href="#acc_categories" class="collapsed">
                                                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                    Categories </a>
                                            </h4>
                                        </div>
                                        <div id="acc_categories" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div class="smart-form add_custom_menu" id="add_package_div">
                                                    <?php if(isset($categories) && count($categories)>0): ?>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox"
                                                               value="<?php echo e($i); ?>">
                                                        <i></i>
                                                        <input type="hidden" id="page_checkbox_<?php echo e($i); ?>"
                                                               value="/category/<?php echo e($category->slug); ?>"
                                                               menu_title="<?php echo e($category->title); ?>"
                                                               menu_type="category|<?php echo e($category->id); ?>">
                                                        <?php echo e($category->title); ?>

                                                    </label>
                                                    <?php $i ++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <?php endif; ?>

                                                    <a href="javascript:void(0)"
                                                       class="btn btn-sm btn-primary add_posts_menu_button"><i class="fa fa-plus"></i> Add
                                                        Menu</a>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>
                                       
                                    </div>



                                    <!---  Custom Menu Accordion  -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion-2"
                                                   href="#acc_cutom_menu" class="collapsed">
                                                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                    Custom Menu</a>
                                            </h4>
                                        </div>
                                        <div id="acc_cutom_menu" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div class="smart-form add_custom_menu">
                                                    <label class="input">
                                                        <i class="icon-prepend fa fa-navicon" title="Title"></i>
                                                        <input type="text" id="add_custom_menu_title"
                                                               placeholder="Menu title" class="form-control">
                                                    </label>
                                                    <label class="input">
                                                        <i class="icon-prepend fa fa-link" title="URL"></i>
                                                        <input type="text" id="add_custom_menu_link"
                                                               placeholder="Url like http://nextpagetl.com"
                                                               class="form-control">
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <a href="javascript:void(0)" id="add_custom_menu_button"
                                                       class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add
                                                        Menu</a>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>

                                            </div>
                                        </div>


                                    </div>



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
        <article class="col-sm-6">


            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-main_menu" data-widget-editbutton="false"
                 data-widget-colorbutton="false" data-widget-deletebutton="false"
                 data-widget-fullscreenbutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-navicon"></i> </span>
                    <h2 class="font-md"><strong>Main Menu</strong></h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="dd ddm" id="nestable_main_menu">
                                    <ol class="dd-list">
                                        <?php
                                        $loop = 0;
                                        if (isset($main_menu['menu_item']) && count($main_menu['menu_item']) > 0) {
                                            $main_menu = $main_menu['menu_item'];
                                            foreach ($main_menu as $item) {
                                                if (isset($item['p_id']) && $item['p_id'] == 0) {
                                                    $loop ++;
                                                    $p_id = isset($item['p_id']) ? $item['p_id'] : 0;
                                                    $menu_type = isset($item['menu_type']) ? $item['menu_type'] : '';
                                                    $title = isset($item['title']) ? $item['title'] : '';
                                                    $link = isset($item['link']) ? $item['link'] : '';
                                                    $cls = isset($item['cls']) ? $item['cls'] : '';
                                                    $link_cls = isset($item['link_cls']) ? $item['link_cls'] : '';
                                                    $icon_cls = isset($item['icon_cls']) ? $item['icon_cls'] : '';
                                                    ?>
                                                    <li class="dd-item li_<?php echo e($loop); ?>" data-id="<?php echo e($loop); ?>">
                                                        <input class="id" value="<?php echo e($loop); ?>" type="hidden"
                                                               name="menu_item[<?php echo e($loop); ?>][id]">
                                                        <input class="p_id" value="<?php echo e($p_id); ?>" type="hidden"
                                                               name="menu_item[<?php echo e($loop); ?>][p_id]">
                                                        <input class="menu_type" value="<?php echo e($menu_type); ?>"
                                                               name="menu_item[<?php echo e($loop); ?>][menu_type]" type="hidden">
                                                        <div class="dd-handle dd3-handle">
                                                            &nbsp;
                                                        </div>
                                                        <div class="dd3-content">
                                                            <span class="menu_content_title_display"><?php echo e($title); ?></span>
                                                            <span class="pull-right show_menu_content"><i
                                                                    class="fa fa-chevron-down"></i></span>
                                                        </div>
                                                        <div class="menu_content smart-form">
                                                            <label class="input">
                                                                <i class="icon-append fa fa-navicon"
                                                                   title="Add your Title here"></i>
                                                                <input class="form-control menu_content_title title"
                                                                       value="<?php echo e($title); ?>" name="menu_item[<?php echo e($loop); ?>][title]"
                                                                       type="text" placeholder="Menu title">
                                                            </label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-link"
                                                                   title="Add your Link here"></i>
                                                                <input class="form-control link" value="<?php echo e($link); ?>" type="url"
                                                                       name="menu_item[<?php echo e($loop); ?>][link]"
                                                                       placeholder="Url like http://nextpagetl.com">
                                                            </label>
                                                            <label class="input">
                                                                <i class="icon-append" title="Add your Link Wrapper Class here">Cls</i>
                                                                <input class="form-control cls" value="<?php echo e($cls); ?>" type="text"
                                                                       name="menu_item[<?php echo e($loop); ?>][cls]"
                                                                       placeholder="Add your Link Wrapper class here like home, smddtech">
                                                            </label>
                                                            <label class="input">
                                                                <i class="icon-append" title="Add your Link Class here">Cls</i>
                                                                <input class="form-control link_cls" value="<?php echo e($link_cls); ?>"
                                                                       type="text" name="menu_item[<?php echo e($loop); ?>][link_cls]"
                                                                       placeholder="Add your Link class here like home, smddtech">
                                                            </label>
                                                            <label class="input">
                                                                <i class="icon-append" title="Add your Icon Class here">Cls</i>
                                                                <input class="form-control icon_cls" value="<?php echo e($icon_cls); ?>"
                                                                       type="text" name="menu_item[<?php echo e($loop); ?>][icon_cls]"
                                                                       placeholder="Add your Icon class here like fa fa-plus-square">
                                                            </label>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-sm btn-danger menu_remove"><i
                                                                    class="fa fa-minus"></i> Remove menu</a>
                                                            <a href="javascript:void(0)"
                                                               class="pull-right btn btn-sm btn-warning menu_cancel"><i
                                                                    class="fa fa-reply"></i> Cancel</a>
                                                        </div>
                                                        <?php
                                                        $child = SM::get_children_menu_backend($main_menu, $item['id'], $loop);
                                                        if ($child['data'] != '') {
                                                            echo "\n\n\n" . '<ol class="dd-list">' . "\n";
                                                            echo $child['data'];
                                                            echo '</ol>' . "\n\n\n";
                                                            $loop = (int) $child['loop'];
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </ol>
                                </div>
                                <input type="hidden" name="menu_item_count" value="<?php echo e($loop); ?>" id="menu_item_count">
                                <div class="clearfix"></div>
                                <br>
                                <a href="<?php echo config('constant.smAdminSlug'); ?>/save_menu" id="save_menu"
                                   class="btn btn-primary"><i class="fa fa-save"></i> Save menu</a>

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

    </div>

    <!-- end row -->


</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("nptl-admin.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>