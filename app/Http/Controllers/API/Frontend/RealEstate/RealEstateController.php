<?php

namespace App\Http\Controllers\API\Frontend\RealEstate;

use App\Http\Controllers\API\RestResponseFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RealEstateController
{
    /**
     * Constructor.
     *
     * @param RestResponseFactory $restResponseFactory
     */
    public function __construct(
        private readonly RestResponseFactory $restResponseFactory,
    ) {
    }

    /**
     * Read all real estates.
     *
     * @return JsonResponse
     */
    public function readAll(): JsonResponse
    {
        try {
            $query = DB::table('real_estates');

            $items = $query->select([
                'id',
                'address',
                'description',
                'cover',
                'phone_number',
                'category',
                'price',
                'location',
                'lat',
                'lng',
            ])->get()->toArray();

            $serialize = [];
            foreach ($items as $item) {
                $serialize[] = [
                    'id' => $item->id,
                    'address' => $item->address,
                    'description' => $item->description,
                    'cover' => $item->cover,
                    'phone_number' => $item->phone_number,
                    'category' => $item->category,
                    'price' => $item->price,
                    'location' => $item->location,
                    'lat' => $item->lat,
                    'lng' => $item->lng,
                ];
            }

            return $this->restResponseFactory->ok(['items' => $serialize]);
        } catch (Exception $exception) {
            return $this->restResponseFactory->serverError($exception);
        }
    }
}
