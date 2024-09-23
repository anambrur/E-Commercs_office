<?php
/**
 * Created by PhpStorm.
 * User: mrksohag
 * Date: 1/3/18
 * Time: 6:04 PM
 */
?>
<?php
$dueArray = [];
$netTotalArray = [];
$paidArray = [];
//echo "<pre>";
//print_r( $all_order );
//echo "</pre>";
if ($all_order)
{
$sl = 1;
foreach ($all_order as $order)
{
?>
<tr id="tr_<?php echo e($order->id); ?>">
    <td><?php echo e(SM::orderNumberFormat($order)); ?></td>
    <td><?php echo e(date('Y-m-d H:i:s', strtotime($order->created_at))); ?></td>

    <td><?php echo e($order->customer_name); ?></td>
    <td>
        <?php $__currentLoopData = $order->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($detail->product->title); ?>

            <?php if(!$loop->last): ?>
                ,
            <?php endif; ?><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>

    <td class="text-center">
        <?php
        if ($order->order_status == 1) {
            echo 'Completed';
        } else if ($order->order_status == 2) {
            echo 'Progress';
        } else if ($order->order_status == 3) {
            echo 'Pending';
        } else {
            echo 'Canceled';
        }
        ?>
    </td>
    <td class="text-center">
        <?php
        if ($order->payment_status == 1) {
            echo 'Completed';
        } else if ($order->payment_status == 2) {
            echo 'Pending';
        } else {
            echo 'Canceled';
        }
        ?>
    </td>
    <?php
    $due = $order->paid - $order->net_total;
    $dueSign = $due < 0 ? "-" : "+";
    $dueSign = $due == 0 ? "" : $dueSign;


    $dueArray[] = $due;
    $netTotalArray[] = $order->net_total;
    $paidArray[] = $order->paid;
    ?>
    <td id="total_<?php echo e($order->id); ?>">$<?php echo e(number_format($order->net_total, 2)); ?></td>
    <td id="paid_<?php echo e($order->id); ?>">$<?php echo e(number_format($order->paid,2)); ?></td>
    <td id="due_<?php echo e($order->id); ?>">
        <?php echo e($dueSign); ?> $<?php echo e(abs(number_format($due,2))); ?>

    </td>
    <td class="text-center">
        <a target="_blank"
           href="<?php echo url(config('constant.smAdminSlug') . '/orders/' . $order->id); ?>?isAdmin=1"
           title="View Invoice" class="btn btn-xs btn-default" id="">
            <i class="fa fa-eye"></i>
        </a>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/orders/download/' . $order->id); ?>"
           title="Download Invoice" class="btn btn-xs btn-default" id="">
            <i class="fa fa-download"></i>
        </a>
    </td>
</tr>
<?php
$sl++;
}?>
<tfoot id="tr_total">
<tr>
    <th class="text-right" colspan="6">Total</th>
    <th id="total_net_total">$<?php echo e(number_format(array_sum($netTotalArray), 2)); ?></th>
    <th id="paid_paid">$<?php echo e(number_format(array_sum($paidArray), 2)); ?></th>
    <th id="due_due" colspan="2">
        <?php
        $due = array_sum($dueArray);
        $dueSign = $due < 0 ? "-" : "+";
        $dueSign = $due == 0 ? "" : $dueSign;
        ?>
        <?php echo e($dueSign); ?> $<?php echo e(abs(number_format($due,2))); ?>

    </th>
</tr>
</tfoot>
<?php
}
?>
