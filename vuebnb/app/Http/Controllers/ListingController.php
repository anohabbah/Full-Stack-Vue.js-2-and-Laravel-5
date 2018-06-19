<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ListingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHomeWeb()
    {
        $data = Listing::all([
            'id', 'address', 'title', 'price_per_night'
        ]);
        $data->transform(function ($listing) {
            $listing->thumb = asset('images/' . $listing->id . '/Image_1_thumb.jpg');
            return $listing;
        });
        $data = collect(['listings' => $data->toArray()]);
        return view('app', ['data' => $data]);
    }

    /**
     * @param Listing $listing
     * @return JsonResponse
     */
    public function getListingApi(Listing $listing): JsonResponse
    {
        $data = $this->getListing($listing);

        return response()->json($data);
    }

    /**
     * @param Listing $listing
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListingWeb(Listing $listing)
    {
        $data = $this->getListing($listing);

        return view('app', compact('data'));
    }

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    private function addImageUrls($model, $id)
    {
        for ($i = 1; $i <= 4; ++$i) {
            $model['image_' . $i] = asset('images/' . $id . '/Image_' . $i . '.jpg');
        }

        return $model;
    }

    /**
     * @param Listing $listing
     * @return Collection
     */
    private function getListing(Listing $listing): Collection
    {
        $model = $listing->toArray();
        $model = $this->addImageUrls($model, $listing->id);

        return collect(['listing' => $model]);
    }
}
