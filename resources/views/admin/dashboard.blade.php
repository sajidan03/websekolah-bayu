@extends('Layouts-Admin.app')
@section('title', 'Admin')
@section('content')

    @php
        $profilCount = \App\Models\profil::count();
        $eskulCount = \App\Models\Eskul::count();
        $fasilitasCount = \App\Models\Fasilitas::count();
        $prestasiCount = \App\Models\Prestasi::count();
        $pesanCount = \App\Models\Pesan::count();
        
        $pesans = \App\Models\Pesan::orderBy('created_at', 'desc')->limit(5)->get();
        
        $statData = [
            ['name' => 'Profil', 'count' => $profilCount, 'icon' => '👤', 'color' => '#FF6384'],
            ['name' => 'Eskul', 'count' => $eskulCount, 'icon' => '🏋', 'color' => '#36A2EB'],
            ['name' => 'Fasilitas', 'count' => $fasilitasCount, 'icon' => '🏠', 'color' => '#FFCE56'],
            ['name' => 'Prestasi', 'count' => $prestasiCount, 'icon' => '🏆', 'color' => '#4BC0C0'],
            ['name' => 'Pesan', 'count' => $pesanCount, 'icon' => '💬', 'color' => '#9966FF'],
        ];
    @endphp

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        @foreach($statData as $stat)
        <div class="stat-card">
            <div class="stat-icon" style="background: {{ $stat['color'] }}18; color: {{ $stat['color'] }};">
                {!! $stat['icon'] !!}
            </div>
            <div class="stat-info">
                <span class="stat-count">{{ $stat['count'] }}</span>
                <span class="stat-name">{{ $stat['name'] }}</span>
            </div>
            <div class="stat-bar" style="background: linear-gradient(90deg, {{ $stat['color'] }}33, {{ $stat['color'] }}11);"></div>
        </div>
        @endforeach
    </div>

    {{-- MAIN GRID --}}
    <div class="main-grid">

        {{-- PIE CHART --}}
        <div class="widget chart-widget">
            <div class="widget-header">
                <div>
                    <div class="widget-title">Data Menu</div>
                    <div class="widget-subtitle">Statistik Menu Website</div>
                </div>
            </div>
            <div class="chart-body">
                @php
                    $menuData = [
                        ['name' => 'Profil',    'count' => $profilCount,    'color' => '#FF6384'],
                        ['name' => 'Eskul',     'count' => $eskulCount,     'color' => '#36A2EB'],
                        ['name' => 'Fasilitas', 'count' => $fasilitasCount, 'color' => '#FFCE56'],
                        ['name' => 'Prestasi',  'count' => $prestasiCount,  'color' => '#4BC0C0'],
                        ['name' => 'Pesan',     'count' => $pesanCount,     'color' => '#9966FF'],
                    ];
                    $total = array_sum(array_column($menuData, 'count'));
                    $startAngle = 0;
                    $segments = [];
                    if ($total > 0) {
                        foreach ($menuData as $menu) {
                            $percentage = ($menu['count'] / $total) * 100;
                            $angle = ($percentage / 100) * 360;
                            $segments[] = [
                                'name'       => $menu['name'],
                                'count'      => $menu['count'],
                                'percentage' => round($percentage, 1),
                                'color'      => $menu['color'],
                                'startAngle' => $startAngle,
                                'endAngle'   => $startAngle + $angle,
                            ];
                            $startAngle += $angle;
                        }
                    } else {
                        foreach ($menuData as $menu) {
                            $segments[] = ['name' => $menu['name'], 'count' => 0, 'percentage' => 0,
                                'color' => $menu['color'], 'startAngle' => 0, 'endAngle' => 0];
                        }
                    }
                @endphp

                <div class="pie-wrap">
                    <div class="pie-chart-outer">
                        @if($total > 0)
                        <div class="pie-chart" style="background: conic-gradient(
                            @foreach($segments as $i => $seg)
                                {{ $seg['color'] }} {{ $seg['startAngle'] }}deg {{ $seg['endAngle'] }}deg{{ $i < count($segments)-1 ? ',' : '' }}
                            @endforeach
                        );"></div>
                        @else
                        <div class="pie-chart" style="background: #e8e8e8;"></div>
                        @endif
                        <div class="pie-hole">
                            <span class="pie-num">{{ $total }}</span>
                            <span class="pie-lbl">Total</span>
                        </div>
                    </div>
                </div>

                <div class="legend">
                    @foreach($segments as $seg)
                    <div class="legend-row">
                        <span class="legend-dot" style="background:{{ $seg['color'] }};"></span>
                        <span class="legend-label">{{ $seg['name'] }}</span>
                        <span class="legend-pct">{{ $seg['percentage'] }}%</span>
                        <span class="legend-val">{{ $seg['count'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- CALENDAR --}}
        <div class="widget cal-widget">
            <div class="widget-header">
                <div>
                    <div class="widget-title">Kalender</div>
                    <div class="widget-subtitle">{{ date('F Y') }}</div>
                </div>
            </div>
            <div class="cal-body">
                @php
                    $currentDay   = date('j');
                    $currentMonth = date('n');
                    $currentYear  = date('Y');
                    $firstDay     = mktime(0,0,0,$currentMonth,1,$currentYear);
                    $startDow     = date('w', $firstDay);
                    $daysInMonth  = date('t', $firstDay);
                @endphp
                <div class="cal-grid">
                    @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $d)
                        <div class="cal-head">{{ $d }}</div>
                    @endforeach

                    @php
                        // Convert Sunday=0 → Monday-first: shift Sunday to position 6
                        $offset = ($startDow === 0) ? 6 : $startDow - 1;
                    @endphp

                    @for($i = 0; $i < $offset; $i++)
                        <div class="cal-cell empty"></div>
                    @endfor

                    @for($day = 1; $day <= $daysInMonth; $day++)
                        <div class="cal-cell {{ $day == $currentDay ? 'today' : '' }}">{{ $day }}</div>
                    @endfor
                </div>

                <div class="today-badge">
                    <span class="today-icon">📅</span>
                    <div>
                        <div class="today-date">{{ date('l, d F Y') }}</div>
                        <div class="today-sub">Aktivitas sekolah berjalan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MESSAGES --}}
        <div class="widget msg-widget">
            <div class="widget-header">
                <div>
                    <div class="widget-title">Pesan Masuk</div>
                    <div class="widget-subtitle">{{ $pesanCount }} total pesan</div>
                </div>
                @if($pesanCount > 0)
                <span class="badge">{{ $pesanCount }}</span>
                @endif
            </div>
            <div class="msg-body">
                @if($pesans->count() > 0)
                    @foreach($pesans as $pesan)
                    <div class="msg-item">
                        <div class="msg-avatar">{{ strtoupper(substr($pesan->email, 0, 1)) }}</div>
                        <div class="msg-content">
                            <div class="msg-email">{{ $pesan->email }}</div>
                            <div class="msg-text">{{ Str::limit($pesan->pesan, 60) }}</div>
                            <div class="msg-time">{{ $pesan->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="msg-empty">
                        <span style="font-size:2rem;">📭</span>
                        <p>Belum ada pesan masuk</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <style>
        /* ── RESET & BASE ──────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        /* ── STAT GRID ─────────────────────────────────── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            padding: 14px 14px 0;
        }

        .stat-card {
            position: relative;
            background: #fff;
            border: 1px solid #ebebeb;
            border-radius: 12px;
            padding: 14px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
            transition: transform .15s, box-shadow .15s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,.07); }

        .stat-bar {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 0 0 12px 12px;
        }

        .stat-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .stat-info { display: flex; flex-direction: column; }
        .stat-count { font-size: 1.2rem; font-weight: 700; color: #1a1a1a; line-height: 1.2; }
        .stat-name  { font-size: 0.62rem; color: #888; text-transform: uppercase; letter-spacing: .6px; margin-top: 1px; }

        /* ── MAIN GRID ─────────────────────────────────── */
        .main-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            padding: 12px 14px 14px;
        }

        /* ── WIDGET BASE ───────────────────────────────── */
        .widget {
            background: #fff;
            border: 1px solid #ebebeb;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .widget-header {
            padding: 14px 16px 12px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .widget-title    { font-size: .95rem; font-weight: 700; color: #1a1a1a; }
        .widget-subtitle { font-size: .7rem;  color: #999; margin-top: 1px; }

        .badge {
            background: #FF6384;
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
        }

        /* ── PIE CHART ─────────────────────────────────── */
        .chart-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .pie-wrap { display: flex; justify-content: center; }

        .pie-chart-outer {
            position: relative;
            width: 130px; height: 130px;
        }
        .pie-chart {
            width: 100%; height: 100%;
            border-radius: 50%;
        }
        .pie-hole {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 56px; height: 56px;
            background: #fff;
            border-radius: 50%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }
        .pie-num { font-size: 1.1rem; font-weight: 800; color: #1a1a1a; line-height: 1; }
        .pie-lbl { font-size: .55rem; color: #999; text-transform: uppercase; letter-spacing: .5px; }

        .legend { width: 100%; display: flex; flex-direction: column; gap: 5px; }
        .legend-row {
            display: flex; align-items: center;
            gap: 8px;
            padding: 6px 10px;
            background: #fafafa;
            border-radius: 8px;
            font-size: .72rem;
        }
        .legend-dot   { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
        .legend-label { flex: 1; color: #444; }
        .legend-pct   { color: #999; }
        .legend-val   { font-weight: 700; color: #1a1a1a; background: #efefef; padding: 1px 7px; border-radius: 8px; }

        /* ── CALENDAR ──────────────────────────────────── */
        .cal-body { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; gap: 14px; }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            text-align: center;
        }
        .cal-head { font-size: .6rem; font-weight: 700; color: #bbb; padding: 4px 0; text-transform: uppercase; }
        .cal-cell {
            font-size: .68rem;
            padding: 5px 2px;
            border-radius: 6px;
            color: #555;
            cursor: default;
            transition: background .1s;
        }
        .cal-cell:not(.empty):hover { background: #f5f5f5; }
        .cal-cell.today {
            background: #1a1a1a;
            color: #fff;
            font-weight: 700;
            border-radius: 6px;
        }
        .cal-cell.empty { background: transparent; }

        .today-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: #f8f8f8;
            border-radius: 10px;
            border-left: 3px solid #4BC0C0;
        }
        .today-icon  { font-size: 1.3rem; }
        .today-date  { font-size: .72rem; font-weight: 600; color: #1a1a1a; }
        .today-sub   { font-size: .62rem; color: #999; margin-top: 1px; }

        /* ── MESSAGES ──────────────────────────────────── */
        .msg-body { flex: 1; overflow-y: auto; padding: 10px 14px 14px; display: flex; flex-direction: column; gap: 8px; }

        .msg-item {
            display: flex;
            gap: 10px;
            padding: 10px 12px;
            background: #fafafa;
            border-radius: 10px;
            transition: background .15s;
        }
        .msg-item:hover { background: #f2f2f2; }

        .msg-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #36A2EB, #9966FF);
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .msg-content { flex: 1; min-width: 0; }
        .msg-email   { font-size: .72rem; font-weight: 600; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .msg-text    { font-size: .67rem; color: #777; margin: 2px 0; line-height: 1.4; }
        .msg-time    { font-size: .6rem; color: #bbb; }

        .msg-empty {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 8px;
            color: #bbb;
            font-size: .8rem;
            padding: 30px 0;
        }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Tablet (≤ 900px)
        ══════════════════════════════════════════════════ */
        @media (max-width: 900px) {
            .stat-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                padding: 12px 12px 0;
            }
            /* last stat card full-width when odd */
            .stat-grid .stat-card:last-child:nth-child(3n+1) {
                grid-column: span 3;
            }

            .main-grid {
                grid-template-columns: 1fr 1fr;
                padding: 12px;
            }
            .msg-widget { grid-column: span 2; }
        }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Mobile (≤ 600px)
        ══════════════════════════════════════════════════ */
        @media (max-width: 600px) {
            /* Stat: 2 columns */
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                padding: 10px 10px 0;
            }
            .stat-grid .stat-card:last-child:nth-child(odd) {
                grid-column: span 2;
            }

            .stat-card { padding: 12px 10px; }
            .stat-icon { width: 36px; height: 36px; font-size: 1.1rem; }
            .stat-count { font-size: 1.05rem; }

            /* Main grid: single column */
            .main-grid {
                grid-template-columns: 1fr;
                gap: 10px;
                padding: 10px;
            }
            .msg-widget { grid-column: span 1; }

            /* Pie chart: side by side on bigger phones, stacked on small */
            .chart-body { padding: 12px; gap: 12px; }
            .pie-chart-outer { width: 110px; height: 110px; }

            /* Calendar: tighter spacing */
            .cal-body { padding: 12px; }
            .cal-cell  { font-size: .62rem; padding: 4px 1px; }
            .cal-head  { font-size: .55rem; }

            /* Message list */
            .msg-body { padding: 8px 10px 10px; }
            .msg-avatar { width: 30px; height: 30px; font-size: .72rem; }

            /* Widget header */
            .widget-header { padding: 12px 12px 10px; }
        }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Very small (≤ 360px)
        ══════════════════════════════════════════════════ */
        @media (max-width: 360px) {
            .stat-grid { grid-template-columns: 1fr 1fr; gap: 6px; padding: 8px 8px 0; }
            .main-grid { padding: 8px; gap: 8px; }
            .pie-chart-outer { width: 95px; height: 95px; }
            .pie-hole { width: 46px; height: 46px; }
            .pie-num  { font-size: .95rem; }
        }
    </style>

@endsection