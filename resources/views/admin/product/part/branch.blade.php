@php($level++)
@foreach ($items->where('parent_id', $parent) as $item)
    <option value="{{ $item->id }}">
        @if ($level) {!! str_repeat('—', $level) !!}  @endif {{ $item->title }}
    </option>
    @if (count($items->where('parent_id', $parent)))
        @include('admin.product.part.branch', ['level' => $level, 'parent' => $item->id])
    @endif
@endforeach