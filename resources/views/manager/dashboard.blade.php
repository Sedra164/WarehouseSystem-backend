<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #000;
        }
        .sidebar {
            position: fixed;
            top: 0;
            right: -220px;
            width: 220px;
            height: 100%;
            background: #2e7d32;
            transition: right .3s;
            padding-top: 60px;
            z-index: 1000;
        }
        .sidebar.open {
            right: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin: 20px 0;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .logout-link {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            background-color: #2e7d32;
            text-align: right;
            color: #fff;
            padding: 14px 20px;
        }
        .toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
            background: #2e7d32;
            color: #fff;
            padding:10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 7px;
            z-index: 1100;
        }
        .dashboard {
            padding: 20px 40px 40px 40px;
            transition: margin-right .3s;
            max-width: 1200px;
            margin:auto;
        }
        .dashboard.shift {
            margin-right: 240px;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .card {
            flex: 1 1 220px;
            background: #e6e6e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card h2 {
            font-size: 2rem;
            color: #2e7d32;
            margin: 0;
        }
        body.sidebar-closed .card {
            flex: 1 1 180px;
            padding: 16px;
        }
        body.sidebar-closed .card h2 {
            font-size: 1.6rem;
        }
        .charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .chart-container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<button class="toggle-btn">☰ القائمة</button>
<div class="sidebar">
    <ul>
        <li><a href="{{route('manager.partners.index')}}">العملاء</a></li>
        <li><a href="{{route('manager.WarehouseProducts.index')}}">المنتجات داخل المخزن</a></li>
        <li><a href="{{route('manager.warehouse_users.index')}}">موظفين المخزن</a></li>
        <li><a href="{{route('manager.export.documents')}}"> تحميل الفواتير </a></li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
        🔓 تسجيل الخروج
    </a>

</div>

<div class="dashboard">
    <div class="cards">
        <div class="card"><h2>{{ $partnersCount }}</h2><p>عدد العملاء</p></div>
        <div class="card"><h2>{{ $warehouseProductsCount }}</h2><p>عدد المنتجات</p></div>
        <div class="card"><h2>{{ $documentsCount }}</h2><p>عدد الفواتير</p></div>
    </div>
    <div class="charts">
        <div style="display: flex; gap: 30px; flex-wrap: wrap; width: 100%;">
            <div class="chart-container" style="flex: 1;"><h3>نسبة العملاء</h3><canvas id="partnersPieChart"></canvas></div>
            <div class="chart-container" style="flex: 1;"><h3>نشاط المستودع شهريًا</h3><canvas id="docsLine"></canvas></div>
        </div>

        <div style="display: flex; gap: 30px; flex-wrap: wrap; width: 100%;">
            <div class="chart-container" style="flex: 1;"><h3>الوثائق حسب النوع</h3><canvas id="docsPieChart"></canvas></div>
            <div class="chart-container" style="flex: 1;"><h3>أعلى المنتجات تداولًا</h3><canvas id="topProducts"></canvas></div>
        </div>
    </div>

</div>

<script>
    const partners = @json($partnersStats);
    const docsByType = @json($docsStats);
    const monthlyDocs = @json($monthlyStats);

    // Pie Chart - partners
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('partnersPieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels:Object.keys(partners),
                datasets: [{
                    label: 'العملاء',
                    data:  Object.values(partners),
                    backgroundColor: ['#2e7d32', '#a0a0a0'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return ` ${value}%`;
                            }
                        }
                    }
                }
            }
        });
    });
    // Pie Chart - documents by type
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('docsPieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels:Object.keys(docsByType),
                datasets: [{
                    label: 'الوثائق',
                    data:  Object.values(docsByType),
                    backgroundColor: ['#2e7d32', '#a0a0a0', '#c8e6c9'],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return ` ${value}%`;
                            }
                        }
                    }
                }
            }
        });
    });
    // Line Chart - monthly documents
    new Chart(document.getElementById('docsLine'), {
        type: 'line', data: { labels: monthlyDocs.months, datasets:[{ label:'عدد الوثائق', data: monthlyDocs.counts, borderColor:'#2e7d32', fill:false }] }
    });
    // Horizontal Bar - top products
    new Chart(document.getElementById('topProducts'), {
        type: 'bar', data:{ labels: @json($productNames), datasets:[{ label:'أعلى المنتجات تداولاً', data: @json($productQuantities), backgroundColor:'#2e7d32' }] },
        options:{ indexAxis:'y', scales:{ x:{ beginAtZero:true } } }
    });

</script>
<script>
    const sidebar = document.querySelector('.sidebar');
    const dashboard = document.querySelector('.dashboard');
    document.querySelector('.toggle-btn').onclick = () => {
        sidebar.classList.toggle('open');
        dashboard.classList.toggle('shift');

    };
    document.addEventListener('click', function (event) {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.toggle-btn');
        if (
            sidebar.classList.contains('open') &&
            !sidebar.contains(event.target) &&
            !toggleBtn.contains(event.target)
        ) {
            sidebar.classList.remove('open');
            document.querySelector('.dashboard').classList.remove('shift');
        }
    });
</script>
</body>
</html>
