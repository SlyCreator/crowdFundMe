<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use App\Services\DonationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->donationService->fetchAll($request->all());
        return $this->response(Response::HTTP_OK,$data,"Donation fetched successfully");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonationRequest $request)
    {
        $data = $this->donationService->store($request->all());
        return $this->response(Response::HTTP_CREATED,$data,"Donation created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($idOrSlug)
    {
        $data = $this->donationService->fetchOne($idOrSlug);
        return $this->response(Response::HTTP_OK,$data,"Donation fetched successfully");
    }

    /**
     * Display the specified resource.
     */
    public function guestFetchOne($idOrSlug)
    {
        $data = $this->donationService->fetchOneCampaign($idOrSlug);
        return $this->response(Response::HTTP_OK,$data,"Donation fetched successfully");
    }

    public function donate(Request $request)
    {
        $data = $this->donationService->fetchOne($idOrSlug);
        return $this->response(Response::HTTP_OK,$data,"Donation fetched successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonationRequest $request, $idOrSlug)
    {
       $data = $this->donationService->update($idOrSlug,$request->all());
        return $this->response(Response::HTTP_OK,$data,"Donation updated successfully");
    }

    public function markClosed(UpdateDonationRequest $request, $idOrSlug)
    {
        $data = $this->donationService->update($idOrSlug,$request->all());
        return $this->response(Response::HTTP_OK,$data,"Donation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idOrSlug)
    {
        $data = $this->donationService->deleteOne($idOrSlug);
        return $this->response(Response::HTTP_NO_CONTENT,$data,"Donation deleted successfully");
    }
}
