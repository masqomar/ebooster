<?php

namespace App\Http\Controllers\Subdomain;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Period;
use App\Models\Program;
use App\Models\Student;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function index(Request $request, Tenant $tenant)
    {
        $tenant->visit()->withIP()->withSession();

        return view('subdomain.index', compact('tenant'));
    }

    public function registerByAff(Request $request, Tenant $tenant, $id)
    {
        $program = Program::with('periods')->find($id);
        
        return view('subdomain.register', compact('tenant', 'program'));
    }

    public function checkingCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->where('program_id', $request->program_id)->first();
        if ($coupon == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kupon tidak tersedia!'
            ]);
        } else {
            $discount = $coupon->amount;
            return response()->json([
                'discountAmount' => $discount,
                'couponId' => $coupon->id,
                'message' => 'Kupon diskon berhasil dipasang!'
            ]);
        }
    }

    public function store(Request $request)
     {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|unique:users|max:255',
            'phone_number'  => 'required|unique:students,phone_number',
            'gender'        => 'required|string',
            'address'       => 'required|string|max:255',
            'program_id'    => 'required|string|max:255',
            'period_id'     => 'required|integer',
            'coupon_code'   => 'nullable|string|max:255',
            'coupon_id'     => 'nullable|string|max:255',
            'aff_id'        => 'required|integer'
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'),
                'level'  => 2,
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'address' => $request->address
            ]);

            $program = Program::where('id', $request->program_id)->first();
            $periode = Period::where('id', $request->period_id)->first(); 
            $coupon = Coupon::where('id', $request->coupon_id)->first();
            $admin_fee = 0;           
            $programPrice = $program->price;

            if ($request->coupon_code != null) {
                $discount = $coupon->amount;
                $discountPayment = $admin_fee + $programPrice - $discount;
                $downPayment = round($discountPayment * 0.2);
                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'total_purchases' => $discountPayment,
                    'maximum_payment_time' => Carbon::now()->addDays(1),
                    'code' => Transaction::generateCode(),
                    'transaction_status' => 'pending',
                    'invoice' => 'EB.' . date('dmy') . '.' . rand(1000, 9999),
                    'program_id' => $request->program_id,
                    'discount' => $discount,
                    'admin_fee' => $admin_fee,
                    'down_payment' => $downPayment,
                    'period' => $periode->period_date,
                    'aff_id' => $request->aff_id
                ]);

                $payload = [
                    'transaction_details' => [
                        'order_id'     => $transaction->invoice,
                        'gross_amount' => $downPayment,
                    ],
                    'customer_details' => [
                        'first_name'    => $user->name,
                        'email'         => $user->email,
                        'phone'         => $student->phone_number
                    ],
                    'item_details' => [
                        [
                            'id'            => $transaction->invoice,
                            'price'         => $downPayment,
                            'quantity'      => 1,
                            'name'          => 'Down Paymnet Program ' . $program->name,
                            'brand'         => 'English Booster',
                            'category'      => 'English Course',
                            'merchant_name' => config('app.name'),
                        ],
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($payload);
                $transaction->snap_token = $snapToken;
                $transaction->save();

            } else {
                $payment = $admin_fee + $programPrice;
                $dp = round($payment * 0.2);
                $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'total_purchases' => $admin_fee + $programPrice,
                    'maximum_payment_time' => Carbon::now()->addDays(1),
                    'code' => Transaction::generateCode(),
                    'transaction_status' => 'pending',
                    'invoice' => 'EB.' . date('dmy') . '.' . rand(1000, 9999),
                    'program_id' => $request->program_id,
                    'discount' => 0,
                    'admin_fee' => $admin_fee,
                    'down_payment' => $dp,
                    'period' => $periode->period_date,
                    'aff_id' => $request->aff_id
                ]);
                
                $payload = [
                    'transaction_details' => [
                        'order_id'     => $transaction->invoice,
                        'gross_amount' => $dp,
                    ],
                    'customer_details' => [
                        'first_name'    => $user->name,
                        'email'         => $user->email,
                        'phone'         => $student->phone_number
                    ],
                    'item_details' => [
                        [
                            'id'            => $transaction->invoice,
                            'price'         => $dp,
                            'quantity'      => 1,
                            'name'          => 'Down Paymnet Program ' . $program->name,
                            'brand'         => 'English Booster',
                            'category'      => 'English Course',
                            'merchant_name' => config('app.name'),
                        ],
                    ],
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($payload);
                $transaction->snap_token = $snapToken;
                $transaction->save();
            }
            
            DB::commit();

            return redirect('payment/' . $transaction->id . '/down-payment');
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }

        return view('subdomain.index');
    }
}
