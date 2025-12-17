<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">Inventory Management</h1>
                <p style="color: #94a3b8; font-size: 14px; margin-top: 5px;">Full product catalog visibility.</p>
            </div>

            @if($canEdit)
            <a href="{{ route('admin.products.create') }}" style="background: #2563eb; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                + Add Product
            </a>
            @else
            <div style="background: #f1f5f9; color: #64748b; padding: 10px 20px; border-radius: 12px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; border: 1px solid #e2e8f0;">
                🔒 View-Only Mode
            </div>
            @endif
        </div>

        <div style="background: white; padding: 30px; border-radius: 24px; border: 1px solid #e2e8f0; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <form action="{{ route('admin.products.index') }}" method="GET" style="display: grid; grid-template-columns: 2fr 1.5fr 1fr 1fr auto auto; gap: 15px; align-items: end;">
                <div>
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Product Name</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Search items..." style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Category</label>
                    <select name="category_id" style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px; font-size: 14px;">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Min ($)</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Max ($)</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px; font-size: 14px;">
                </div>
                <button type="submit" style="background: #1e293b; color: white; padding: 11px 24px; border-radius: 10px; font-weight: 700; border: none; cursor: pointer;">Apply</button>
                <a href="{{ route('admin.products.index') }}" style="background: #f1f5f9; color: #64748b; padding: 11px 18px; border-radius: 10px; font-weight: 700; text-decoration: none; font-size: 13px;">Reset</a>
            </form>
        </div>

        <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Item Details</th>
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Category</th>
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Stock Status</th>
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase;">Price</th>
                        @if($canEdit)
                        <th style="padding: 20px 24px; font-size: 11px; color: #94a3b8; text-transform: uppercase; text-align: right;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='white'">
                        <td style="padding: 20px 24px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid #e2e8f0;">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                    <span style="font-size: 20px;">📦</span>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.show', $product->id) }}" style="text-decoration: none; font-weight: 800; color: #1e293b; font-size: 15px; display: block;">{{ $product->name }}</a>
                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">SKU: {{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 20px 24px;">
                            <span style="background: #eff6ff; color: #2563eb; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">{{ $product->category->name }}</span>
                        </td>
                        <td style="padding: 20px 24px;">
                            @if($product->stock <= 5)
                                <span style="color: #ef4444; font-weight: 800; font-size: 14px;">{{ $product->stock }} units (Low)</span>
                                @else
                                <span style="color: #1e293b; font-weight: 600; font-size: 14px;">{{ $product->stock }} units</span>
                                @endif
                        </td>
                        <td style="padding: 20px 24px; font-weight: 800; color: #1e293b; font-size: 16px;">
                            ${{ number_format($product->price, 2) }}
                        </td>

                        @if($canEdit)
                        <td style="padding: 20px 24px; text-align: right;">
                            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                                <a href="{{ route('admin.products.edit', $product->id) }}" style="color: #2563eb; text-decoration: none; font-size: 13px; font-weight: 700;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete item?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="color: #ef4444; background: none; border: none; font-size: 13px; font-weight: 700; cursor: pointer; padding: 0;">Delete</button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="padding: 20px; background: #f8fafc; text-align: center;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>