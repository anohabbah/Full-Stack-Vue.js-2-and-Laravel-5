<?php

namespace App\Http\Controllers;

use App\Listing;

class ListingController extends Controller
{
    /**
     * @param Listing $listing
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(Listing $listing)
    {
        $model = $listing->toArray();
        for ($i = 1; $i <= 4; ++$i) {
            $model['image_' . $i] = asset('images/' . $listing->id . '/Image_' . $i . '.jpg');
        }

        return response()->json($model);
    }
}
