<x-app-layout>
    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">Create New Product</h1>
            <a href="{{ route('admin.products.index') }}" style="color: #64748b; text-decoration: none; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 5px;">
                ← Back to Inventory
            </a>
        </div>

        @if ($errors->any())
        <div style="background-color: #fef2f2; color: #ef4444; border-radius: 12px; padding: 15px 20px; margin-bottom: 20px; border: 1px solid #fee2e2;">
            <p style="font-weight: 700; margin-bottom: 10px;">Whoops! Something went wrong.</p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div style="background: white; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">

                    <div>
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 20px;">Product Information</h2>

                        <div style="margin-bottom: 20px;">
                            <label for="name" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Product Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                                placeholder="e.g., Wireless Bluetooth Speaker">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="price" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Price ($)</label>
                            <input type="number" id="price" name="price" value="{{ old('price') }}" required step="0.01" min="0.01"
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                                placeholder="0.00">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="stock" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Initial Stock</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0"
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                                placeholder="0">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="category_id" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Category</label>
                            <select id="category_id" name="category_id" required
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;">
                                <option value="" disabled selected>Select a Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 20px;">Media and Description</h2>

                        <div style="margin-bottom: 20px;">
                            <label for="image" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Product Image</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;">
                            <p style="font-size: 12px; color: #94a3b8; margin-top: 5px;">Max size 2MB (JPG, PNG, GIF)</p>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="description" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Description</label>
                            <textarea id="description" name="description" rows="6"
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                                placeholder="A brief description of the product...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div style="border-top: 1px solid #f1f5f9; padding-top: 30px; text-align: right;">
                    <button type="submit"
                        style="background: #2563eb; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: background 0.2s;"
                        onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>