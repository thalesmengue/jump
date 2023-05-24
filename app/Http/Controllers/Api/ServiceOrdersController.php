<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ServiceOrdersException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceOrderStoreRequest;
use App\Services\ServiceOrdersService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ServiceOrdersController extends Controller
{
    public function __construct(
        private readonly ServiceOrdersService $serviceOrdersService
    )
    {
    }

    public function store(ServiceOrderStoreRequest $request): JsonResponse
    {
        $serviceOrder = $this->serviceOrdersService->store($request->all());

        return response()->json([
            'success' => true,
            'serviceOrder' => $serviceOrder
        ], Response::HTTP_CREATED);
    }

    public function index($perPage = 5): JsonResponse
    {
        $serviceOrders = $this->serviceOrdersService->index($perPage);

        return response()->json([
            'success' => true,
            'serviceOrders' => $serviceOrders
        ], Response::HTTP_OK);
    }

    public function getByPlate($plate, $perPage = 5): JsonResponse
    {
        try {
            $serviceOrders = $this->serviceOrdersService->getByPlate($plate, $perPage);

            return response()->json([
                'success' => true,
                'serviceOrders' => $serviceOrders
            ], Response::HTTP_OK);
        } catch (ServiceOrdersException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
