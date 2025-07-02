<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;

class VendorsExport implements FromView
{
    protected $from;
    protected $to;

   public function __construct($from = null, $to = null)
{
    $this->from = $from;
    $this->to = $to;
}

public function view(): View
{
    $query = User::where('role', 'vendor');

    if ($this->from && $this->to) {
        $query->whereBetween('created_at', [
            $this->from . ' 00:00:00',
            $this->to . ' 23:59:59'
        ]);
    }

    $vendors = $query->get();

    return view('exports.vendors', compact('vendors'));
}

}

