<?php

namespace App\Http\Controllers\API\Frontend\RealEstate;

use App\Http\Controllers\API\RestResponseFactory;
use App\Http\Requests\RealEstateSearchRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RealEstateController
{
    /**
     * Constructor.
     *
     * @param RealEstateSearcher $realEstateSearcher
     * @param RestResponseFactory $restResponseFactory
     */
    public function __construct(
        private readonly RealEstateSearcher $realEstateSearcher,
        private readonly RestResponseFactory $restResponseFactory,
    ) {
    }

    public function search(RealEstateSearchRequest $request): JsonResponse
    {
        try {
            $input = $request->validated();

            $estates = $this->realEstateSearcher->search($input);

            return $this->restResponseFactory->ok($estates);
        } catch (Exception $exception) {
            return $this->restResponseFactory->serverError($exception);
        }
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
