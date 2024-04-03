<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use App\Models\UpDownLike;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 3;

    protected static string $view = 'post-overview';
    public ?Model $record = null;

    protected function columns(): int
    {
        return 5;
    }

    protected function getViewData(): array
    {
        return [
            "viewCount" => PostView::where('post_id', '=', $this->record->id)
                ->count(),
            "upVotes" => UpDownLike::where('post_id', '=', $this->record->id)
                ->where("is_like", '=', 1)
                ->count(),
            "downVotes" => UpDownLike::where('post_id', '=', $this->record->id)
                ->where("is_dislike", '=', 1)
                ->count()
        ];
    }
}
