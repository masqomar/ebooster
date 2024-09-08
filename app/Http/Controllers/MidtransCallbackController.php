<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function midtransCallback(Request $request)
    {
        $json = json_decode($request->getContent());
        $transactionStatus = $json->transaction_status;
        $orderId = $json->order_id;

        if ($transactionStatus == 'settlement') {
            Transaction::where('invoice', $orderId)->update([
                'transaction_status' => 'paid',
            ]);
            $transaction = Transaction::where('invoice', $orderId)->first();

            // $admin = User::find('20b2a4122c614bb68e41b1a6f3f37780');
            // $admin->notify(new SendTransactionNotification($transaction));

            // $message = "*Pembayaran Terverifikasi*\n\n_Terimakasih telah menjadi bagian dari kami, semoga English Booster Kampung Inggris dapat membantu proses belajar kamu. aamiin._";
            // sendWhatsappNotification($transaction->user->student->phone_number, $message);
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
             Transaction::where('invoice', $orderId)->update([
                'transaction_status' => 'failed',
            ]);

            $transaction = Transaction::where('invoice', $orderId)->first();

            // $admin = User::find('20b2a4122c614bb68e41b1a6f3f37780');
            // $admin->notify(new SendTransactionNotification($transaction));

            // $message = "*Pembayaran Gagal*\n\n_Silahkan hubungi admin untuk proses pembayaran. Terima kasih._";
            // sendWhatsappNotification($transaction->user->student->phone_number, $message);
        }
        
        return response()->json(['status' => 'success']);
    }
}
