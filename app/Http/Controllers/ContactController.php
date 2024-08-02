<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contacts()
    {
        $contracts = Contract::all();
        return view('layouts.index', compact('contracts'));
    }

    public function create()
    {
        return view('layouts.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:contracts,email',
            'phone'   => 'string|max:15',
            'address' => 'string|max:255',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $contract = new Contract;
            $contract->name    = $request->name;
            $contract->email   = $request->email;
            $contract->phone   = $request->phone;
            $contract->address = $request->address;
            $contract->save();
            return redirect()->route('contacts.all');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
