@foreach ($categories as $category)
    <li>
        <strong data-id="{{ $category->id }}">{{ $category->name }}</strong>

        @if ($category->children->isNotEmpty())
            <ul>
                @include('online.category.tree', ['categories' => $category->children])
            </ul>
        @endif
    </li>
@endforeach
