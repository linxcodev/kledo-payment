<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeletePayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $paymentID;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($paymentID)
    {
        $this->paymentID = $paymentID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      Payment::whereIn('id', $this->paymentID)->delete();
    }
}
