<x-app-layout>
    @php
    $isEdit = isset($category);
    $title = $isEdit ? 'Edit Category: ' . $category->name : 'Create New Category';
    $route = $isEdit ? route('admin.categories.update', $category->id) : route('admin.categories.store');
    $method = $isEdit ? 'PUT' : 'POST';
    $buttonText = $isEdit ? 'Update Category' : 'Create Category';
    $currentName = $isEdit ? old('name', $category->name) : old('name');
    @endphp

    <div style="background: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 800; color: #1e293b; margin: 0;">{{ $title }}</h1>
            <a href="{{ route('admin.categories.index') }}" style="color: #64748b; text-decoration: none; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 5px;">
                ← Back to Categories
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

        <div style="background: white; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); max-width: 600px;">

            <form action="{{ $route }}" method="POST">
                @csrf
                @method($method) {{-- PUT method for updates --}}

                <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 20px;">Category Details</h2>

                <div style="margin-bottom: 30px;">
                    <label for="name" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $currentName }}" required
                        style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                        placeholder="e.g., Electronics, Apparel, Home Goods">
                </div>

                <div style="border-top: 1px solid #f1f5f9; padding-top: 30px; text-align: right;">
                    <button type="submit"
                        style="background: #2563eb; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: background 0.2s;"
                        onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>