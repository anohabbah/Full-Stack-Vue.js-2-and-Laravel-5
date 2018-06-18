<?php

namespace App\Http\Controllers;

use App\Listing;

class ListingController extends Controller
{
    /**
     * @param Listing $listing
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListingApi(Listing $listing)
    {
        $model = $listing->toArray();
        $model = $this->addImageUrls($model, $listing->id);

        return response()->json($model);
    }

    /**
     * @param Listing $listing
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListingWeb(Listing $listing)
    {
        $model = $listing->toArray();
        $model = $this->addImageUrls($model, $listing->id);

        return view('app', compact('model'));
    }

    private function addImageUrls($model, $id) {
        for ($i = 1; $i <= 4; ++$i) {
            $model['image_' . $i] = asset('images/' . $id . '/Image_' . $i . '.jpg');
        }

        return $model;
    }
}
