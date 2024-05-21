<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private $product;
    private $order;

    public function __construct(Product $product, Order $order)
    {
        $this->product = $product;
        $this->order = $order;
    }

    public function index()
    {
        $cart = session()->get('cart');
        $cartEmpty = empty($cart);
        return view('client.pages.cart', compact('cart', 'cartEmpty'));
    }

    public function checkOut()
    {
        $cart = session()->get('cart');
        $cartEmpty = empty($cart);
        return view('client.pages.checkout', compact('cart', 'cartEmpty'));
    }

    public function addToCart($id)
    {
        $product = $this->product->findOrFail($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['total'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->feature_image_path,
            ];
        }

        session()->put('cart', $cart);
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ], 200);
    }

    public function addToCartForm(Request $request)
    {
        try {
            $quantity = $request->input('quantity', 1);
            $product = $this->product->findOrFail($request->id);
            $quantity = $request->quantity;
            $cart = session()->get('cart');
            $id = $product->id;

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
                $cart[$id]['total'] = $cart[$id]['quantity'] * $cart[$id]['price'];
            } else {
                $cart[$id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->feature_image_path,
                ];

            }
            session()->put('cart', $cart);
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được tạo thành công!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi tạo sản phẩm.'
            ], 500); // Trả về mã lỗi 500 nếu có lỗi
        }
    }

    public function remove($id)
    {
        try {
            $cart = session()->get('cart');

            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                return response()->json([
                    'status' => 200,
                    'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Đã xảy ra lỗi trong quá trình xóa sản phẩm'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $cartItems = $request->input('items');

            $cart = session()->get('cart', []);

            foreach ($cartItems as $item) {
                $cart[$item['id']]['quantity'] = $item['quantity'];
            }

            session()->put('cart', $cart);

            return response()->json([
                'status' => 200,
                'message' => 'Giỏ hàng đã được cập nhật'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Đã xảy ra lỗi trong quá trình cập nhật giờ hãng'
            ], 500);
        }
    }

    public function handleCheckOut(OrderRequest $request)
    {
        $order = $this->order->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'order_detail' => json_encode($request->product_id),
            'token' => Str::random(12),
        ]);

        $mail = Mail::to($order->email) ->send(new OrderMail($order->name, $order->token));
        return redirect()->route('thank-you');
    }
}
