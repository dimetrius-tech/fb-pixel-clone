<?php
namespace App\Repositories;

use App\Models\PageView;

class PageViewRepository
{
    public function get()
    {
        return PageView::all();
    }

    public function store(array $data): PageView
    {
        return PageView::create([
            'browser' => $data['browser'],
            'os' => $data['os'],
            'ip' => $data['ip'],
            'url' => $data['url'],
            'referrer' => $data['referrer'],
        ]);
    }
}
