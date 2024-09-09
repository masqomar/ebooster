<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $affId = Tenant::where('user_id', auth()->user()->id)->first();
        $totalVisitCount = Tenant::where('user_id', auth()->user()->id)->withTotalVisitCount()->first()->visit_count_total ?? '0';
        if ($affId) {
            $totalLead = Transaction::where('aff_id', $affId->id)->count();
            $totalPurchases = Transaction::where('aff_id', $affId->id)->sum('total_purchases');
            $totalDP = Transaction::where('aff_id', $affId->id)->sum('down_payment');
            $totalFullPayment = DB::table('transactions')
            ->join('transaction_details', 'transaction_details.transaction_id', 'transactions.id')
            ->where('aff_id', $affId->id)
            ->sum('full_payment');
        } else {
            $totalLead = 0;
            $totalPurchases = 0;
            $totalDP = 0;
            $totalFullPayment = 0;
        }
       
      
       

        $potentialOffCommission = round(($totalDP + $totalFullPayment) * 0.1);
        $potentialOnCommission = round($totalPurchases * 0.1);
        $potentialCommission = round($totalPurchases * 0.1);

        // return json_encode($potentialCommission);
        return view('dashboard', compact('affId', 'totalVisitCount', 'totalLead', 'potentialCommission'));
    }
}
