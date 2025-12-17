<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 24px; color: #1e293b; font-family: 'Inter', sans-serif;">
            Edit Product: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                            style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Category</label>
                            <select name="category_id" required style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px; background: white;">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Price ($)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                                style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Stock Quantity</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                                style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Image (Optional)</label>
                            <input type="file" name="image" style="font-size: 13px;">
                            @if($product->image)
                            <p style="font-size: 10px; color: #64748b; mt-2;">Current: {{ $product->image }}</p>
                            @endif
                        </div>
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Description</label>
                        <textarea name="description" rows="4" style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div style="display: flex; gap: 15px; border-top: 1px solid #f1f5f9; padding-top: 30px;">
                        <button type="submit" style="background: #2563eb; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 800; border: none; cursor: pointer;">
                            Update Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" style="padding: 12px 20px; color: #64748b; font-weight: 700; text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>