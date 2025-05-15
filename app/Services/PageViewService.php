<?php
namespace App\Services;

use App\Models\PageView;
use App\Repositories\PageViewRepository;

class PageViewService
{
    protected PageViewRepository $pageViewRepository;
    public function __construct(PageViewRepository $pageViewRepository)
    {
        $this->pageViewRepository = $pageViewRepository;
    }

    public function trackPageView(array $data): PageView
    {
        return $this->pageViewRepository->store($data);
    }
}
