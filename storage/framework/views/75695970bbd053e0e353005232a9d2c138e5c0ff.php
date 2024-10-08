<?php
/**
 * Created by PhpStorm.
 * User: mrksohag
 * Date: 1/3/18
 * Time: 6:02 PM
 */
?>
<?php
if ($users)
{
$sl = 1;
foreach ($users as $user)
{
?>
<tr id="tr_<?php echo e($user->id); ?>">
    <td><label><input type="checkbox" class="smCheckbox subscriber subscriber<?php echo e($user->id); ?>" value="<?php echo e($user->id); ?>"></label></td>
    <td>
        <img class="img-blog" src="<?php echo SM::sm_get_the_src($user->image, 80, 80); ?>" width="80px" alt="<?php echo $user->title; ?>" />
    </td>
    <td>
		<?php
		echo $user->firstname . ' ' . $user->lastname;
		?>
    </td>
    <td><?php echo $user->username; ?></td>
    <td class="subscriberemail<?php echo e($user->id); ?>"><?php echo $user->email; ?></td>
    <td><?php echo "$".$user->total_paid; ?></td>
    <td><?php echo date('d F, Y', strtotime($user->created_at)); ?></td>
    <td class="text-center">
        <?php if($user->id!=1): ?>
            <select class="form-control change_status" route="<?php echo config('constant.smAdminSlug'); ?>/customers/customer_status_update" post_id="<?php echo $user->id; ?>">
                <option value="1" <?php
					if ($user->status == 1)
					{
						echo 'Selected="Selected"';
					}
					?>>Approved</option>
                <option value="2" <?php
					if ($user->status == 2)
					{
						echo 'Selected="Selected"';
					}
					?>>Pending</option>
                <option value="3" <?php
					if ($user->status == 3)
					{
						echo 'Selected="Selected"';
					}
					?>>Canceled</option>
            </select>
        <?php else: ?>
            Approved
        <?php endif; ?>
    </td>
    <td class="text-center">
        <a href="javascript:void(0)" row="<?php echo e($user->id); ?>"
           title="Send Offer Mail" class="btn btn-xs btn-success showOfferMailPopUpForSingleSubscriber">
            <i class="fa fa-envelope"></i>
        </a>
        <a href="<?php echo url(config('constant.smAdminSlug') . '/customers/edit_customer'); ?>/<?php echo $user->id; ?>" title="Edit" class="btn btn-xs btn-default" id="">
            <i class="fa fa-pencil"></i>
        </a>
        <?php if($user->id!=1): ?>
            <a href="<?php echo url(config('constant.smAdminSlug') . '/customers/delete_customer'); ?>/<?php echo $user->id; ?>"
               title="Delete" class="btn btn-xs btn-default delete_data_row"
               delete_message="Are you sure to delete this Customer? This Customer all data will be delete"
               delete_row="tr_<?php echo e($user->id); ?>">
                <i class="fa fa-times"></i>
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php
$sl++;
}
}
?>
