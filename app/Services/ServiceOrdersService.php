<?php

namespace App\Services;

use App\Exceptions\ServiceOrdersException;
use App\Models\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceOrdersService
{
    public function store(array $data): Model
    {
        return $serviceOrder = ServiceOrder::query()->create([
            'user_id' => $data['user_id'],
            'vehiclePlate' => $data['vehiclePlate'],
            'entryDateTime' => Carbon::now(),
            'exitDateTime' => $data['exitDateTime'],
            'priceType' => $data['priceType'],
            'price' => $data['price']
        ]);
    }

    public function index($perPage): LengthAwarePaginator
    {
        return ServiceOrder::query()
            ->with('user')
            ->paginate($perPage);
    }

    /**
     * @throws ServiceOrdersException
     */
    public function getByPlate($plate, $perPage): LengthAwarePaginator
    {
        $serviceOrders = ServiceOrder::query()
            ->with('user')
            ->where('vehiclePlate', 'like', '%' . $plate . '%')
            ->paginate($perPage);

        if (empty($serviceOrders->items())) {
            throw ServiceOrdersException::notFoundAnyServiceOrderByPlate();
        }

        return $serviceOrders;
    }
}
