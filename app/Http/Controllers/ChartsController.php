<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Product;
use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->count();
        $categories = Category::all()->count();
        $products = Product::all()->count();
       // $launch = DB::table("visitors")->orderBy('created_at', 'asc')->first('created_at');
        //$difference = Carbon::now()->diffInDays($launch->created_at, true);
        return view('layouts/AdminPanel/index', [
            'members' => $users,
            'items' => $categories,
            'reports' => $products,
          //  'difference' => $difference,
        ]);
    }

    public function chart()
    {
        $data = DB::table('order_product')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->select(
                'products.name as name', DB::raw('SUM(order_product.quantity) as total_qty'))
            ->groupBy('order_product.product_id')
            ->orderBy('total_qty','desc')
            ->get()
            ->take(4);
        $array [] = ['Product', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->name, $value->total_qty];
        }
        return [
            'name' => response()->json($array),
        ];
    }

    public function chart1()
    {
        $data1 = DB::table('products')
            ->select(
                DB::raw('name as prod'),
                DB::raw('average as number'))
            ->groupBy('prod')
            ->orderBy('number','desc')
            ->get()
            ->take(4);
        $array1 [] = ['Prod', 'Number'];
        foreach ($data1 as $key => $value) {
            $array1[++$key] = [$value->prod, $value->number];
        }
      // return $array1;
        return [
            'prod' => response()->json($array1)
        ];
    }

    public function chart2()
    {
        $data1 = DB::table('users')
            ->select(
                DB::raw('name as user'),
                DB::raw('orders_count as number'))
            ->groupBy('user')
            ->orderBy('number','desc')
            ->get()
            ->take(4);
        $array2 [] = ['User', 'Number'];
        foreach ($data1 as $key => $value) {
            $array2[++$key] = [$value->user, $value->number];
        }
      // return $array1;
        return [
            'user' => response()->json($array2)
        ];
    }

   
}
