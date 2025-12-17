<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-weight: 800; font-size: 24px; color: #1e293b; font-family: 'Inter', sans-serif;">
                Inventory Asset Report
            </h2>
            <button onclick="window.print()" class="no-print" style="background: #1e293b; color: white; padding: 12px 25px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: 0.3s;">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print to PDF
            </button>
        </div>
    </x-slot>

    <div class="py-12" style="background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; border-radius: 24px; padding: 50px; margin-bottom: 40px; position: relative; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
                <div style="position: relative; z-index: 2;">
                    <p style="text-transform: uppercase; font-size: 13px; font-weight: 700; letter-spacing: 2px; color: #94a3b8; margin-bottom: 15px;">Total Estimated Inventory Value</p>
                    <h1 style="font-size: 56px; font-weight: 900; margin: 0;">${{ number_format($totalValue, 2) }}</h1>
                    <div style="display: flex; align-items: center; gap: 20px; margin-top: 25px; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.1);">
                        <div>
                            <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase;">Generated On</span>
                            <span style="font-weight: 600;">{{ date('F d, Y') }}</span>
                        </div>
                        <div>
                            <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase;">Status</span>
                            <span style="color: #10b981; font-weight: 600;">● System Live</span>
                        </div>
                    </div>
                </div>
                <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(59, 130, 246, 0.1); border-radius: 50%;"></div>
            </div>

            <div style="background: white; border-radius: 24px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <div style="padding: 25px; border-bottom: 1px solid #f1f5f9; background: #fff;">
                    <h3 style="font-weight: 800; color: #1e293b; margin: 0;">Category Asset Breakdown</h3>
                </div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                            <th style="padding: 20px; text-align: left; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Category</th>
                            <th style="padding: 20px; text-align: center; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Items count</th>
                            <th style="padding: 20px; text-align: right; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Calculated Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryReport as $report)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;">
                            <td style="padding: 20px;">
                                <span style="font-weight: 800; color: #1e293b; font-size: 15px;">{{ $report['name'] }}</span>
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                <span style="background: #f1f5f9; padding: 5px 12px; border-radius: 8px; font-weight: 700; color: #475569; font-size: 13px;">
                                    {{ $report['count'] }}
                                </span>
                            </td>
                            <td style="padding: 20px; text-align: right;">
                                <span style="font-weight: 900; color: #2563eb; font-size: 16px;">
                                    ${{ number_format($report['value'], 2) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #f8fafc;">
                        <tr>
                            <td colspan="2" style="padding: 25px; text-align: right; font-weight: 800; color: #64748b; text-transform: uppercase; font-size: 12px;">Total Inventory Portfolio:</td>
                            <td style="padding: 25px; text-align: right; font-weight: 900; color: #1e293b; font-size: 20px;">
                                ${{ number_format($totalValue, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <p style="text-align: center; margin-top: 40px; color: #94a3b8; font-size: 12px;">
                End of automated asset report. Confidential for internal use only.
            </p>
        </div>
    </div>

    <style>
        @media print {
            body {
                background: white !important;
            }

            .no-print,
            nav,
            header,
            button {
                display: none !important;
            }

            .py-12 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .max-w-7xl {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            div {
                box-shadow: none !important;
                border: none !important;
            }

            table {
                border: 1px solid #eee !important;
            }
        }
    </style>
</x-app-layout>