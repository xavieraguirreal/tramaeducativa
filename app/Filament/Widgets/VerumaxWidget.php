<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class VerumaxWidget extends Widget
{
    protected static string $view = 'filament.widgets.verumax-widget';

    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        return true;
    }
}
