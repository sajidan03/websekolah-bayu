@extends('Layouts-Admin.app')
@section('title', 'Admin')
@section('content')

    @php
        // Get data counts from database
        $profilCount = \App\Models\profil::count();
        $eskulCount = \App\Models\Eskul::count();
        $fasilitasCount = \App\Models\Fasilitas::count();
        $prestasiCount = \App\Models\Prestasi::count();
        $pesanCount = \App\Models\Pesan::count();
        
        // Get latest messages
        $pesans = \App\Models\Pesan::orderBy('created_at', 'desc')->limit(5)->get();
        
        $statData = [
            ['name' => 'Profil', 'count' => $profilCount, 'icon' => '👤'],
            ['name' => 'Eskul', 'count' => $eskulCount, 'icon' => '🏋'],
            ['name' => 'Fasilitas', 'count' => $fasilitasCount, 'icon' => '🏠'],
            ['name' => 'Prestasi', 'count' => $prestasiCount, 'icon' => '🏆'],
            ['name' => 'Pesan', 'count' => $pesanCount, 'icon' => '💬'],
        ];
    @endphp
    
    <div class="stat-card">
        @foreach($statData as $stat)
        <div class="stat-item">
            <div class="stat-icon">{!! $stat['icon'] !!}</div>
            <div class="stat-info">
                <span class="stat-count">{{ $stat['count'] }}</span>
                <span class="stat-name">{{ $stat['name'] }}</span>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="parent">
        <div class="div4">
            <div class="chart-widget">
                <div class="chart-header">
                    <span class="chart-title">Data Menu</span>
                    <span class="chart-subtitle">Statistik Menu Website</span>
                </div>
                <div class="chart-content">
                    <div class="pie-chart-container">
                        @php
                            $menuData = [
                                ['name' => 'Profil', 'count' => $profilCount, 'color' => '#FF6384'],
                                ['name' => 'Eskul', 'count' => $eskulCount, 'color' => '#36A2EB'],
                                ['name' => 'Fasilitas', 'count' => $fasilitasCount, 'color' => '#FFCE56'],
                                ['name' => 'Prestasi', 'count' => $prestasiCount, 'color' => '#4BC0C0'],
                                ['name' => 'Pesan', 'count' => $pesanCount, 'color' => '#9966FF'],
                            ];
                            
                            $total = array_sum(array_column($menuData, 'count'));
                            
                            $startAngle = 0;
                            $segments = [];
                            foreach ($menuData as $menu) {
                                $percentage = ($menu['count'] / $total) * 100;
                                $angle = ($percentage / 100) * 360;
                                $segments[] = [
                                    'name' => $menu['name'],
                                    'count' => $menu['count'],
                                    'percentage' => round($percentage, 1),
                                    'color' => $menu['color'],
                                    'startAngle' => $startAngle,
                                    'endAngle' => $startAngle + $angle
                                ];
                                $startAngle += $angle;
                            }
                        @endphp
                        
                        <div class="pie-chart" style="background: conic-gradient(
                            @foreach($segments as $index => $seg)
                                {{ $seg['color'] }} {{ $seg['startAngle'] }}deg {{ $seg['endAngle'] }}deg{{ $index < count($segments) - 1 ? ',' : '' }}
                            @endforeach
                        );"></div>
                        
                        <div class="pie-center">
                            <span class="pie-total">{{ $total }}</span>
                            <span class="pie-label">Total</span>
                        </div>
                    </div>
                    
                    <div class="chart-legend">
                        @foreach($segments as $seg)
                        <div class="legend-item">
                            <span class="legend-color" style="background-color: {{ $seg['color'] }};"></span>
                            <span class="legend-name">{{ $seg['name'] }}</span>
                            <span class="legend-count">{{ $seg['count'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="div5">
            <div class="pengaturan-widget">
                <div class="pengaturan-header">
                    <span class="pengaturan-title">Pengaturan</span>
                    <span class="pengaturan-subtitle">Kalender & Aktivitas</span>
                </div>
                <div class="pengaturan-content">
                    <div class="calendar-mini">
                        <div class="calendar-nav">
                            <span class="nav-arrow"><</span>
                            <span class="current-month">{{ date('F Y') }}</span>
                            <span class="nav-arrow">></span>
                        </div>
                        <div class="calendar-grid">
                            <div class="day-header">S</div>
                            <div class="day-header">S</div>
                            <div class="day-header">R</div>
                            <div class="day-header">K</div>
                            <div class="day-header">J</div>
                            <div class="day-header">S</div>
                            <div class="day-header">M</div>
                            @php
                                $currentDay = date('j');
                                $currentMonth = date('n');
                                $currentYear = date('Y');
                                $firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
                                $dayOfWeek = date('w', $firstDayOfMonth);
                                $daysInMonth = date('t', $firstDayOfMonth);
                            @endphp
                            
                            @for($i = 0; $i < $dayOfWeek; $i++)
                                <div class="day-cell"></div>
                            @endfor
                            
                            @for($day = 1; $day <= $daysInMonth; $day++)
                                <div class="day-cell {{ $day == $currentDay ? 'today' : '' }}">{{ $day }}</div>
                            @endfor
                        </div>
                    </div>
                    <div class="activity-list">
                        <div class="activity-title">Daftar Aktivitas</div>
                        <div class="activity-item">
                            <div class="activity-date">{{ date('d') }}</div>
                            <div class="activity-info">
                                <div class="activity-name">Hari Ini</div>
                                <div class="activity-desc">Aktivitas sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="div6">
            <div class="message-widget">
                <div class="message-header">
                    <span class="message-title">Pesan Masuk</span>
                    <span class="message-subtitle">Email & Pesan Terbaru</span>
                </div>
                <div class="message-content">
                    @if($pesans->count() > 0)
                        @foreach($pesans as $pesan)
                        <div class="message-item">
                            <div class="message-icon">✉</div>
                            <div class="message-info">
                                <div class="message-email">{{ $pesan->email }}</div>
                                <div class="message-text">{{ Str::limit($pesan->pesan, 50) }}</div>
                                <div class="message-time">{{ $pesan->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="message-empty">Belum ada pesan masuk</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Stat Card Styles - Simple & Formal */
        .stat-card {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-bottom: 5px;
            padding: 10px 10px 0 10px;
        }
    
        .stat-item {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    
        .stat-icon {
            width: 35px;
            height: 35px;
            background: #f5f5f5;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
    
        .stat-info {
            display: flex;
            flex-direction: column;
        }
    
        .stat-count {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            line-height: 1.2;
        }
    
        .stat-name {
            font-size: 0.65rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    
        .parent {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding: 5px 10px 10px 10px;
        }

        .div4, .div5, .div6 {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            min-height: 300px;
        }

        /* Pie Chart Widget Styles */
        .chart-widget {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .chart-title {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .chart-subtitle {
            display: block;
            font-size: 0.75rem;
            color: #666;
            margin-top: 2px;
        }

        .chart-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pie-chart-container {
            position: relative;
            width: 140px;
            height: 140px;
            margin-bottom: 15px;
        }

        .pie-chart {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            position: relative;
        }

        .pie-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .pie-total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            line-height: 1;
        }

        .pie-label {
            font-size: 0.6rem;
            color: #666;
            text-transform: uppercase;
        }

        .chart-legend {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            padding: 6px 8px;
            background: #f9f9f9;
            border-radius: 4px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .legend-name {
            flex-grow: 1;
            font-size: 0.75rem;
            color: #333;
        }

        .legend-count {
            font-size: 0.75rem;
            font-weight: 600;
            color: #666;
            background: #eee;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* Pengaturan Widget Styles */
        .pengaturan-widget {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pengaturan-header {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .pengaturan-title {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .pengaturan-subtitle {
            display: block;
            font-size: 0.75rem;
            color: #666;
            margin-top: 2px;
        }

        .pengaturan-content {
            flex-grow: 1;
            overflow-y: auto;
        }

        /* Mini Calendar Styles */
        .calendar-mini {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .nav-arrow {
            cursor: pointer;
            color: #666;
            font-weight: bold;
        }

        .current-month {
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            text-align: center;
        }

        .day-header {
            font-size: 0.65rem;
            font-weight: 600;
            color: #666;
            padding: 3px 0;
        }

        .day-cell {
            font-size: 0.7rem;
            padding: 4px 0;
            color: #333;
            border-radius: 3px;
        }

        .day-cell.today {
            background: #333;
            color: #fff;
            font-weight: bold;
        }

        /* Activity List Styles */
        .activity-list {
            margin-top: 5px;
        }

        .activity-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 8px;
            background: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 6px;
        }

        .activity-date {
            width: 35px;
            height: 35px;
            background: #eee;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: #333;
            margin-right: 10px;
        }

        .activity-info {
            flex-grow: 1;
        }

        .activity-name {
            font-size: 0.75rem;
            font-weight: 600;
            color: #333;
        }

        .activity-desc {
            font-size: 0.65rem;
            color: #666;
        }

        /* Message Widget Styles */
        .message-widget {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .message-header {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .message-title {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .message-subtitle {
            display: block;
            font-size: 0.75rem;
            color: #666;
            margin-top: 2px;
        }

        .message-content {
            flex-grow: 1;
            overflow-y: auto;
        }

        .message-item {
            display: flex;
            align-items: flex-start;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 6px;
            margin-bottom: 8px;
        }

        .message-icon {
            width: 30px;
            height: 30px;
            background: #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .message-info {
            flex-grow: 1;
            min-width: 0;
        }

        .message-email {
            font-size: 0.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
            word-break: break-all;
        }

        .message-text {
            font-size: 0.7rem;
            color: #666;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .message-time {
            font-size: 0.6rem;
            color: #999;
        }

        .message-empty {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 0.85rem;
        }
    </style>

@endsection


