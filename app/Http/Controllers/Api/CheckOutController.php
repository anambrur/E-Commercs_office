<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Model\Common\Order;
use Illuminate\Http\Request;
use App\Model\Common\Product;
use App\Model\Common\Order_detail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            $this->validate($request, [
                'payment_method_id' => 'required|integer',
                'card_data' => 'required_if:payment_method_id,!=,3', // Card data required for online payments
                'sub_total' => 'required',
                'grand_total' => 'required',
            ]);

            $shipping = [
                "firstname" => "John",
                "lastname" => "Doe",
                "mobile" => "1234567890",
                "company" => "CompanyName",
                "address" => "123 Main Street",
                "country" => "BD",
                "state" => "Dhaka",
                "city" => "Dhaka",
                "zip" => "1200"
            ];

            // Manually set billing address
            $billing = $shipping;

            // Fetch the authenticated user
            $user = Auth::user();
            $user_id = $user->id;
            $user_email = $user->email;
            $name = $shipping['firstname'] . ' ' . $shipping['lastname'];

            // Update user shipping details (optional)
            $user->firstname = $shipping["firstname"];
            $user->lastname = $shipping["lastname"];
            $user->mobile = $shipping["mobile"];
            $user->address = $shipping["address"];
            $user->city = $shipping["city"];
            $user->zip = $shipping["zip"];
            $user->update();

            // Cart Products
            $cartProducts = Cart::instance('cart')->content();

            // Create the Order
            $order = new Order();
            $order->user_id = $user_id;
            $order->contact_email = $user_email;
            $order->cart_json = json_encode($cartProducts);
            $order->sub_total = $request->sub_total;
            $order->tax = $request->tax ?? 0;
            $order->discount = $request->discount ?? 0;
            $order->coupon_code = $request->coupon_code ?? null;
            $order->grand_total = $request->grand_total;
            $order->payment_method_id = $request->payment_method_id;
            $order->order_note = $request->order_note ?? '';

            // Handle Payment Logic (Cash on Delivery or Online)
            if ($request->payment_method_id == 3) {
                // Cash on Delivery
                $order->payment_status = 2; // Pending
                $order->order_status = 3;   // Order placed
                $order->transaction_id = null;
                $order->save();
            } elseif ($request->payment_method_id == 6) {
                // SSLCommerz Payment Logic
                $tran_id = uniqid('sslcommerz-', true);
                $order->transaction_id = $tran_id;
                $order->payment_status = 2; // Pending
                $order->order_status = 3;   // Pending until payment is confirmed
                $order->save();

                // Prepare SSLCommerz Payment Data
                $sslc = new SslCommerzNotification();
                $post_data = [
                    'total_amount' => $request->grand_total,
                    'currency' => "BDT",
                    'tran_id' => $tran_id,
                    'cus_name' => $name,
                    'cus_email' => $user_email,
                    'cus_add1' => $shipping["address"],
                    'cus_city' => $shipping["city"],
                    'cus_state' => $shipping["state"],
                    'cus_postcode' => $shipping["zip"],
                    'cus_country' => $shipping["country"],
                    'cus_phone' => $shipping["mobile"],
                    'success_url' => url('/api/success'), // Replace with API success endpoint
                    'fail_url' => url('/api/fail'),
                    'cancel_url' => url('/api/cancel'),
                    // Other data as required
                ];

                // Initiate payment request
                $payment_options = $sslc->makePayment($post_data, 'hosted');
                if (!is_array($payment_options)) {
                    return response()->json(['error' => 'Payment initialization failed!'], 500);
                }

                // Return the payment gateway URL
                return response()->json(['payment_url' => $payment_options['GatewayPageURL']]);
            }

            // Save order details and update stock (same as in your original function)
            foreach ($cartProducts as $pro) {
                $cartPro = new Order_detail;
                $cartPro->order_id = $order->id;
                $cartPro->product_id = $pro->id;
                $cartPro->product_color = $pro->options->colorname;
                $cartPro->product_size = $pro->options->sizename;
                $cartPro->product_image = $pro->options->image;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->qty;
                $cartPro->sub_total = $pro->price * $pro->qty;
                $cartPro->save();

                // Decrement stock
                $product = Product::find($pro->id);
                $product->decrement('product_qty', $pro->qty);
                $product->update();
            }

            // Destroy cart
            Cart::instance('cart')->destroy();

            // Return success response for Cash on Delivery or Order completion
            return response()->json([
                'message' => 'Order successfully placed!',
                'order_id' => $order->id,
                'grand_total' => $request->grand_total
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while placing the order: ' . $e->getMessage(),
            ], 500);
        }
    }
}
