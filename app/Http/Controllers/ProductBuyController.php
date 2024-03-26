<?php

namespace App\Http\Controllers;

use App\Models\ProductBuy;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductBuyUpdateRequest;

class ProductBuyController extends Controller
{

    public function __construct()
    {
       $this->middleware('permission:purchase view',['only'=>['index']]);
       $this->middleware('permission:purchase create',['only'=>['create', 'store']]);
        $this->middleware('permission:purchase update',['only'=>['edit', 'update']]);
        $this->middleware('permission:purchase delete',['only'=>['destroy']]);

    }


    public function index(){
        $purchases = ProductBuy::all();
        return view('purchase.index')->with('purchases', $purchases); 
    }

    public function create(){
        return view('purchase.create');
    }

   
    
    public function store(Request $request)
    {
        $image_path = '';
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('purchase', 'public');
        }
    
        $purchase = ProductBuy::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
    
        if (!$purchase) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating the purchase.');
        }
    
        return redirect()->route('purchase.index')->with('success', 'Success, your purchase has been created.');
    }



    public function edit(ProductBuy $purchase)
    {
        return view('purchase.edit')->with('purchase', $purchase);
    }



    public function update(Request $request, ProductBuy $purchase)
    {
        $purchase->name = $request->name;
        $purchase->description = $request->description;
       
        $purchase->price = $request->price;
        $purchase->quantity = $request->quantity;
      

        if ($request->hasFile('image')) {
            // Delete old image
            if ($purchase->image) {
                Storage::delete($purchase->image);
            }
            // Store image
            $image_path = $request->file('image')->store('purchase', 'public');
            // Save to Database
            $purchase->image = $image_path;
        }

        if (!$purchase->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating purchase.');
        }
        return redirect()->route('purchase.index')->with('success', 'Success, your purchase have been updated.');
    }
    


    public function destroy(ProductBuy $purchase)
    {
        if ($purchase->image) {
            Storage::delete($purchase->image);
        }
        $purchase->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
