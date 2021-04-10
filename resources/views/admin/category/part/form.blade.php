@csrf
<div class="row">
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Title</label>
            <input type="text" class="form-control" name="title" 
                required maxlength="100" value="{{ old('title') ?? $category->title ?? '' }}">
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Slug</label>
            <input type="text" class="form-control" name="slug" 
                required maxlength="100" value="{{ old('slug') ?? $category->slug ?? '' }}">
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="form-group">
                @php
                    $parent_id = old('parent_id') ?? $category->parent_id ?? 0;
                @endphp
                <label style="margin-bottom: 10px;">Parent category</label>
                <select name="parent_id" class="form-control">
                    <option value="0">Without parent</option>
                    @if (count($items))
                        @include('admin.category.part.branch', ['level' => -1, 'parent' => 0])
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Save category</button>
</div>