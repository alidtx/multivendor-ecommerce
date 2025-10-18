<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-18
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateInvoiceJob;
use App\Models\Order;

class GenerateInvoiceCommand extends Command
{
    protected $signature = 'invoice:generate';
    protected $description = 'Generate invoices for all buyers with paid and non-invoiced orders';

    public function handle(): void
    {

        $orders = Order::where('status', 'paid')
            ->where('invoiced', false)
            ->get();

        if ($orders->isEmpty()) {
            $this->info('No eligible orders found for invoice generation.');
            return;
        }

        foreach ($orders as $order) {
            GenerateInvoiceJob::dispatch($order);
            $this->info("Invoice generation job dispatched for Order #{$order->id} (Buyer ID: {$order->buyer_id})");
        }

        $this->info('✅ All invoice generation jobs have been dispatched successfully.');
    }
}
