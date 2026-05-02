<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return response()->json(Branch::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
          //  'CompanyId' => 'required|integer',
            'BranchCode' => 'required|unique:branches,BranchCode',
            'BranchName' => 'required|string',
            'Region' => 'nullable|string',
            'District' => 'nullable|string',
            'Ward' => 'nullable|string',
            'Street' => 'nullable|string',
            'PhysicalAddress' => 'nullable|string',
            'Longitude' => 'nullable|numeric',
            'Latitude' => 'nullable|numeric',
            'Phone' => 'nullable|string',
            'Email' => 'nullable|email',
        ]);

        $branch = Branch::create($data);

        return response()->json([
            'message' => 'Branch created successfully',
            'data' => $branch
        ]);
    }

    public function show($id)
    {
        return response()->json(Branch::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update($request->all());

        return response()->json([
            'message' => 'Branch updated successfully',
            'data' => $branch
        ]);
    }

    public function destroy($id)
    {
        Branch::destroy($id);

        return response()->json([
            'message' => 'Branch deleted successfully'
        ]);
    }
}