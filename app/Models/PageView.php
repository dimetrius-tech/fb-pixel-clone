<?php

namespace App\Models;

use App\Observers\PageViewObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PageView extends Model
{
    protected $fillable = ['uuid', 'browser', 'os', 'ip', 'url', 'referrer', 'country', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });

        PageView::observe(PageViewObserver::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
