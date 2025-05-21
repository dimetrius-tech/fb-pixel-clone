<?php
namespace App\Services;

use App\Events\PageViewed;
use App\Models\PageView;
use App\Repositories\PageViewRepository;

class PageViewService
{
    protected PageViewRepository $pageViewRepository;
    public function __construct(PageViewRepository $pageViewRepository)
    {
        $this->pageViewRepository = $pageViewRepository;
    }

    public function getStatisctics()
    {
        return $this->pageViewRepository->get();
    }

    public function trackPageView(array $data): void
    {
        $this->pageViewRepository->store($data);

//        if($data['referrer'] === 'visit') {
//            Redis::sadd('track_visit', json_encode($data));
//        } else {
//            Redis::sadd('track_subscribe', json_encode($data));
//        }
    }
}
