
1. Design Overview

The system follows clean architecture principles with clear separation of concerns:

Controllers handle HTTP requests and responses only.

Services contain all business logic.

Repositories handle database interactions.

Observers / Events / Listeners implement decoupled event-driven actions.

Jobs for asynchronous tasks (invoice generation, email simulation, balance updates).

Benefits:

Testability: business logic separated from controllers.

Flexibility: adding new listeners or features without touching core logic.

Transaction safety: all operations wrapped in DB transactions.

2. Entity Relationships

User: buyers and sellers.

Product: belongs to seller.

Order: belongs to buyer, has many order items.

OrderItem: belongs to Order and Product, includes quantity, price, seller_id.

Reasoning:
We use Eloquent relationships to avoid repetitive queries and ensure data integrity. seller_id in OrderItem allows quick access to each seller’s balance.

3. Order Placement Flow

Validate stock and compute totals in OrderService.

Wrap order creation in a DB transaction to ensure atomicity.

Reduce product stock inside the transaction.

Fire OrderPlaced event to trigger listeners.

Trade-offs:

Validation logic kept in service, not controller.

Avoided putting stock deduction in controller to maintain single responsibility principle.

4. Events & Observers
Mechanism	Purpose
OrderObserver	Assigns unique order number before saving
OrderPlaced Event	Broadcasts domain change
UpdateSellerBalanceListener (queued)	Updates seller balances asynchronously
SendOrderConfirmationListener (queued)	Simulates sending emails
AuditTrailListener	Appends structured log for auditing

Reasoning:

Event-driven architecture decouples services from side-effects.

Queued listeners prevent blocking HTTP requests.

Observers ensure core entity behavior (like order numbering) is automatically applied.

5. Invoice Generation

invoice:generate artisan command finds paid, uninvoiced orders and dispatches GenerateInvoiceJob.

The job is intended to generate and send invoices; however, to save time, it currently logs invoice details to the Laravel log instead of creating files under storage/app/invoices/.

Trade-offs:

Using Jobs allows retries without blocking user requests.

6. Transaction & Error Handling

All critical operations in OrderService are wrapped in DB::transaction().

Jobs and listeners are queued with retry logic.

Ensures data consistency even if failures occur in email, balance update, or invoice creation.

7. Security

Sanctum for API authentication.

Policies ensure buyers see only their orders; sellers see only their sales.

Prevents unauthorized access to sensitive operations.

8. Advanced Laravel Features

Repositories & Services: Separation for maintainability and testability.

Event-driven architecture: Decouples core logic from side-effects.

Observers: Automatic behaviors without polluting services.

Jobs/Queue: Async operations like invoice generation and email simulation.

9. Commit History & Reasoning

Each commit represents a meaningful, isolated progress step:


Summary

The design prioritizes:

Separation of concerns (controller → service → repository)

Event-driven modularity (easy to extend)

Data integrity (transactions, rollback)

Async processing (queues for side-effects)

Security (Sanctum + Policies)