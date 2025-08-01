<?php

declare(strict_types=1);

namespace App\States\SalesOrder\Transitions;

use App\Data\SalesOrderData;
use App\Events\SalesOrderSuccessedEvent;
use App\Models\SalesOrder;
use App\States\SalesOrder\Success;
use Spatie\ModelStates\Transition;

class ProgressToSuccess extends Transition
{
    public function __construct(
        private SalesOrder $sales_order
    )
    {
        
    }

    public function handle()
    {
        $this->sales_order->update([
            'status' => Success::class,
        ]);

        event(new SalesOrderSuccessedEvent(
            SalesOrderData::fromModel($this->sales_order)
        ));

        return $this->sales_order;
    }
}