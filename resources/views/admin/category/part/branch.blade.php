@php($level++)
@foreach ($items->where('parent_id', $parent) as $item)
    <option value="{{ $item->id }}" >
    <div style="font-weight:@if ($level) normal @else bold @endif"></div>
        @if ($level) {!! str_repeat('—', $level) !!}  @endif {{ $item->title }}
    </option>
    @if (count($items->where('parent_id', $parent)))
        @include('admin.category.part.branch', ['level' => $level, 'parent' => $item->id])
    @endif
@endforeach