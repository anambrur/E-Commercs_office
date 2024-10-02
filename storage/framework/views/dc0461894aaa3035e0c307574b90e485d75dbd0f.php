<div class="col-12 col-lg-4 checkout-right">
    <div class="order-summary-outer">
        <div class="order-summary">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Order Summary</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><span>SubTotal</span></th>
                        <td align="right"
                            id="subtotal"><?php echo e(SM::currency_price_value($sub_total)); ?></td>
                    </tr>
                    <tr>
                        <th><span>Tax</span></th>
                        <td align="right"><?php echo e(SM::currency_price_value($tax)); ?></td>
                    </tr>
                    <tr>
                        <th><span>Shipping Cost</br>
                                <small> <?php echo e($shipping_method_name); ?></small></span></th>
                        <td align="right"><?php echo e(SM::currency_price_value($shipping_method_charge)); ?></td>
                    </tr>
                    <?php if($noraml_discount_amount>0): ?>
                        <tr>
                            <th><span>Discount (Normal)
                                <?php if($discount_amount>0): ?>
                                        - <?php echo e($discount_amount); ?> %
                                    <?php endif; ?>
                                </span></th>
                            <td align="right"
                                id="discount">
                                <?php echo e(SM::currency_price_value($noraml_discount_amount)); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th><span>Discount(Coupon)</span></th>
                        <td align="right"
                            id="discount">
                            <?php echo e(SM::currency_price_value($coupon_amount)); ?></td>
                    </tr>
                    <tr>
                        <th class="last"><span>Total</span></th>
                        <td class="last" align="right"
                            id="total_price"><?php echo e(SM::currency_price_value($grand_total)); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="coupons">
            <!-- applied copuns -->
            
            <div class="form-group">
                <label for="inputPassword2" class="">Coupon Code</label>
                <input type="text" name="coupon_code" class="form-control" id="coupon_code" autocomplete="off">
                <input type="hidden" name="sub_total_price" value="<?php echo e($net_sub_total); ?>"
                       class="form-control"
                       id="sub_total_price">
            </div>
            <button type="submit"
                    class="btn btn-sm btn-success apply_coupon">ApplyCoupon
            </button>
            <div id="coupon_error" style="display: none"></div>
            <div id="coupon_require_error"
                 style="display: none">Please enter a valid coupon code
            </div>
            
        </div>
    </div>
</div>