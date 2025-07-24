<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class EcommerceStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        
        $thisMonthOrders = Order::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->count();
                               
        $thisMonthRevenue = Order::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->sum('total_amount');
        
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return [
            Stat::make('Toplam Kullanıcı', $totalUsers)
                ->description('Kayıtlı kullanıcı sayısı')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),
                
            Stat::make('Toplam Ürün', $totalProducts)
                ->description('Sistemdeki ürün sayısı')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary'),
                
            Stat::make('Toplam Sipariş', $totalOrders)
                ->description("Bu ay: {$thisMonthOrders} sipariş")
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('info'),
                
            Stat::make('Toplam Gelir', '₺' . number_format($totalRevenue, 2, ',', '.'))
                ->description("Bu ay: ₺" . number_format($thisMonthRevenue, 2, ',', '.'))
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
                
            Stat::make('Ortalama Sipariş', '₺' . number_format($avgOrderValue, 2, ',', '.'))
                ->description('Sipariş başına ortalama değer')
                ->descriptionIcon('heroicon-o-calculator')
                ->color('warning'),
                
            Stat::make('Düşük Stok', $lowStockProducts)
                ->description('10\'dan az stoku olan ürünler')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($lowStockProducts > 0 ? 'danger' : 'success'),
        ];
    }
} 