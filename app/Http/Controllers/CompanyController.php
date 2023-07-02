<?php

namespace App\Http\Controllers;

use App\Models\companies;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $companies = companies::orderBy('id','desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        return view('companies.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        companies::create($request->post());

        return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }
    public function show(companies $company)
    {
        return view('companies.show',compact('company'));
    }
    public function edit(companies $company)
    {
        return view('companies.edit',compact('company'));
    }
    public function update(Request $request, companies $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $company->fill($request->post())->save();

        return redirect()->route('companies.index')->with('success','Company Has Been updated successfully');
    }
    public function destroy(companies $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }
}
