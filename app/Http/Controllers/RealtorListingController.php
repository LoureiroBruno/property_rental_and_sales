<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RealtorListingController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize(
            'viewAny',
            Listing::class
        );
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return Inertia::render(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(14)
                    ->withQueryString()
            ]
        );
    }

    public function show(Listing $listing): Response
    {
        Gate::authorize(
            'view',
            $listing
        );
        return Inertia::render(
            'Realtor/Show',
            [
                'listing' => $listing->load(
                    'offers',
                    'offers.bidder'
                )
            ]
        );
    }

    public function create(): Response
    {
        Gate::authorize(
            'create',
            Listing::class
        );
        return Inertia::render('Realtor/Create');
    }

    public function store(ListingRequest $request)
    {
        Gate::authorize(
            'create',
            Listing::class
        );

        $request->user()->listings()->create($request->validated());

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }

    public function edit(Listing $listing)
    {
        Gate::authorize(
            'update',
            $listing
        );
        return Inertia::render(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(ListingRequest $request, Listing $listing)
    {
        Gate::authorize(
            'update',
            $listing
        );

        $listing->update($request->validated());

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was changed!');
    }

    public function destroy(Listing $listing)
    {
        Gate::authorize(
            'delete',
            $listing
        );
        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing)
    {
        Gate::authorize(
            'restore',
            $listing
        );
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
