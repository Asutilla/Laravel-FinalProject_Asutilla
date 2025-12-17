<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
            <div>
                <h1 style="font-size: 32px; font-weight: 800; color: #1e293b; letter-spacing: -0.025em; margin: 0;">Executive Overview</h1>
                <p style="color: #64748b; font-size: 15px; margin-top: 8px;">Real-time inventory metrics and system performance.</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <button style="background: white; color: #475569; padding: 10px 24px; border-radius: 10px; font-weight: 700; border: 1px solid #e2e8f0; font-size: 13px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    Download Report
                </button>
                @if($canEdit)
                <a href="{{ route('admin.products.create') }}" style="background: #2563eb; color: white; padding: 10px 24px; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 13px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    + Add Product
                </a>
                @endif
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 30px;">

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; position: relative;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="background: #f0fdf4; padding: 8px; border-radius: 10px;">💰</span>
                    <span style="background: #dcfce7; color: #166534; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 6px; text-transform: uppercase;">Value</span>
                </div>
                <div style="margin-top: 20px;">
                    <p style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; margin: 0;">Inventory Value</p>
                    <p style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 5px 0 0 0;">${{ number_format($inventoryValue ?? 0, 2) }}</p>
                </div>
            </div>

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0;">
                <div style="background: #fff7ed; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">⚠️</div>
                <p style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; margin: 0;">Low Stock Items</p>
                <p style="font-size: 28px; font-weight: 900; color: #ef4444; margin: 5px 0 0 0;">{{ $lowStockItems ?? 0 }}</p>
            </div>

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0;">
                <div style="background: #eff6ff; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">📦</div>
                <p style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; margin: 0;">Total SKUs</p>
                <p style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 5px 0 0 0;">{{ $productCount ?? 0 }}</p>
            </div>

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0;">
                <div style="background: #fdf2f8; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">🏷️</div>
                <p style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; margin: 0;">Categories</p>
                <p style="font-size: 28px; font-weight: 900; color: #1e293b; margin: 5px 0 0 0;">{{ $categoryCount ?? 0 }}</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">

            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div style="background: white; padding: 30px; border-radius: 24px; border: 1px solid #e2e8f0;">
                    <h3 style="font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 25px;">Stock Distribution by Category</h3>
                    <div style="height: 250px;">
                        <canvas id="stockDistributionChart"></canvas>
                    </div>
                </div>

                <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 16px; font-weight: 800; color: #1e293b; margin: 0;">Recently Registered Items</h3>
                        <a href="{{ route('admin.products.index') }}" style="color: #2563eb; font-size: 13px; font-weight: 700; text-decoration: none;">Full Inventory →</a>
                    </div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="text-align: left; padding: 12px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Product</th>
                                <th style="text-align: center; padding: 12px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Status</th>
                                <th style="text-align: right; padding: 12px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Check added: Use null-coalescing to ensure $recentProducts is a collection --}}
                            @forelse($recentProducts ?? collect() as $product)
                            <tr style="border-bottom: 1px solid #f8fafc;">
                                <td style="padding: 16px 24px; font-size: 14px; font-weight: 600; color: #1e293b;">{{ $product->name }}</td>
                                <td style="padding: 16px 24px; text-align: center;">
                                    @php
                                    $stock_status_color = $product->stock <= 5 ? '#ef4444' : '#059669' ;
                                        $stock_status_bg=$product->stock <= 5 ? '#fef2f2' : '#ecfdf5' ;
                                            @endphp
                                            <span style="background: {{ $stock_status_bg }}; color: {{ $stock_status_color }}; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800;">
                                            {{ $product->stock }} units left
                                            </span>
                                </td>
                                <td style="padding: 16px 24px; text-align: right; font-weight: 700; color: #1e293b;">${{ number_format($product->price, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 20px; color: #94a3b8;">No recently registered items to display.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div style="background: #1e293b; padding: 30px; border-radius: 24px; color: white;">
                    <h4 style="font-size: 16px; font-weight: 800; margin: 0 0 25px 0;">System Health</h4>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span style="color: #94a3b8; font-size: 14px;">Database Status</span>
                        <span style="color: #22c55e; font-size: 14px; font-weight: 800;">Online</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #94a3b8; font-size: 14px;">Storage Link</span>
                        <span style="color: #22c55e; font-size: 14px; font-weight: 800;">Active</span>
                    </div>
                    <p style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #334155; font-size: 11px; color: #64748b; line-height: 1.6;">
                        Last auto-backup: 04:00 AM. <br>Environment: Production v12.42.0
                    </p>
                </div>

                <div style="background: white; padding: 30px; border-radius: 24px; border: 1px solid #e2e8f0;">
                    <h4 style="font-size: 16px; font-weight: 800; color: #1e293b; margin: 0 0 20px 0;">Critical Stock Alerts</h4>

                    @php
                    // Filter the recent products to find critical items (stock < 3, assuming a critical threshold of 3)
                        $criticalProducts=($recentProducts ?? collect())->filter(fn($product) => $product->stock < 3);
                            @endphp

                            @forelse($criticalProducts as $product)
                            <div style="background: #fef2f2; padding: 15px; border-radius: 15px; border: 1px solid #fee2e2; display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                            <span style="font-size: 13px; font-weight: 700; color: #ef4444; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 140px;">{{ Str::limit($product->name, 20) }}</span>
                            <span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 800;">
                                {{ $product->stock }} LEFT
                            </span>
                </div>
                @empty
                <div style="background: #ecfdf5; padding: 15px; border-radius: 15px; border: 1px solid #d1fae5; text-align: center;">
                    <span style="font-size: 13px; font-weight: 700; color: #059669;">No critical stock alerts!</span>
                </div>
                @endforelse
            </div>
        </div>

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stockData = @json($stockDistribution ?? []);

            if (Object.keys(stockData).length === 0) {
                const chartContainer = document.getElementById('stockDistributionChart').parentElement;
                chartContainer.innerHTML = '<div style="height: 250px; display: flex; align-items: center; justify-content: center; color: #94a3b8; border: 1px dashed #e2e8f0; border-radius: 15px;">No product stock data to display yet.</div>';
                return;
            }

            const labels = Object.keys(stockData);
            const dataPoints = Object.values(stockData);

            const backgroundColors = labels.map((_, index) => {
                const colors = ['#2563eb', '#34d399', '#f97316', '#8b5cf6', '#ef4444'];
                return colors[index % colors.length];
            });

            const ctx = document.getElementById('stockDistributionChart').getContext('2d');
            const stockDistributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Stock Quantity',
                        data: dataPoints,
                        backgroundColor: backgroundColors,
                        borderWidth: 0,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9',
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#64748b'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#64748b'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#f8fafc',
                            bodyColor: '#f8fafc',
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Stock: ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>