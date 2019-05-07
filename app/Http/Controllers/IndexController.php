<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Brand;
use App\Product;
use App\Productdetail;
use App\Color;
use App\Size;
use App\Material;
use Cart;
use App\Order;
use App\Orderdetail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $new_products = Product::orderBy('created_at', 'desc')->take(4)->get();
        $old_products = Product::orderBy('created_at', 'asc')->take(4)->get();
        return view('content', compact('categories', 'brands', 'new_products', 'old_products'));
    }

    public function getProductdetail($slug)
    {
        $products = Product::where('slug', $slug)->get();
        $categories = Category::all();
        $getProductalls = Product::all();
        $colors = Color::all();
        $brands = Brand::all();
        $sizes = Size::orderBy('name', 'asc')->get();
        $materials = Material::all();
        foreach($products as $product)
        {
            $product_id = $product->id;
            $getProducts = Product::where('id', $product_id)->get();

            $getRandoms = Product::where('brand_id', $product->brand_id)->inRandomOrder()->limit(4)->get();

            foreach($getProducts as $getProduct)
            {
                $getProductdetails = $getProduct->productdetails;
                $getProductimages = $getProduct->productimages;
            }
        }

        return view('view_detail', compact('getProductalls', 'products', 'categories', 'getProductdetails', 'getProductimages', 'brands', 'getProduct', 'colors', 'sizes', 'materials', 'getRandoms'));
    }

    public function searchPro(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('name', 'LIKE', '%'.$request->search.'%')->orWhere('slug', 'LIKE', '%'.$request->search.'%')->orWhere('description', 'LIKE', '%'.$request->search.'%')->get();

        return view('view_searchproduct', compact('products', 'categories'));
    }

    public function getBrand($slug)
    {
        $brands = Brand::where('slug', $slug)->select('id')->get();
        $categories = Category::all();
        foreach($brands as $brand)
        {
            $products = Product::where('brand_id', $brand->id)->get();
        }
        
        return view('view_brand', compact('products', 'categories'));
    }

    public function getCate($slug)
    {
        $cates = Category::where('slug', $slug)->select('id')->get();
        $categories = Category::all();
        foreach($cates as $cate)
        {
            $products = Product::where('category_id', $cate->id)->get();
        }
        
        return view('view_category', compact('products', 'categories'));
    }

    public function getPro()
    {
        $categories = Category::all();
        $products = Product::all();
        
        return view('view_allproduct', compact('products', 'categories'));
    }

    public function changQuantity(Request $request, $rowId)
    {
        $status = $request->status;
        $product = Cart::get($rowId);
        if($product->qty == 1 && $status == -1)
        {
            $id = $rowId;
            $remove = Cart::remove($rowId);
            $cart_subtotal = Cart::subtotal();
            $cart_count = Cart::count();
            return response()->json(['update' => 1, 'rowId' => $id, 'cart_subtotal' => $cart_subtotal, 'cart_count' => $cart_count]);
        } 
        else
        {
            $new_qty = $product->qty + $status;
            $update = Cart::update($rowId, ['qty' => $new_qty]);
            $cart_subtotal = Cart::subtotal();
            $cart_count = Cart::count();
            return response()->json(['update' => $update, 'cart_subtotal' => $cart_subtotal, 'cart_count' => $cart_count]);
        }
    }

    public function checkout()
    {
        $orders = new Order();
        $orderdetails = new Orderdetail();
        $checkout_orders = Cart::content();

        $orders->code = rand(1000,9000);
        $orders->customer_name = Auth::user()->name;
        $orders->customer_mobile = Auth::user()->phone;
        $orders->customer_address = Auth::user()->address;
        $orders->status = "Đang chờ";
        $orders->save();

        foreach($checkout_orders as $checkout_order)
        {
            $getSizes = Size::where('name', $checkout_order->options->size)->select('id')->get();
            $getColors = Color::where('description', $checkout_order->options->color)->select('id')->get();

            $orderdetails->order_id = $orders->id;
            $orderdetails->product_id = $checkout_order->id;
            $orderdetails->quantity = $checkout_order->qty;
            foreach($getSizes as $getSize)
            {
                $orderdetails->size_id = $getSize->id;
            }
            foreach($getColors as $getColor)
            {
                $orderdetails->color_id = $getColor->id;
            }
            $orderdetails->save();
        }
        Cart::destroy();

        return response()->json(['checkout_order' => $checkout_orders]);
    }

    public function cart()
    {
        $categories = Category::all();
        $datas = Cart::content();
        return view('checkout', ['datas' => $datas, 'categories' => $categories]);
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);
        $count = Cart::count();
        $subtotal = Cart::subtotal(0);
        return response()->json(['rowId' => $rowId, 'count' => $count, 'subtotal' => $subtotal]);
    }

    public function addcart(Request $request)
    {
        $productdetails = Productdetail::where('product_id', $request->id)->select('id')->get();
        $price_total = 0;
        $sub_quantity = 0;
        foreach($productdetails as $productdetail)
        {
            $getProductdetails = Productdetail::where('id', $productdetail->id)->where('quantity','>=',$request->quantity)->get();
            foreach($getProductdetails as $getProductdetail)
            {
                $quantity =  $getProductdetail->quantity;
                $product_name = $getProductdetail->product->name;
                $product_price = $getProductdetail->product->price;
                $getProductImage = $getProductdetail->product->thumbnail;
                if($request->color == $getProductdetail->color_id)
                {
                    $color_description = $getProductdetail->color->description;
                }
                if($request->size == $getProductdetail->size_id)
                {
                    $size_name = $getProductdetail->size->name;
                }
            }
        }
        
        $price_total += $request->quantity * $product_price;

        $add_cart = Cart::add(['id' => $request->id, 'name' => $product_name, 'qty' => $request->quantity, 'price' => $product_price, 'options' => ['size' => $size_name, 'color' => $color_description, 'image' => $getProductImage, 'subtotal' => number_format($price_total)]]);
        $data = Cart::content();
        $subtotal = Cart::subtotal(0);
        $total = Cart::total(0);
        $count = Cart::count();
        if($add_cart)
        {
            return response()->json(['data' => $data, 'add_cart' => $add_cart, 'count' => Cart::count(), 'subtotal' => $subtotal, 'total' => $total, 'count' => $count]);
        }
    }

    public function getSizeByColor(Request $request)
    {
        $arr_ids = Productdetail::where('product_id', $request->product_id)->where('color_id', $request->color_id)->select('size_id')->get();

        $size_ids = Size::select('id', 'name')->whereIn('id', $arr_ids)->get();
        return response()->json(['size_ids' => $size_ids]);
    }

    public function getQuantityByProductDetail(Request $request)
    {
        $arr_ids = Productdetail::where('product_id', $request->product_id)->where('size_id', $request->size_id)->select('quantity')->get();
        return response()->json(['arr_ids' => $arr_ids]);
    }

    public function postRate(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $product = Product::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $product->ratings()->save($rating);
        
        return redirect()->route("posts");
    }
}
