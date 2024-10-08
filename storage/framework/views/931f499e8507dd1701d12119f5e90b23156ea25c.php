<?php
/**
 * Created by PhpStorm.
 * User: mrksohag
 * Date: 1/3/18
 * Time: 6:30 PM
 */

$edit_shipping_method = SM::check_this_method_access( 'shipping_methods', 'edit' ) ? 1 : 0;
$shipping_method_status_update = SM::check_this_method_access( 'shipping_methods', 'shipping_method_status_update' ) ? 1 : 0;
$delete_shipping_method = SM::check_this_method_access( 'shipping_methods', 'destroy' ) ? 1 : 0;
$per = $edit_shipping_method + $delete_shipping_method;
if ($all_shipping_method)
{
$sl = 1;
foreach ($all_shipping_method as $shipping_method)
{
?>
<tr id="tr_<?php echo e($shipping_method->id); ?>">
    <td><?php echo $sl; ?></td>
    <td><?php echo $shipping_method->title; ?></td>
    <td><?php echo $shipping_method->charge; ?></td>

	<?php if ($shipping_method_status_update != 0): ?>
    <td class="text-center">
        <select class="form-control change_status"
                route="<?php echo config( 'constant.smAdminSlug' ); ?>/shipping_methods/shipping_method_status_update"
                post_id="<?php echo $shipping_method->id; ?>">
            <option value="1" <?php
				if ( $shipping_method->status == 1 ) {
					echo 'Selected="Selected"';
				}
				?>>Published
            </option>
            <option value="2" <?php
				if ( $shipping_method->status == 2 ) {
					echo 'Selected="Selected"';
				}
				?>>Pending
            </option>
            <option value="3" <?php
				if ( $shipping_method->status == 3 ) {
					echo 'Selected="Selected"';
				}
				?>>Canceled
            </option>
        </select>
    </td>
	<?php endif; ?>
	<?php if ($per != 0): ?>
    <td class="text-center">
		<?php if ($edit_shipping_method != 0): ?>
        <a href="<?php echo url( config( 'constant.smAdminSlug' ) . '/shipping_methods' ); ?>/<?php echo $shipping_method->id; ?>/edit"
           title="Edit" class="btn btn-xs btn-default" id="">
            <i class="fa fa-pencil"></i>
        </a>
		<?php endif; ?>
		<?php if ($delete_shipping_method != 0): ?>
        <a href="<?php echo url( config( 'constant.smAdminSlug' ) . '/shipping_methods/destroy' ); ?>/<?php echo $shipping_method->id; ?>"
           title="Delete" class="btn btn-xs btn-default delete_data_row"
           delete_message="Are you sure to delete this Payment method?"
           delete_row="tr_<?php echo e($shipping_method->id); ?>">
            <i class="fa fa-times"></i>
        </a>
		<?php endif; ?>
    </td>
	<?php endif; ?>
</tr>
<?php
$sl ++;
}
}
?>
