<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class AccountStatusStats extends ChartWidget
{
    protected static ?string $heading = 'Metin2 - Account Status Statistics';

    protected static bool $isLazy = false; // Afișează direct la încărcarea paginii
    protected static ?int $sort = -1; // Poziția în dashboard

    protected function getData(): array
    {
        $counts = \DB::connection('account')
            ->table('account')
            ->selectRaw("COUNT(CASE WHEN status = 'OK' THEN 1 END) as ok_count, COUNT(CASE WHEN status = 'PENDING' THEN 1 END) as pending_count")
            ->first();
    
        return [
            'datasets' => [
                [
                    'label' => 'Accounts',
                    'data' => [$counts->ok_count ?? 0, $counts->pending_count ?? 0],
                    'backgroundColor' => ['#4CAF50', '#FF9800'], // Verde pentru OK, Portocaliu pentru PENDING
                    'borderColor' => ['#388E3C', '#F57C00'], // Culoare margine
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['OK', 'PENDING'],
        ];
    }
    

    protected function getType(): string
    {
        return 'doughnut'; // Poți folosi și 'bar', 'line', 'pie'
    }
}
