@php
    $level++;
@endphp
@foreach ($items->where('parent_id', $parent) as $item)
    <tr>
        <td>
            @if ($level)
                {{ str_repeat('—', $level) }}
            @endif
            <a href="{{ route('admin.category.show', ['category' => $item->id]) }}"
               style="font-weight:@if ($level) normal @else bold @endif; text-decoration: none;">
                {{ $item->title }}
            </a>
        </td>
        <td style="display: flex;">
            <a href="{{ route('admin.category.edit', ['category' => $item->id]) }}">
                <i class="far fa-edit"></i>
            </a>
            <form action="{{ route('admin.category.destroy', ['category' => $item->id]) }}"
                  method="post" onsubmit="return confirm('Delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                    <i style="margin-left: 10px;" class="far fa-trash-alt text-danger"></i>
                </button>
            </form>
        </td>
    </tr>
    @if (count($items->where('parent_id', $parent)))
        @include('admin.category.part.tree', ['level' => $level, 'parent' => $item->id])
    @endif
@endforeach