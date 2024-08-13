<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contacts(Request $request)
    {
        // Get sorting parameters from the request
        $sortField = $request->get('sort', 'created_at'); // Default sort by 'created_at'
        $sortOrder = $request->get('order', 'asc'); // Default sort order is 'asc'

        // Ensure valid sort field
        if (!in_array($sortField, ['name', 'created_at'])) {
            $sortField = 'created_at';
        }

        // Ensure valid sort order
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        // Search functionality
        $search = $request->get('search');
        $contracts = Contract::where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            }
        })
            ->orderBy($sortField, $sortOrder)
            ->get();

        return view('layouts.index', compact('contracts', 'search', 'sortField', 'sortOrder'));
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

    public function edit($id)
    {
        $data = Contract::findOrFail($id);
        return view('layouts.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Find the contract by ID, or fail if not found
        $data = Contract::find($id);

        if (!empty($data)) {
            $validation = Validator::make($request->all(), [
                'name'    => 'required|string|max:255',
                'email'   => 'required|email',
                'phone'   => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
            ], [
                'name'    => 'name is Required',
                'email'   => 'email is Required',
                'phone'   => 'phone is Required',
                'address' => 'address is Required',
            ]);

            // If validation fails, return with errors
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            } else {
                // Update the contract data
                try {
                    $data->name    = $request->name;
                    $data->email   = $request->email;
                    $data->phone   = $request->phone;
                    $data->address = $request->address;
                    $data->save();
                    return redirect()->route('contacts.all')->with('success', 'Contact updated successfully.');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to update contact: ' . $e->getMessage());
                }
            }
        }
    }



    public function show(Request $request, $id)
    {
        $data = Contract::find($id);
        if (!empty($data)) {
            return view('layouts.show', compact('data'));
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $data = Contract::findOrFail($id);
        if (!empty($data)) {
            $data->delete();
        }
        return redirect()->route('contacts.all');
    }
}
