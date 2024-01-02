<?php

namespace App\Services;

use App\Models\Donation;
use Carbon\Carbon;


class DonationService
{

    public function fetchAll($data)
    {
        return Donation::where('user_id',auth()->id())
            ->paginate($data['per_page'] ?? config('constant.pagination.threshold'));
    }
    public function store($data)
    {
        $data['start_date']=Carbon::createFromFormat('d-m-Y', $data['start_date']);
        $data['end_date']=Carbon::createFromFormat('d-m-Y', $data['end_date']);
        $data['user_id']= auth()->id();
        return Donation::create($data);
    }

    public function fetchOne($idOrSlug)
    {
        return Donation::with(['donationTransaction'=>function($query){
            $query->where('status','completed');
        }])
            ->where('user_id',auth()->id())
            ->where('slug', $idOrSlug)
            ->orWhere('id', $idOrSlug)
            ->firstOrFail();
    }

    public function fetchOneCampaign($idOrSlug)
    {
        return Donation::with(['donationTransaction'=>function($query){
            $query->where('status','completed')->take(5)->latest();
        }])
            ->where('slug', $idOrSlug)
            ->orWhere('id', $idOrSlug)
            ->firstOrFail();
    }
    public function update($idOrSlug,$data)
    {
        $donation = Donation::where('user_id',auth()->id())
            ->where('slug', $idOrSlug)
            ->orWhere('id', $idOrSlug)
            ->firstOrFail();
        $data['start_date'] = isset($data['start_date']) ? Carbon::createFromFormat('d-m-Y', $data['start_date'])->format('Y-m-d') : null;
        $data['end_date'] = isset($data['end_date']) ? Carbon::createFromFormat('d-m-Y', $data['end_date'])->format('Y-m-d') : null;

        $donation->update($data);
        return $donation;
    }

    public function deleteOne($idOrSlug)
    {
        $donation = Donation::where('user_id',auth()->id())
            ->where('slug', $idOrSlug)
            ->orWhere('id', $idOrSlug)
            ->firstOrFail();
        return $donation->delete();
    }


}
