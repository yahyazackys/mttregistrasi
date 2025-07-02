<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VendorsExport;

class VendorController extends Controller
{

  

    public function profile()
{
    $vendor = auth()->user();
    return view('vendor.profile', compact('vendor'));
}

public function update(Request $request)
{
    $request->validate([
        'pic_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'document_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ]);

    $user = auth()->user();
    $user->pic_name = $request->pic_name;
    $user->phone = $request->phone;

    if ($request->hasFile('document_file')) {
        // Hapus file lama jika ada
        if ($user->document_file) {
            Storage::delete('public/' . $user->document_file);
        }

        // Simpan file baru
        $path = $request->file('document_file')->store('documents', 'public');
        $user->document_file = $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

public function listVendors(Request $request)
{
    $query = User::where('role', 'vendor');

    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('created_at', [
            $request->from . ' 00:00:00',
            $request->to . ' 23:59:59'
        ]);
    }

    $vendors = $query->get();
    return view('vendor.index', compact('vendors'));
}

public function showVendor($id)
{
    $vendor = \App\Models\User::where('role', 'vendor')->findOrFail($id);
    return view('vendor.show', compact('vendor'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected'
    ]);

    $vendor = \App\Models\User::where('role', 'vendor')->findOrFail($id);
    $vendor->status = $request->status;
    $vendor->save();

    return back()->with('success', 'Status vendor berhasil diperbarui.');
}

public function exportExcelvendor(Request $request  )
{
      $from = $request->from;
    $to = $request->to;

    return Excel::download(new VendorsExport($from, $to), 'vendors.xlsx');
}

}
