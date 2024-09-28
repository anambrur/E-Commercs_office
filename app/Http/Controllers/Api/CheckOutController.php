<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Model\Common\Order;
use Illuminate\Http\Request;
use App\Model\Common\Order_detail;
use App\Http\Controllers\Controller;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            $request->validate([
                'payment_method_id' => 'required|integer',
                'customer_name' => 'required|string',
                'contact_email' => 'required|email',
                'order_note' => 'nullable|string',
            ]);

            $sessionId = $request->header('Session-Id');
            session()->setId($sessionId);
            session()->start();

            // Check if cart is empty
            $cartItems = Cart::instance('cart')->content();
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your cart is empty',
                ], 400);
            }

            $subTotal = Cart::instance('cart')->subtotal();
            $tax = Cart::instance('cart')->tax();
            $grandTotal = Cart::instance('cart')->total();
            $couponCode = $request->input('coupon_code', null);
            $discount = $request->input('discount', 0);
            $couponAmount = $request->input('coupon_amount', 0);

            // Create order in the orders table
            $order = new Order();
            $order->user_id = $request->user()->id;
            $order->customer_name = $request->customer_name;
            $order->contact_email = $request->contact_email;
            $order->cart_json = json_encode($cartItems); // Store the cart as JSON (optional for reference)
            $order->sub_total = $subTotal;
            $order->discount = $discount;
            $order->coupon_code = $couponCode;
            $order->coupon_amount = $couponAmount;
            $order->tax = $tax;
            $order->grand_total = $grandTotal;
            $order->paid = 0;
            $order->payment_method_id = $request->payment_method_id;
            $order->order_note = $request->order_note;
            $order->order_status = 3;
            $order->payment_status = 2;
            $order->created_by = $request->user()->id;
            $order->save();

            // Loop through cart items and save each item in the order_details table
            foreach ($cartItems as $item) {
                $orderDetail = new Order_detail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item->id;
                $orderDetail->product_color = $item->options->color ?? null;
                $orderDetail->product_size = $item->options->size ?? null;
                $orderDetail->product_image = $item->options->image;
                $orderDetail->product_qty = $item->qty;
                $orderDetail->product_price = $item->price;
                $orderDetail->sub_total = $item->subtotal;
                $orderDetail->save();
            }

            Cart::instance('cart')->destroy();

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while placing the order: ' . $e->getMessage(),
            ], 500);
        }
    }
}
