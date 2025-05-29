<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PageViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;

class PixelController extends Controller
{
    protected PageViewService $pageViewService;
    protected Agent $agent;
    public function __construct(PageViewService $pageViewService)
    {
        $this->pageViewService = $pageViewService;
        $this->agent = new Agent();
    }

    public function show()
    {
        $userActivitiesCount = $this->pageViewService->getStatisctics();
        return Inertia::render('PixelStatistic', [
            'userActivitiesCount' => $userActivitiesCount,
            'usersList' => User::all()
        ]);
    }
    public function trackLocal(Request $request)
    {
        try {
            $this->agent->setUserAgent($request->userAgent());
            $data = [
                'browser' => $this->agent->browser(),
                'os' => $this->agent->platform(),
                'ip' => $request->ip(),
                'url' => $request->headers->get('referer'),
                'referrer' => $request->headers->get('referer'),
                'user_id' => Auth::user()->id,
            ];
            $this->pageViewService->trackPageView($data);
            $gif = base64_decode('R0lGODlhAQABAPAAAP///wAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==');
            return response($gif, 200)
                ->header('Content-Type', 'image/gif')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Pragma', 'no-cache');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function trackRemote(Request $request)
    {
        try {
            $this->agent->setUserAgent($request->userAgent());
            $data = [
                'browser' => $this->agent->browser(),
                'os' => $this->agent->platform(),
                'ip' => $request->ip(),
                'url' => $request->headers->get('referer'),
                'referrer' => $request->headers->get('referer'),
                'user_id' => null,
            ];
            $this->pageViewService->trackPageView($data);
            $gif = base64_decode('R0lGODlhAQABAPAAAP///wAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==');
            return response($gif, 200)
                ->header('Content-Type', 'image/gif')
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Pragma', 'no-cache');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
