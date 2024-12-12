@foreach ($categories as $category)
    <option value="{{ $category->id }}">{{ (isset($prefix) ? $prefix : '') . ' ' . $category->name }}</option>
    @if ($category->children->isNotEmpty())
        @include('online.category.dropdown', ['categories' => $category->children, 'prefix' => $prefix . '--'])
    @endif
@endforeach
