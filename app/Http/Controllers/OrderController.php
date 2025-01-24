<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(){
        //select * from orders
        $orders = Order::all();

        if(count($orders)>0){
            return response()->json($orders,200);
        }
        return response()->json([],200);
    }

    public function order_by_user_id($id){
        $validator = Validator::make(['id'=>$id],[
            'id'=>'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }

        //select * from orders where user_id=9
        $orders = Order::where('user_id', $id)->get();
        if($orders !=null){
            return response()->json($orders,200);
        }
        return response()->json(['message'=>'Order not found'],404);
    }

    public function order_details(){
        /* select orders.id as id, orders.product as product_name, orders.amount as amount, orders.total as total, 
        users.id as user_id, users.name as user_name, users.email as user_email, users.phone as user_phone
        from orders inner join  users on orders.user_id = users.id */
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.id as id', 'orders.product as product_name', 'orders.amount as amount', 'orders.total as total', 'users.id as user_id', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone')->get();
        if(count($orders)>0){
            return response()->json($orders,200);
        }
        return response()->json([],200);
    }

    public function total_range(Request $request){
        /*  SELECT * FROM orders where total between 100 and 900 */
        $validator = Validator::make($request->all(),[
            'start_range'=>'nullable|numeric|min:0',
            'end_range'=>'nullable|numeric|min:0'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }

        $query_appointments = Order::select('*');

        $start_range = $request->query('start_range');
        $end_range = $request->query('end_range');

        if($start_range && $end_range){
            $query_appointments->whereBetween('total', [$start_range, $end_range]);
        }

        $data = $query_appointments->get();
        return response()->json($data,200);

    }

    public function total_orders_by_user($id){
        //SELECT COUNT(*) FROM orders WHERE user_id = 9;
        $orders = Order::where('user_id', $id)->count();

        return response()->json([
            'total_orders' => $orders
        ], 200);
    }

    public function orders_with_user_info(){
        /* SELECT orders.id as order_id, orders.product, orders.amount, orders.total, 
            users.id as user_id, users.name as user_name, users.email as user_email, users.phone as user_phone
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        ORDER BY orders.total DESC;*/
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.id as order_id', 'orders.product', 'orders.amount', 'orders.total',
                'users.id as user_id', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone')
        ->orderBy('orders.total', 'desc')
        ->get();

        if(count($orders)>0){
            return response()->json($orders,200);
        }
        return response()->json([],200);
    }

    public function total_sum(){
        //SELECT SUM(total) AS totalSum FROM orders;
        $totalSum = Order::sum('total');

        if ($totalSum == 0) {
            return response()->json([
                'message' => 'No orders found.',
                'total_sum' => $totalSum
            ], 404);
        }
    
        return response()->json([
            'total_sum' => $totalSum
        ], 200);
    }

    public function get_cheapest_order(){
        /* SELECT orders.id as order_id, orders.product, orders.amount, orders.total, users.name as user_name FROM orders INNER JOIN users ON orders.user_id = users.id ORDER BY orders.total ASC LIMIT 1; */
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.id as order_id', 'orders.product', 'orders.amount', 'orders.total', 'users.name as user_name')->orderBy('orders.total', 'asc')->first();

        if ($order) {
            return response()->json($order, 200);
        }

        return response()->json(['message' => 'No orders found'], 404);
    }

    public function get_orders_grouped_by_user(){
        /*SELECT users.name as user_name, orders.product, orders.amount, orders.total
            FROM orders INNER JOIN users ON orders.user_id = users.id GROUP BY users.name, orders.product, orders.amount, orders.total;*/
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')->select('users.name as user_name', 'orders.product', 'orders.amount', 'orders.total')->groupBy('users.name', 'orders.product', 'orders.amount', 'orders.total')->get();
    
        return response()->json($orders, 200);
    }
}
