<?php
namespace App\Services;

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
    }
}
