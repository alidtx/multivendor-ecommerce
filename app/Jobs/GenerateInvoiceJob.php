<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18
namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 60; 

    protected int $orderId;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
       
        $this->orderId = $order->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
         
            $order = Order::find($this->orderId);

            if (!$order) {
                Log::warning("Order not found for invoice generation: {$this->orderId}");
                return;
            }

            if ($order->invoiced) {
                Log::info("Order {$order->id} already invoiced. Skipping.");
                return;
            }

            $order->update(['invoiced' => true]);

            Log::info('Invoice generated successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'total_amount' => $order->total_amount,
                'status' => $order->status,
                'invoiced' => $order->invoiced,
            ]);

        } catch (\Throwable $e) {
            Log::error('Failed to generate invoice', [
                'order_id' => $this->orderId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
