<?php $__env->startSection("title","Orders Report"); ?>
<?php $__env->startSection("content"); ?>
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="order_report_list_wid">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-shopping-cart"></i> </span>
                        <h2>Orders Report </h2>
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
                        <div class="widget-body table-responsive">
                            <div class="row">
                                <form method="get" action="">
                                    <div class="col-md-1 form-group">
                                        <label for="sdate">Order ID</label>
                                        <input type="text" placeholder="Order ID" class="form-control" id="order_id"
                                               name="order_id"
                                               value="<?php echo e($order_id); ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label for="sdate">Start Date</label>
                                        <input type="text" placeholder="Start Date" class="form-control datepicker"
                                               name="sdate"
                                               value="<?php echo e($sdate); ?>">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label for="edate">End Date</label>
                                        <input type="text" placeholder="End Date" class="form-control datepicker"
                                               name="edate"
                                               id="edate"
                                               value="<?php echo e($edate); ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="package_search">Package</label>
                                        <input type="text" placeholder="Search Package" class="form-control itemtext"
                                               name="package" autocomplete="off"
                                               id="package_search"
                                               value="<?php echo e($package); ?>">
                                        <input type="hidden" name="pid" class="form-control itemvalue" id="pid" value="<?php echo e($pid); ?>">
                                        <div class="search_div">
                                            <div class="list-group" id="package_search_div">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 form-group">
                                        <label for="order_status">Order Status</label>
                                        <select class="form-control" name="order_status" id="order_status">
                                            <option value="">Select Order Status</option>
                                            <option value="1">Completed</option>
                                            <option value="2">Progress</option>
                                            <option value="3">Pending</option>
                                            <option value="4">Canceled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <select class="form-control" name="payment_status" id="payment_status">
                                            <option value="">Select Payment Status</option>
                                            <option value="1">Completed</option>
                                            <option value="2">Pending</option>
                                            <option value="3">Canceled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                        <label for="customer_search">Customer</label>
                                        <input type="text" placeholder="Search Customer" class="form-control itemtext"
                                               name="customer" autocomplete="off"
                                               id="customer_search"
                                               value="<?php echo e($customer); ?>">
                                        <input type="hidden" name="cid" class="form-control itemvalue" id="cid" value="<?php echo e($cid); ?>">
                                        <div class="search_div">
                                            <div class="list-group" id="customer_search_div">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group text-center">
                                        <button type="submit" name="submit" value="submit"
                                                class="btn btn-primary margin-bottom-5"><i
                                                    class="fa fa-recycle"></i></button><br>
                                        <button type="button" class="btn btn-warning margin-bottom-5 reset_fields"><i
                                                    class="fa fa-refresh"></i></button>
                                        <button type="submit" name="excel" value="excel"
                                                class="btn btn-success margin-bottom-5"><i
                                                    class="fa fa-file-excel-o"></i></button>
                                        
                                                
                                                    
                                    </div>
                                </form>
                            </div>
                            <!-- this is what the user will see -->
                            <table id="" class="table table-striped table-bordered " width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created At</th>
                                    <th>Customer</th>
                                    <th>Product Name</th>
                                    <th class="text-center">Order Status</th>
                                    <th class="text-center">Payment Status</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Due / Advanced</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="dataBody">
                                <?php echo $__env->make('nptl-admin.common.reports.orders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </tbody>
                            </table>
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
<?php $__env->startSection('footer_script'); ?>
    <script type="text/javascript">
        (function ($) {
            <?php if(empty(!$order_status)): ?>
            $("#order_status").val("<?php echo e($order_status); ?>");
            <?php endif; ?>
            <?php if(empty(!$payment_status)): ?>
            $("#payment_status").val("<?php echo e($payment_status); ?>");
            <?php endif; ?>
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("nptl-admin/master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>