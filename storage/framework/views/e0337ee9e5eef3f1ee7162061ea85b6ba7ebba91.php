<?php $__env->startSection("title", "Order Detail"); ?>
<?php $__env->startSection("content"); ?>
<?php
$title = SM::smGetThemeOption("invoice_banner_title");
$subtitle = SM::smGetThemeOption("invoice_banner_subtitle");
$bannerImage = SM::smGetThemeOption("invoice_banner_image");
?>
<style>.blog-banner-contents.text-center {
        padding-top: 26px;
    }</style>
<!--BREADCRUMB START-->
<section class="page-banner-section contact-banner-section">
    <div class="blog-banner-sec "
         style="background:url( <?php echo SM::sm_get_the_src( $bannerImage ); ?>) no-repeat center center /cover">
        <div class="container">
            <div class="row">
                <div class="blog-banner-contents text-center">
                    <?php if(empty(!$title)): ?>
                    <h1><?php echo e($title); ?></h1>
                    <?php endif; ?>
                    <?php if(isset($subtitle) && $subtitle != ''): ?>
                    <p><?php echo e($subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php if(count($order)>0): ?>
<section class="order-done-sec">
    <div class="container">
        <?php
        $orderId = SM::orderNumberFormat($order);
        ?>
        <?php if(Session::has("orderSuccessMessage")): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="order-done-content text-center margin-bottom45">
                    <i class="fa fa-check"></i>
                    <h3><?php echo e(Session::get("orderSuccessMessage")); ?></h3>
                    <span class="doodle-order-input">Order ID <?php echo e($orderId); ?></span>
                    <p>Thanks for being cooperative. We hope you enjoy your Service.</p>
                </div>
            </div>
        </div>
        <?php
        Session::forget("orderSuccessMessage");
        Session::save();
        ?>
        <?php endif; ?>
        <?php if(request()->input('isAdmin', 0)!=1): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="download-item-list text-right">
                    <a href="<?php echo url("dashboard/orders/download/$order->id"); ?>" class="download"
                       title="Download"><i
                            class="fa fa-cloud-download"></i> Download
                        Invoice </a>
                    <a href="<?php echo url("dashboard/orders"); ?>" class="download" title="Order List"><i
                            class="fa fa fa-list"></i> Order List </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-table-item"
                     style="width: 100%; background: #f9fdff; padding: 50px 0 50px 50px;">
                         <?php
                         $sm_get_site_logo = SM::sm_get_the_src(SM::sm_get_site_logo(), 300, 63);
                         $site_name = SM::get_setting_value('site_name');
                         $orderUser = $order->user;
                         ?>
                    <!-- mobile device -->
                    <div class="row visible-xs">
                        <div class="col-lg-6">
                            <div class="invoice-author-information1">
                                <h1 class="ab-inv-title">
                                    invoice
                                </h1>
                                <img src="<?php echo $sm_get_site_logo; ?>" alt="<?php echo e($site_name); ?>">
                                <p style="font-weight: 700; color: #f00">
                                    Invoice ID No: <?php echo e($orderId); ?>

                                </p>
                                <p class="date">
                                    Date : <?php echo e(date('d-m-Y', strtotime($order->created_at))); ?>


                                </p>
                                <p>
                                    Order Status : <?php
                                    if ($order->order_status == 1) {
                                        echo 'Completed';
                                    } else if ($order->order_status == 2) {
                                        echo 'Processing';
                                    } else if ($order->order_status == 3) {
                                        echo 'Pending';
                                    } else {
                                        echo 'Cancel';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-lg-offset-2">


                            <div class="invoice-author-information">
                                <?php if(count($orderUser)>0): ?>
                                <?php
                                $flname = $orderUser->firstname . " " . $orderUser->lastname;
                                $name = trim($flname != '') ? $flname : $orderUser->username;
                                $address = "";
                                $address .= !empty($orderUser->address) ? $orderUser->address . ", " : "";
                                if (strlen($address) > 30) {
                                    $address .= '<br>';
                                }
                                $address .= !empty($orderUser->city) ? $orderUser->city . ", " : "";
                                $address .= !empty($orderUser->state) ? $orderUser->state . " - " : "";
                                $address .= !empty($orderUser->zip) ? $orderUser->zip . ", " : "";
                                $address .= $orderUser->country;
                                ?>

                                        <!--<img src="images/logo.png" alt="">-->
                                <p class="inv_to"> Invoice To :</p>
                                <h3><?php echo e($name); ?></h3>
                                <p><span>Address </span>:
                                    <?php echo $address; ?>.</p>
                                <p><span>Phone </span>:
                                    <?php echo e($orderUser->mobile); ?></p>
                                <p><span>Email </span>:
                                    <?php echo e($order->contact_email); ?>

                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- desktop device -->
                    <div class="row">
                        <div class="col-lg-6 hidden-xs col-sm-6">
                            <div class="invoice-author-information">
                                <?php if(count($orderUser)>0): ?>
                                <?php
                                $flname = $orderUser->firstname . " " . $orderUser->lastname;
                                $name = trim($flname != '') ? $flname : $orderUser->username;
                                $address = "";
                                $address .= !empty($orderUser->address) ? $orderUser->address . ", " : "";
                                if (strlen($address) > 30) {
                                    $address .= '<br>';
                                }
                                $address .= !empty($orderUser->city) ? $orderUser->city . ", " : "";
                                $address .= !empty($orderUser->state) ? $orderUser->state . " - " : "";
                                $address .= !empty($orderUser->zip) ? $orderUser->zip . ", " : "";
                                $address .= $orderUser->country;
                                ?>
                                <img src="<?php echo e($sm_get_site_logo); ?>" alt="<?php echo e($site_name); ?>">
                                <p class="inv_to"> Invoice To :</p>
                                <h3><?php echo e($name); ?></h3>
                                <p><span style="font-weight: bold; color: #1d2d5d">Address </span>:
                                    <?php echo $address; ?></p>
                                <p><span style="font-weight: bold; color: #1d2d5d; font-family: 'Poppins'">Phone </span>:
                                    <?php echo e($orderUser->mobile); ?></p>
                                <p><span style="font-weight: bold; color: #1d2d5d">Email </span>:
                                    <?php echo e($order->contact_email); ?>

                                </p>

                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-4 col-lg-offset-2 hidden-xs col-sm-6">
                            <div class="invoice-author-information1">
                                <h1 class="ab-inv-title hidden-xs">
                                    invoice
                                </h1>
                                <p>
                                    <label style="font-weight: 700; color: #1d2d5d">Invoice ID No</label>
                                    : <?php echo e($orderId); ?>

                                </p>
                                <p class="date">
                                    <label style="font-weight: 700; color: #1d2d5d"> Date</label>
                                    : <?php echo e(date('d-m-Y', strtotime($order->created_at))); ?>


                                </p>
                                <p>
                                    <label style="font-weight: 700; color: #1d2d5d">Order Status</label> :
                                    <span><?php
                                        if ($order->order_status == 1) {
                                            echo 'Completed';
                                        } else if ($order->order_status == 2) {
                                            echo 'Processing';
                                        } else if ($order->order_status == 3) {
                                            echo 'Pending';
                                        } else {
                                            echo 'Cancel';
                                        }
                                        ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $order_details = $order->detail;
                ?>
                <?php if(count($order_details)>0): ?>
                <div class="table-responsive hidden-xs">
                    <table class="table-product-info" width="100%" border="0" cellpadding="0"
                           cellspacing="0"
                           style="width: 100%; background: #f9fdff;">
                        <tr>
                            <th style="font-size: 18px; text-align: left; padding: 15px 20px 15px 50px; text-transform: uppercase; line-height: 28px; font-weight: 500; background: #1d2d5d; color: #ffffff;">
                                Item Description
                            </th>
                            <th style="font-size: 18px; text-align: left; padding: 15px 20px 15px 50px; text-transform: uppercase; line-height: 28px; font-weight: 500; background: #1d2d5d; color: #ffffff;">
                                Image
                            </th>
                            <th style="font-size: 18px; text-align: center; padding: 15px 0; text-transform: uppercase; line-height: 28px; font-weight: 500; background: #1d2d5d; color: #ffffff;">
                                Quantity
                            </th>
                            <th style="font-size: 18px; text-align: center; padding: 15px 0; text-transform: uppercase; line-height: 28px; font-weight: 500; background: #1d2d5d; color: #ffffff;">
                                Amount
                            </th>
                            <th style="font-size: 18px; text-align: center; padding: 15px 30px 15px 0; text-transform: uppercase; line-height: 28px; font-weight: 500; background: #1d2d5d; color: #ffffff;">
                                Total Price
                            </th>
                        </tr>
                        <?php
                        $order_detail = $order->detail;
                        $orderTotal = [];
                        ?>
                        <?php $__currentLoopData = $order->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $title = $detail->product->title;
                        $price = $detail->product_price;
                        $total = $detail->product_qty * $price;
                        $orderTotal[] = $total;
                        ?>
                        <tr style="border-bottom: 1px solid #dddddd;">
                            <td style="width: 25%; padding: 18px 0 18px 50px;" valign="top">
                                <h4 style="font-size: 16px; font-weight: 600; color: #1d2d5d; line-height: 28px; margin-bottom: 0;">
                                    <?php echo e($title); ?></h4>
                                <?php
                                if (!empty($detail->product_color)) {
                                    ?>
                                    <small>Color : <?php echo e($detail->product_color); ?></small>
                                    <br>
                                    <small>Size : <?php echo e($detail->product_size); ?></small>
                                <?php } ?>

                            </td>
                            <td style="width: 20%; padding: 18px 0 18px 50px;" valign="top">
                                <img src="<?php echo e(SM::sm_get_the_src($detail->product_image, 75, 75)); ?>"
                                     alt="<?php echo e($title); ?>">
                            </td>
                            <td style="width: 13%;" valign="middle" align="center">
                                <p style="font-size: 18px; font-weight: 600; color: #1d2d5d; line-height: 28px; margin-bottom: 0;">
                                    <?php echo e($detail->product_qty); ?></p>
                            </td>
                            <td style="width: 13%;" valign="middle" align="center">
                                <p style="font-size: 18px; font-weight: 600; color: #1d2d5d; line-height: 28px; margin-bottom: 0;">
                                    <?php echo e(SM::currency_price_value($price)); ?></p>
                            </td>
                            <td style="width: 13%;" valign="middle" align="center">
                                <p style="font-size: 18px; font-weight: 600; color: #1d2d5d; line-height: 28px; margin-bottom: 0;">
                                    <?php echo e(SM::currency_price_value($total)); ?></p>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                </div>
                <!-- mobile device start-->
                <div class="mo-product-item hidden-sm hidden-md hidden-lg">

                    <?php if(count($order->detail)>0): ?>
                    <h1 class="ab-item-desc-title">
                        
                    </h1>
                    <?php else: ?>
                    <h1 class="ab-item-desc-title">
                        Item Description
                    </h1>
                    <?php endif; ?>
                    <ul>
                        <?php
                        $orderTotal = [];
                        ?>
                        <?php if(count($order->detail)>0): ?>
                        <?php $__currentLoopData = $order->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $title = $detail->product->title;
                        $price = $detail->product_price;
                        $total = $detail->product_qty * $price;
                        $orderTotal[] = $total;
                        ?>
                        <li>
                            <strong class="item-desc"><?php echo e($title); ?></strong>
                            <strong> <span>Quantity</span>: <?php echo e($detail->product_qty); ?></strong>
                            <strong>
                                <span> Amount </span>: <?php echo e(SM::currency_price_value($price)); ?>

                            </strong>
                            <strong>
                                <span>Total Price </span>: <?php echo e(SM::currency_price_value($total)); ?>

                            </strong>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <?php
                        $rate = isset($order->detail[0]->rate) ? $order->detail[0]->rate : 0;
                        $qty = isset($order->detail[0]->qty) ? $order->detail[0]->qty : 0;
                        $total = $qty * $rate;
                        $orderTotal[] = $total;
                        ?>
                        <li>
                            <strong class="item-desc"><?php echo e($order_details->title); ?></strong>
                            <p>
                                <?php if($order_details->detail[0]): ?>
                                <?php echo e(title_case($order_details->detail[0]->title)); ?> Plan
                                <?php endif; ?>
                            </p>
                            <strong> <span>Quantity</span>: <?php echo e($qty); ?></strong>
                            <strong>
                                <span> Amount </span>: <?php echo e(SM::currency_price_value($rate)); ?>

                            </strong>
                            <strong>
                                <span>Total Price </span>: <?php echo e(SM::currency_price_value($total)); ?>

                            </strong>
                        </li>
                        <ul>
                            <?php
                            $orderTotal = [];
                            ?>
                            <?php if(count($order->detail)>0): ?>
                            <?php $__currentLoopData = $order->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $title = $detail->product->title;
                            $price = $detail->product_price;
                            $total = $detail->product_qty * $price;
                            $orderTotal[] = $total;
                            ?>
                            <li>
                                <strong class="item-desc"><?php echo e($title); ?></strong>
                                <strong> <span>Quantity</span>: <?php echo e($detail->product_qty); ?>

                                </strong>
                                <strong>
                                    <span> Amount </span>: <?php echo e(SM::currency_price_value($price)); ?>

                                </strong>
                                <strong>
                                    <span>Total Price </span>: <?php echo e(SM::currency_price_value($total)); ?>

                                </strong>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <?php
                            $rate = isset($order->detail[0]->rate) ? $order->detail[0]->rate : 0;
                            $qty = isset($order->detail[0]->qty) ? $order->detail[0]->qty : 0;
                            $total = $qty * $rate;
                            $orderTotal[] = $total;
                            ?>
                            <li>
                                <strong class="item-desc"><?php echo e($order_detail->title); ?></strong>
                                <p>
                                    <?php if($order_detail->detail[0]): ?>
                                    <?php echo e(title_case($order_detail->detail[0]->title)); ?> Plan
                                    <?php endif; ?>
                                </p>
                                <strong> <span>Quantity</span>: <?php echo e($qty); ?></strong>
                                <strong>
                                    <span> Amount </span>: <?php echo e(SM::currency_price_value($rate)); ?>

                                </strong>
                                <strong>
                                    <span>Total Price </span>: <?php echo e(SM::currency_price_value($total)); ?>

                                </strong>
                            </li>
                            <?php endif; ?>
                        </ul>
                </div>
                <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="total-amount-item row hidden-xs " style="background: #f9fdff">
                <div class="col-lg-6 col-sm-6">
                    <div class="left-amount-process">
                        <p><label style="font-weight: 700; color: #1d2d5d">Amount in Words</label>: <span>
                                <?php echo e(title_case(SM::sm_convert_number_to_words($order->grand_total))); ?>

                                Taka only.
                            </span>
                        </p>
                        <p><label style="font-weight: 700; color: #1d2d5d"> Payment Status </label>: <span><?php
                                if ($order->payment_status == 1) {
                                    echo 'Completed';
                                } else if ($order->payment_status == 2) {
                                    echo 'Pending';
                                } else {
                                    echo 'Cancel';
                                }
                                ?></span></p>
                        <?php
                        $due = $order->paid - $order->grand_total;
                        $dueSign = $due < 0 ? "-" : "+";
                        $dueSign = $due == 0 ? "" : $dueSign;
                        ?>
                        <?php if($due < 0): ?>
                        <p>Due Status : <span>
                                <?php
                                echo SM::get_setting_value('currency') . ' ' . $dueSign . ' ' . number_format(abs($due), 2);
                                ?>
                            </span></p>
                        <!--<a href="<?php echo e(url("dashboard/orders/pay/$order->id")); ?>">Pay Your Due</a>-->
                        <?php endif; ?>
                        <?php
                        $payment_method = SM::get_payment_method_by_id($order->payment_method_id);
                        ?>
                        <label style="font-weight: 700; color: #1d2d5d"> Payment Method </label>:<span><?php echo $payment_method->title?></span>
                        <br>
                        <?php
                         
                        if ($order->payment_method_id != 3) {
                            $payment_details = json_decode($order->payment_details);
                            foreach ($payment_details as $key => $value) {
                                if ($key == 'card_number' || $key == 'card_type' || $key == 'pay_status' || $key == 'bank_txn') {
                                    $key_field = str_replace("_", " ", $key);
                                    echo '<label style="font-weight: 700; color: #1d2d5d">' . ucfirst($key_field) . ': </label> <span>' . $value . '</span><br>';
                                }
                            }
                        }
                        ?>
                    </div>

                </div>
                <div class="col-lg-5 col-lg-offset-1 col-sm-6">
                    <div class="right-total-amount-process">
                        <p class="clearfix"
                           style="display: <?php echo e($order->tax>0 || $order->discount>0 || $order->coupon_amount>0 ? 'block' : 'none'); ?>">
                            <span class="pull-left inv-total">Sub Total    </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->sub_total)); ?></span>
                        </p>

                        <?php if($order->tax>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Tax + Vat  </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->tax)); ?></span>
                        </p>
                        <?php endif; ?>

                        <?php if($order->discount>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Discount  </span>:
                            <span class="pull-right ab-inv-total-price">- <?php echo e(SM::currency_price_value($order->discount)); ?> </span>
                        </p>
                        <?php endif; ?>
                        <?php if($order->coupon_amount>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Coupon </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->coupon_amount)); ?></span>
                        </p>
                        <?php endif; ?>

                        <div class="clearfix ab-total-amount">
                            <span class="pull-left">Total Amount  </span>
                            <span class="pull-right "><?php echo e(SM::currency_price_value($order->grand_total)); ?></span>
                        </div>

                    </div>
                    <?php
                    $invoice_signature = SM::smGetThemeOption("invoice_signature");
                    $invoice_approved_by_name = SM::smGetThemeOption("invoice_approved_by_name", "NPTL Author");
                    $invoice_approved_by_designation = SM::smGetThemeOption("invoice_approved_by_designation", "Director of Development");
                    $src = ($invoice_signature != '') ? SM::sm_get_the_src($invoice_signature) : "images/signature.png";
                    ?>
                    <div class="author-signature-content pull-right">
                        <img src="<?php echo e(url($src)); ?>" alt="<?php echo e($invoice_approved_by_name); ?>">
                        <h2><?php echo e($invoice_approved_by_name); ?></h2>
                        <h4><?php echo e($invoice_approved_by_designation); ?></h4>
                    </div>
                </div>
            </div>

            <div class="total-amount-item row visible-xs " style="background: #f9fdff">

                <div class="col-lg-12">
                    <div class="right-total-amount-process">
                        <p class="clearfix"
                           style="display: <?php echo e($order->tax>0 || $order->discount>0 || $order->coupon_amount>0 ? 'block' : 'none'); ?>">
                            <span class="pull-left inv-total">Sub Total    </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->sub_total)); ?></span>
                        </p>

                        <?php if($order->tax>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Tax + Vat  </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->tax)); ?></span>
                        </p>
                        <?php endif; ?>

                        <?php if($order->discount>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Discount  </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->discount)); ?></span>
                        </p>
                        <?php endif; ?>
                        <?php if($order->coupon_amount>0): ?>
                        <p class="clearfix">
                            <span class="pull-left inv-total">Coupon  </span>:
                            <span class="pull-right ab-inv-total-price"><?php echo e(SM::currency_price_value($order->coupon_amount)); ?></span>
                        </p>
                        <?php endif; ?>

                        <div class="clearfix ab-total-amount">
                            <span class="pull-left">Total Amount  </span>
                            <span class="pull-right "><?php echo e(SM::currency_price_value($order->grand_total)); ?></span>
                        </div>

                    </div>
                    <div class="left-amount-process">
                        <p>Amount in Words: <span>
                                <?php echo e(title_case(SM::sm_convert_number_to_words($order->grand_total))); ?>

                                USD only.
                            </span>
                        </p>
                        <p>Payment Status : <span><?php
                                if ($order->payment_status == 1) {
                                    echo 'Completed';
                                } else if ($order->payment_status == 2) {
                                    echo 'Pending';
                                } else {
                                    echo 'Cancel';
                                }
                                ?></span></p>
                        <?php if($due < 0): ?>
                        <p>Due Status : <span>
                                <?php
                                echo SM::get_setting_value('currency') . ' ' . $dueSign . ' ' . number_format(abs($due), 2);
                                ?>
                            </span></p>
                        <a href="<?php echo e(url("dashboard/orders/pay/$order->id")); ?>">Pay Your Due</a>
                        <?php endif; ?>



                    </div>
                    <!--<div class="author-signature-content pull-right">-->
                    <!--    <img src="<?php echo e(url($src)); ?>" alt="<?php echo e($invoice_approved_by_name); ?> Signature">-->
                    <!--    <h2><?php echo e($invoice_approved_by_name); ?></h2>-->
                    <!--    <h4><?php echo e($invoice_approved_by_name); ?></h4>-->
                    <!--</div>-->
                </div>

            </div>
            <?php
            $mobile = SM::get_setting_value('mobile');
            $email = SM::get_setting_value('email');
            $address = SM::get_setting_value('address');
            $country = SM::get_setting_value('country');
            $website = SM::get_setting_value('website');
            ?>
            <div class="single-table-pert-info">
                <ul>
                    <li><i class="fa fa-phone"></i> <?php echo e($mobile); ?>

                    </li>
                    <li><i class="fa fa-envelope"></i> <?php echo e($email); ?>

                    </li>
                    <li><i class="fa fa-globe"></i> <?php echo e($website); ?>

                    </li>
                    <li><i class="fa fa-map-marker"></i> <?php echo e($address); ?>, <?php echo e($country); ?>

                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>
</section>
<?php else: ?>
<div class="alert alert-warning">
    <i class="fa fa-warning"></i> No Order Found!
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>