<?php

namespace App\Http\Controllers\API\Frontend\RealEstate;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Real estate searcher
 */
class RealEstateSearcher
{
    /**
     * Search
     *
     * @param array $options
     *
     * @return array
     */
    public function search(array $options): array
    {
        $filters = $options['filters'] ?? [];

        $queryBuilder = $this->applyFilters($filters);
        $items = $queryBuilder
            ->select([
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
            ])
            ->get()
            ->toArray();

        return [
            'items' => $this->serializeItems($items),
            'total' => count($items),
        ];
    }

    /**
     * Apply filters for search.
     *
     * @param array $filters
     *
     * @return Builder
     */
    private function applyFilters(array $filters): Builder
    {
        $queryBuilder = DB::table('real_estates');

//        if (!empty($filters['title'])) {
//            $queryBuilder->where('title', 'like', '%' . $filters['title'] . '%');
//        }

        if (!empty($filters['category'])) {
            $queryBuilder->where('category', '=', $filters['category']);
        }
//
//        if (!empty($filters['date_from'])) {
//            $queryBuilder->whereDate('created_at', '>=', $filters['date_from']);
//        }
//
//        if (!empty($filters['date_till'])) {
//            $queryBuilder->whereDate('created_at', '<=', $filters['date_till']);
//        }

        return $queryBuilder;
    }

    private function serializeItems(array $items): array
    {
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

        return $serialize;
    }
}
