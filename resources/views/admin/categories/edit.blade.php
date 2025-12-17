<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 24px; color: #1e293b; font-family: 'Inter', sans-serif;">
            Edit Category: {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: #f8fafc; min-height: 100vh;">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);">

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div style="margin-bottom: 25px;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                            style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 10px;">Description</label>
                        <textarea name="description" rows="4" style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 15px;">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <button type="submit" style="background: #2563eb; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 800; border: none; cursor: pointer;">
                            Update Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" style="padding: 12px 20px; color: #64748b; font-weight: 700; text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>