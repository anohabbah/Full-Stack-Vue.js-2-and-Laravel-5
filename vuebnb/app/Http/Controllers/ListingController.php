<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function addMetaData(Collection $collection, Request $request)
    {
        return $collection->merge([
            'path' => $request->getPathInfo(),
            'auth' => Auth::check(),
            'saved' => Auth::check() ? Auth::user()->saved : []
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHomeWeb(Request $request)
    {
        $data = $this->getListingSummaries();
        $data = $this->addMetaData($data, $request);
        return view('app', ['data' => $data]);
    }

    /**
     * @return JsonResponse
     */
    public function getHomeApi()
    {
        return response()->json($this->getListingSummaries());
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListingWeb(Listing $listing, Request $request)
    {
        $data = $this->getListing($listing);
        $data = $this->addMetaData($data, $request);
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
            $model['image_' . $i] = cdn('images/' . $id . '/Image_' . $i . '.jpg');
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

    /**
     * @return Listing[]|\Illuminate\Database\Eloquent\Collection|Collection
     */
    private function getListingSummaries()
    {
        $data = Listing::all([
            'id', 'address', 'title', 'price_per_night'
        ]);
        $data->transform(function ($listing) {
            $listing->thumb = asset('images/' . $listing->id . '/Image_1_thumb.jpg');
            return $listing;
        });
        return collect(['listings' => $data->toArray()]);
    }
}
