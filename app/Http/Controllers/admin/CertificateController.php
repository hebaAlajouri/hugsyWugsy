<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        Certificate::create($request->all());
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $certificate->update($request->all());
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted.');
    }
}