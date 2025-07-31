
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Warehouse Dashboard</title>
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
            text-align: right;
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

    </style>
</head>
<body>
<button class="toggle-btn">☰ القائمة</button>
<div class="sidebar">
    <ul>
        <li><a href="{{route('admin.products.index')}}"> المنتجات</a></li>
        <li><a href="{{route('admin.categories.index')}}"> الاصناف</a></li>
        <li><a href="{{route('admin.units.index')}}"> الواحدات </a></li>
        <li><a href="{{route('admin.warehouses.index')}}"> المخازن </a></li>
        <li><a href="{{route('admin.warehouseUsers.index')}}"> مدراء المخازن </a></li>
        <li><a href="{{route('admin.export.documents')}}"> تحميل الفواتير </a></li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
        🔓 تسجيل الخروج
    </a>

</div>

  <div class="dashboard" >
    <div class="cards">
      <div class="card">
        <h2>{{$productCount}}</h2>
        <p>عدد المنتجات</p>
      </div>
      <div class="card">
        <h2>{{$warehouseCount}}</h2>
        <p>عدد المستودعات</p>
      </div>
      <div class="card">
        <h2>{{$unitCount}}</h2>
        <p>عدد الوحدات</p>
      </div>
      <div class="card">
        <h2>{{$categoryCount}}</h2>
        <p>عدد الأصناف</p>
      </div>
    </div>

    <div class="charts">
      <div class="chart-container">
        <h3>عدد المنتجات حسب التصنيف</h3>
        <canvas id="categoryChart"></canvas>
      </div>
      <div class="chart-container">
        <h3>نسبة الكميات في المستودعات</h3>
        <canvas id="warehouseChart"></canvas>
      </div>
    </div>


      <div style="margin-top: 50px;">
          <h3 style="color:#000;">منتجات منخفضة الكمية</h3>
          <table style="width: 100%; border-collapse: collapse; color: #000; background: #fff;">
              <thead style="background-color: #eee;">
              <tr>
                  <th style="padding: 10px;">اسم المنتج</th>
                  <th style="padding: 10px;">المستودع</th>
                  <th style="padding: 10px;">الكمية الحالية</th>
                  <th style="padding: 10px;">الحد الأدنى</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($lowStockProducts as $product)
                  <tr style="border-bottom: 1px solid #ccc;">
                      <td style="padding: 10px;">{{ $product->product_name }}</td>
                      <td style="padding: 10px;">{{ $product->warehouse_name }}</td>
                      <td style="padding: 10px;">{{ $product->quantity }}</td>
                      <td style="padding: 10px;">{{ $product->min_quantity }}</td>
                      <td class="action-buttons">

                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="4" style="padding: 10px; text-align: center;">لا توجد منتجات منخفضة الكمية حالياً</td>
                  </tr>
              @endforelse
              </tbody>
          </table>
      </div>

  </div>

  <script>
    const categoryChart = new Chart(document.getElementById('categoryChart'), {
      type: 'bar',
      data: {
        labels: {!! json_encode($productQuantitiesPerCategory->pluck('category_name')) !!},
        datasets: [{
            label: 'الكمية الإجمالية لكل تصنيف',
            data: {!! json_encode($productQuantitiesPerCategory->pluck('total_quantity')) !!},
          backgroundColor: '#2e7d32'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        }
      }
    });

    const warehouseChart = new Chart(document.getElementById('warehouseChart'), {
      type: 'pie',
      data: {
        labels: {!! json_encode($productQuantitiesPerWarehouse->pluck('warehouse_name')) !!},
        datasets: [{
          label: 'النسبة المئوية',
          data: {!! json_encode($productQuantitiesPerWarehouse->pluck('percentage')) !!},
          backgroundColor: ['#2e7d32', '#a0a0a0', '#c8e6c9']
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
