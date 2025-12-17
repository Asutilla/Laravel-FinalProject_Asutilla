<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <a href="{{ route('admin.products.index') }}" style="text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Inventory
            </a>

            @if(Auth::user()->is_admin)
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.products.edit', $product->id) }}" style="background: white; color: #1e293b; padding: 10px 20px; border-radius: 10px; font-weight: 700; text-decoration: none; border: 1px solid #e2e8f0; font-size: 14px;">Edit Item</a>
            </div>
            @endif
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 40px;">

            <div>
                <div style="background: white; padding: 20px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); position: sticky; top: 40px;">
                    <div style="background: #f8fafc; border-radius: 16px; aspect-ratio: 1/1; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid #f1f5f9; margin-bottom: 20px;">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                        <div style="font-size: 80px;">📦</div>
                        @endif
                    </div>

                    <div style="text-align: center; padding: 20px; border: 2px dashed #e2e8f0; border-radius: 12px; background: #fcfcfc;">
                        <div style="font-family: 'Libre Barcode 39', cursive; font-size: 40px; color: #1e293b; line-height: 1;">
                            {{ str_pad($product->id, 8, '0', STR_PAD_LEFT) }}
                        </div>
                        <div style="font-size: 11px; font-weight: 800; color: #94a3b8; letter-spacing: 0.1em; margin-top: 5px;">INTERNAL SKU: {{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 24px;">

                <div style="background: white; padding: 35px; border-radius: 24px; border: 1px solid #e2e8f0;">
                    <span style="background: #eff6ff; color: #2563eb; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                        {{ $product->category->name }}
                    </span>
                    <h1 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 15px 0 10px 0; line-height: 1.2;">{{ $product->name }}</h1>
                    <p style="color: #64748b; font-size: 16px; line-height: 1.6; margin: 0;">{{ $product->description ?? 'No detailed description available for this product.' }}</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div style="background: white; padding: 25px; border-radius: 24px; border: 1px solid #e2e8f0;">
                        <h4 style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 15px 0;">Pricing Information</h4>
                        <div style="display: flex; align-items: baseline; gap: 10px;">
                            <span style="font-size: 36px; font-weight: 900; color: #059669;">${{ number_format($product->price, 2) }}</span>
                            <span style="color: #94a3b8; font-size: 14px; font-weight: 500;">Per Unit</span>
                        </div>
                    </div>

                    <div style="background: white; padding: 25px; border-radius: 24px; border: 1px solid #e2e8f0;">
                        <h4 style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 15px 0;">Stock Availability</h4>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <span style="font-size: 36px; font-weight: 900; color: {{ $product->stock <= 5 ? '#ef4444' : '#1e293b' }};">
                                {{ $product->stock }}
                            </span>
                            <div style="background: {{ $product->stock <= 5 ? '#fef2f2' : '#f0fdf4' }}; color: {{ $product->stock <= 5 ? '#ef4444' : '#15803d' }}; padding: 4px 12px; border-radius: 8px; font-weight: 700; font-size: 12px;">
                                {{ $product->stock <= 5 ? 'LOW STOCK' : 'IN STOCK' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 20px 25px; border-bottom: 1px solid #f1f5f9; background: #fcfcfc;">
                        <h4 style="font-size: 13px; font-weight: 800; color: #1e293b; text-transform: uppercase; margin: 0;">Product Specifications</h4>
                    </div>
                    <div style="padding: 10px 0;">
                        @php
                        $details = [
                        'Product ID' => str_pad($product->id, 8, '0', STR_PAD_LEFT),
                        'Category' => $product->category->name,
                        'Created At' => $product->created_at->format('M d, Y'),
                        'Last Update' => $product->updated_at->diffForHumans(),
                        'Warehouse' => 'Main Branch (Default)'
                        ];
                        @endphp
                        @foreach($details as $label => $value)
                        <div style="display: flex; justify-content: space-between; padding: 15px 25px; {{ !$loop->last ? 'border-bottom: 1px solid #f8fafc;' : '' }}">
                            <span style="color: #94a3b8; font-weight: 600; font-size: 14px;">{{ $label }}</span>
                            <span style="color: #1e293b; font-weight: 700; font-size: 14px;">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>