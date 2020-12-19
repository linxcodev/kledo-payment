<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Jobs\DeletePayment;
use Illuminate\Http\Request;
use App\Events\PaymentDeleted;
use App\Http\Requests\StorePayment;

class PaymentController extends Controller
{
  public function index()
  {
    $payments = Payment::orderBy('created_at', 'desc')->paginate(5);
    return view('index', compact('payments'));
  }

  public function store(StorePayment $request)
  {
    Payment::create(['payment_name' => $request->payment_name]);
    return back()->with('success', 'Berhasil Menambah Payment.');
  }

  public function delete(Request $request)
  {
    foreach (explode(",",$request->ids) as $key => $paymentID) {
      // Pesan pusher
      event(new PaymentDeleted($key+1));

      // Hapus data payment
      DeletePayment::dispatch(explode(",",$paymentID));
    }

    event(new PaymentDeleted('success'));
  }
}
