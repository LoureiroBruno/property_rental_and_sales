<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom',
            'priceTo',
            'beds',
            'baths',
            'areaFrom',
            'areaTo'
        ]);

        $user = Auth::user();

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->paginate(15)
                ->through(function ($listing) use ($user) {
                    return array_merge(
                        $listing->toArray(),
                        [
                            'can' => [
                                'edit' => $user?->can('update', $listing),
                                'delete' => $user?->can('delete', $listing),
                            ]
                        ]
                    );
                }),
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load('images'); // Loads image relationship

        return inertia('Listing/Show', [
            'listing' => $listing,
        ]);
    }
}
