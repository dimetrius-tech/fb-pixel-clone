<?php

namespace App\Http\Controllers;

use App\Events\PageViewed;
use App\Services\PageViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PixelController extends Controller
{
    public function track(Request $request)
    {
        $data = $request->only(['url', 'referrer', 'viewed_at']);

        broadcast(new PageViewed(...array_values($data)));

        if($data['referrer'] === 'visit') {
            Redis::sadd('track_visit', json_encode($data));
        } else {
            Redis::sadd('track_subscribe', json_encode($data));
        }

        return response()->json(['status' => 'tracked']);
    }
}
