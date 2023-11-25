<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';

    protected static ?int $sort = 2;

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', Customer::count())
                ->description('Increase in customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([2, 4, 6, 8, 10, 12, 14, 16]),
            Stat::make('Total Products', Product::count())
                ->description('Total Products In app')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 34, 27, 28, 18, 2,]),
            Stat::make('Pending Orders', Order::where('status', OrderStatusEnum::PENDING->value)->count())
                ->description('Total Pending Orders')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 34, 30, 15, 10, 8, 2])
        ];
    }
}
