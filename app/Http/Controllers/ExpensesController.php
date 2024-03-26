<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct()
    {
       $this->middleware('permission:expenses view',['only'=>['index']]);
       $this->middleware('permission:expenses create',['only'=>['create', 'store']]);
       $this->middleware('permission:expenses update',['only'=>['edit', 'update']]);
       $this->middleware('permission:expenses delete',['only'=>['destroy']]);

    }

    public function index(){
        
        return view('expenses.index')
                    ->with('expenses', Expenses::paginate(10));
    }


    public function create(){
        return view('expenses.create');
    }


    public function store(Request $request){
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
           
        ]);

        $expenses = Expenses::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'user_id' => $request->user()->id,

    ]);


        if (!$expenses->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating the Expenses.');
        }

        return redirect()->route('expenses.index')->with('success', 'Success, the Expenses has been created.');
    }


    public function edit(Expenses $expense)
    {
            
        return view('expenses.edit')->with('expense', $expense);
    }

    public function update(Request $request, Expenses $expense)
    {
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->user_id = $request->user()->id;
        $expense->updated_at = $request->update_at;
      

       

        if (!$expense->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating Expense.');
        }
        return redirect()->route('expenses.index')->with('success', 'Success, your Expense have been updated.');
    }


    public function destroy(Expenses $expense)
    {
        $expense->delete();

       return response()->json([
           'success' => true
       ]);
    }
}
