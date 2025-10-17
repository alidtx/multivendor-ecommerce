<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateInvoiceJob;
use App\Models\Order;

class GenerateInvoiceCommand extends Command
{

    protected $signature = 'invoice:generate {buyer_id}';
    protected $description = 'Generate invoice(s) for orders of a specific buyer';

    public function handle(): void
    {
        $buyerId = $this->argument('buyer_id');

        if ($buyerId) {
            
            $orders = Order::where('buyer_id', $buyerId)
            ->where('status', 'paid')
            ->get();

            if ($orders->isEmpty()) {
                $this->error("No orders found for buyer ID {$buyerId}.");
                return;
            }

            foreach ($orders as $order) {
                GenerateInvoiceJob::dispatch($order);
                $this->info("Invoice generation job dispatched for order #{$order->id}");
            }

        } else {
            $this->error("Please provide a buyer ID to generate invoices.");
        }
    }
}
