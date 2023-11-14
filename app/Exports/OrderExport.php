<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $branch_id = null;

    function __construct($branch_id)
    {
        $this->branch_id = $branch_id;
    }


    public function collection()
    {
        $auth_user = auth()->user();
        if ($auth_user->getRoleNames()[0] == 'User') {
            if ($this->branch_id != null) {
                return $orders = $auth_user->store()->first()->orders()->whereHas('payment', function (Builder $query) {
                    $query->where('branch_id', $this->branch_id);
                })->get();
            }
            return $auth_user->store()->first()->orders()->with('client')->get();
        } else {
            return Order::all();
        }
    }

    public function map($registration): array
    {
        return [
            $registration->order_id,
            $registration->amount,
            $registration->discount,
            $registration->quantity,
            $registration->currency,
            data_get($registration->product, "name_" . l()),
            data_get($registration->client, "name"),
            data_get($registration->client, "address"),
            data_get($registration->client, "mobile"),
            $registration->created_at,
        ];

    }

    public function headings(): array
    {
        return [
            '#',
            __("master.order_amount"),
            __("master.discount"),
            __("master.order_quantity"),
            __("master.currency"),
            __("master.product_name"),
            __("master.client_name"),
            __("master.client_address"),
            __("master.client_mobile"),
            __("master.date"),
        ];
    }
}
//Developed Saed Z. Sinwar