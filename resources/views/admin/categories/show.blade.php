<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="margin-bottom: 24px;">
            <a href="{{ route('admin.categories.index') }}" style="text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600;">
                ← Back to Categories
            </a>
        </div>

        <div style="background: white; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h1 style="font-size: 32px; font-weight: 800; color: #1e293b; margin: 0;">{{ $category->name }}</h1>
                    <p style="color: #64748b; font-size: 16px; margin-top: 10px; max-width: 700px; line-height: 1.6;">
                        {{ $category->description ?? 'No description provided for this category.' }}
                    </p>
                </div>
                @if(Auth::user()->is_admin)
                <a href="{{ route('admin.categories.edit', $category->id) }}" style="background: #1e293b; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; text-decoration: none;">Edit Category</a>
                @endif
            </div>
        </div>

        <h3 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 20px;">Products in this Category</h3>

        <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: #f8fafc;">
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Product Name</th>
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Stock</th>
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase; text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($category->products as $product)
                    <tr style="border-bottom: 1px solid #f1f5f9; cursor: pointer;" onclick="window.location='{{ route('admin.products.show', $product->id) }}'">
                        <td style="padding: 20px 24px; font-weight: 700; color: #1e293b;">{{ $product->name }}</td>
                        <td style="padding: 20px 24px;">
                            <span style="color: {{ $product->stock <= 5 ? '#ef4444' : '#64748b' }}; font-weight: 600;">
                                {{ $product->stock }} units
                            </span>
                        </td>
                        <td style="padding: 20px 24px; text-align: right; font-weight: 800; color: #1e293b;">
                            ${{ number_format($product->price, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 40px; text-align: center; color: #94a3b8;">No products found in this category.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>