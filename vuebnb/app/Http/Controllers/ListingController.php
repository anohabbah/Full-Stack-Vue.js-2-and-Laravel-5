<?php

namespace App\Http\Controllers;

use App\Listing;
use function Sodium\add;

class ListingController extends Controller
{
    public function getHomeWeb()
    {
        $data = Listing::all([
            'id', 'address', 'title', 'price_per_night'
        ]);
        $data->transform(function ($listing) {
            $listing->thumnb = asset('images/' . $listing->id . '/Image_1_thumb.jpg');
            return $listing;
        });
        $data = collect(['listing' => $data->toArray()]);
        return view('app', ['data' => $data]);
    }
    /**
     * @param Listing $listing
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListingApi(Listing $listing)
    {
        $data = $this->getListing($listing);

        return response()->json($data);
    }

    /**
     * @param Listing $listing
     * @return \Illuminate\Http\JsonResponse
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
    private function addImageUrls($model, $id) {
        for ($i = 1; $i <= 4; ++$i) {
            $model['image_' . $i] = asset('images/' . $id . '/Image_' . $i . '.jpg');
        }

        return $model;
    }

    private function getListing(Listing $listing) {
        $model = $listing->toArray();
        $model = $this->addImageUrls($model, $listing->id);

        return collect(['listing' => $model]);
    }
}
