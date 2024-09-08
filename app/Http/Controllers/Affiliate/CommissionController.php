<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Transaction;

class CommissionController extends Controller
{
    public function index()
    {
        $affId = Tenant::where('user_id', auth()->user()->id)->first();

        $commissions = Transaction::with('transaction_details')->where('aff_id', $affId->id)->get();
        // $linkVisits = Tenant::with('user:id,name')->where('user_id', auth()->user()->id)->first();

        // return json_encode($affId);
        return view('affiliate.commission.index', compact('affId', 'commissions'));
    }
}
