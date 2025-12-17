<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">Category Management</h1>
                <p style="color: #94a3b8; font-size: 14px; margin-top: 5px;">Browse product categories and collections.</p>
            </div>

            @if($canEdit)
            <a href="{{ route('admin.categories.create') }}" style="background: #1e293b; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <span>+ Add Category</span>
            </a>
            @else
            <div style="background: white; border: 1px solid #e2e8f0; padding: 10px 20px; border-radius: 12px; color: #64748b; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                🛡️ <span>Read-Only Mode</span>
            </div>
            @endif
        </div>

        <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 20px 24px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Category Name</th>
                        <th style="padding: 20px 24px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Description</th>
                        <th style="padding: 20px 24px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; text-align: center;">Items</th>
                        @if($canEdit)
                        <th style="padding: 20px 24px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; text-align: right;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='white'">
                        <td style="padding: 24px; vertical-align: top;">
                            <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}" style="text-decoration: none; font-weight: 800; color: #2563eb; font-size: 15px; display: block;">
                                {{ $category->name }}
                                <div style="font-size: 10px; color: #94a3b8; font-weight: 400; text-transform: uppercase; margin-top: 4px;">View Items →</div>
                            </a>
                        </td>
                        <td style="padding: 24px; vertical-align: top;">
                            <p style="margin: 0; color: #64748b; font-size: 14px; line-height: 1.6; max-width: 500px;">
                                {{ $category->description ?? 'No description provided.' }}
                            </p>
                        </td>
                        <td style="padding: 24px; text-align: center; vertical-align: top;">
                            <span style="background: #f1f5f9; color: #475569; padding: 6px 16px; border-radius: 8px; font-weight: 700; font-size: 13px;">
                                {{ $category->products_count }}
                            </span>
                        </td>

                        @if($canEdit)
                        <td style="padding: 24px; text-align: right; vertical-align: top;">
                            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" style="color: #2563eb; text-decoration: none; font-weight: 700; font-size: 13px;">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="color: #ef4444; background: none; border: none; font-weight: 700; font-size: 13px; cursor: pointer; padding: 0;">Delete</button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>