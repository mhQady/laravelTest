<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class productcontroller extends Controller
{
    public function index()
    {
        // $products = DB::select('SELECT * FROM `users`');
        $products = DB::table('users')->select('*')->get();
        return view('admin.products.all', compact('products'));
    }

    public function create()
    {
        return view('admin.products.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | string |min:2',
            'email' => 'required',
            'password' => 'required',
            'photo' => ''
        ];

        // $request->validate($rules);

        $validated = $request->except('_token', 'photo');


        $validated = $request->validate($rules);


        DB::table('users')->insert($validated);

        return redirect('products/all');
    }

    public function edit($id)
    {
        $product = DB::table('users')->select('*')->where('id', $id)->first();
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required | string | min:2',
            'email' => 'required',
            'password' => 'required',
            'photo' => ''
        ];

        $request->validate($rules);
        $validated = $request->except('_token', '_method', 'photo');
        $check = DB::table('users')->where('id', $id)->update($validated);
        if ($check) {
            return redirect()->back()->with('success', 'the product has been updated');
        }
        return redirect()->back()->with('error', 'something went wrong');
    }

    public function delete(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'the product has been deleted');
    }
}
