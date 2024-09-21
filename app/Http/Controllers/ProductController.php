<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\DNS1D;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:product view', ['only' => ['index']]);
        $this->middleware('permission:product create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $products = new Product();
        if ($request->search) {
            $products = $products->where('name', 'LIKE', "%{$request->search}%");
        }
        $products = $products->latest()->paginate(10);
        if (request()->wantsJson()) {
            return ProductResource::collection($products);
        }
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('products', 'public');
        }
    
        $number = mt_rand(10000, 99999);

        if ($this->productCodeExist($number)) {
            $number = mt_rand(10000, 99999);
        }


        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'barcode' => $request['barcode'] = $number,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status
        ]);
     
        if (!$product) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating the product.');
        }


        return redirect()->route('products.index')->with('success', 'Success, your product has been created.');
    }

    public function productCodeExist($number)
    {
        return Product::wherebarcode($number)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Store image
            $image_path = $request->file('image')->store('products', 'public');
            // Save to Database
            $product->image = $image_path;
        }

        if (!$product->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, your product have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            'success' => true
        ]);
    }


    public function shortage()
    {
        $warningQuantity = Setting::where('key', 'warning_quantity')->value('value');

        $products = Product::where('quantity', '<=', $warningQuantity)->paginate(10);

        return view('products.shortage', compact('products'));
    }


    public function print(Product $product)
    {
        return view('products.barcodeprint', compact('product'));
    }

    public function importProduct()
    {
        return view('products.import');
    }

    public function uploadProduct(ProductStoreRequest $request)
    {

        Excel::import(new ProductsImport, $request->file);
        return redirect()->route('products.index')->with('success', 'Success, your product have been imported.');
    }
}
