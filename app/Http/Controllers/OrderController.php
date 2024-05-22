<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $order;
    private $product;

    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    public function index()
    {
        $orders = $this->order->latest()->paginate(8);;
        return view('admin.order.index', compact('orders'));
    }

    public function detailOrder($id)
    {
        $order = $this->order->find($id);
        $order_detail = json_decode($order->order_detail, true);
        $product_id = array_keys($order_detail);
        $products = $this->product->whereIn('id', $product_id)->get();

        return view('admin.order.detail', compact('order_detail', 'products'));
    }

    public function delete($id)
    {
        try {
            $this->order->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa đơn hàng thành công!',
            ], status: 200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xóa đơn hàng thất bại!',
            ], status: 500);
        }
    }
}
