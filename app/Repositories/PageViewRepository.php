<?php
namespace App\Repositories;

use App\Models\PageView;

class PageViewRepository
{
    public function store(array $data): PageView
    {
        return PageView::create([
            'url' => $data['url'],
            'referrer' => $data['referrer'],
            'viewed_at' => $data['viewed_at'],
        ]);
    }
}
