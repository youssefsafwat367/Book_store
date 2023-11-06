<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $branches =  Branch::all();
        if (auth()->user() != NULL) {
            if (auth()->user()->role == "user") {

                $carts = Cart::where('user_id', '=', auth()->user()->id)->where('status', '=', 'قيد التنفيذ')->get();
                return view('front.branches', ['branches' => $branches, 'carts' => $carts, 'categories' => $categories]);
            } elseif (auth()->user()->role == "admin") {
                $branches = Branch::all();
                return view('admin.branches.branches', compact('branches'));
            }
        } else {
            return view('front.branches', ['branches' => $branches]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = $request->validate(
            [
                'short_address' => 'required:',
                'full_address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
            ]

        );
        Branch::create($branch);
        return back()->with('success', 'The branch Is Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::find($id);
        return view('admin.branches.edit_branch', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::find($id);
        $new_branch = $request->validate(
            [
                'short_address' => 'required:',
                'full_address' => 'required',
                'city' => 'required',
                'phone' => 'required|numeric',
            ]
        );
        $branch->update($new_branch);
        return redirect()->route('admin.branches')->with('success', 'The Branch Is Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return redirect()->route('admin.branches')->with('danger', 'The Branch is Deleted Successfully');
    }
}
