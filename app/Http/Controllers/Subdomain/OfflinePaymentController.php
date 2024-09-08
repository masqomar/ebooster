<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfflinePaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }


    public function payment(Tenant $tenant, $id)
    {
        $transaction = Transaction::with('user.student')->findOrfail($id);
        
        return view('subdomain.program-offline.down-payment', compact('transaction'));
    }

    public function downPaymentSuccess(Tenant $tenant, $id)
    {
        $transaction = Transaction::with('user.student')->findOrfail($id);

        return view('subdomain.program-offline.down-payment-success', compact('transaction'));
    }

    public function fullPayment(Tenant $tenant, $id)
    {
        $transaction = Transaction::with('user.student')->where('transaction_status', 'paid')->findOrfail($id);
       
        return view('subdomain.program-offline.full-payment', compact('transaction'));
    }

    public function fullPaymentStore(Request $request)
    {
        $validated = $request->validate([
            'transaction_id'       => 'required|string|max:255',
            'tshirt_size'          => 'required|string|max:255'
        ]);

        $transactionId = Transaction::where('id', $request->transaction_id)->first();
        $fullPayment = $transactionId->admin_fee + $transactionId->program->price - $transactionId->discount - $transactionId->down_payment;

        DB::beginTransaction();
        try {
            $transactionDetail = TransactionDetail::create([
                'transaction_id'    => $request->transaction_id,
                'invoice'           => 'EB.' . date('dmy') . '.' . rand(1000, 9999),
                'tshirt_size'       => $request->tshirt_size,
                'full_payment'      => $fullPayment,
                'payment_status'    => 'pending'
            ]);

            $payloadFullPayment = [
                'transaction_details' => [
                    'order_id'     => $transactionDetail->invoice,
                    'gross_amount' => $fullPayment,
                ],
                'customer_details' => [
                    'first_name'    => $transactionId->user->name,
                    'email'         => $transactionId->user->email,
                    'phone'         => $transactionId->user->student->phone_number
                ],
                'item_details' => [
                    [
                        'id'            => $transactionDetail->invoice,
                        'price'         => $fullPayment,
                        'quantity'      => 1,
                        'name'          => 'Pelunasan Program ' . $transactionId->name,
                        'brand'         => 'English Booster',
                        'category'      => 'English Course',
                        'merchant_name' => config('app.name'),
                    ],
                ],
            ];

            $snapTokenFullPayment = \Midtrans\Snap::getSnapToken($payloadFullPayment);
            $transactionDetail->snap_token = $snapTokenFullPayment;
            $transactionDetail->save();

            DB::commit();

            return redirect('payment/' . $transactionDetail->id . '/full-payment-detail');
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }

        return view('subdomain.index');
    }

    public function fullPaymentDetail(Tenant $tenant, $id)
    {
        $transactionDetails = TransactionDetail::with('transaction.program', 'transaction.user.student')->findOrfail($id);

        return view('subdomain.program-offline.full-payment-detail', compact('transactionDetails'));
    }

    public function fullPaymentSuccess(Tenant $tenant, $id)
    {
        $transactionDetails = TransactionDetail::with('transaction.program', 'transaction.user.student')->findOrfail($id);

        return view('subdomain.program-offline.full-payment-success', compact('transactionDetails'));
    }
}
