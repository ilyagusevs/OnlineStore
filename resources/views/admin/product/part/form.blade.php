@csrf
<div class="row">
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Title</label>
            <input type="text" class="form-control" name="title" 
                required maxlength="100" value="{{ old('title') ?? $product->title ?? '' }}">
        </div>
    </div>
    <div class="col">
        <label style="margin-bottom: 10px;">Slug</label>
        <div class="form-group">
            <input type="text" class="form-control" name="alias"
                required maxlength="100" value="{{ old('alias') ?? $product->alias ?? '' }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            @php
                $brand_id = old('brand_id') ?? $product->brand_id ?? 0;
            @endphp
            <label style="margin-bottom: 10px;">Brand</label>
            <select name="brand_id" class="form-control">
                <option value="0">Choose</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" @if ($brand->id == $brand_id) selected @endif>
                        {{ $brand->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div style="margin-top: 20px;" class="row">
    <div class="col">
        <div class="form-group">
            @php
                $category_id = old('category_id') ?? $product->category_id ?? 0;
            @endphp
            <label style="margin-bottom: 10px;">Category</label>
            <select name="category_id" class="form-control">
                @if (count($items))
                    @include('admin.product.part.branch', ['level' => -1, 'parent' => 0])
                @endif
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">In stock?</label>
            <select name="in_stock" class="form-control" title="Brand">
                <option value="0">YES</option>
                <option value="1">NO</option>
            </select>
        </div>
    </div>
</div>

<div style="margin-top: 20px;" class="row">
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Price</label>
            <input type="text" class="form-control" name="old_price" 
                value="{{ old('old_price') ?? $product->old_price ?? '' }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Price with discount</label>
            <input type="text" class="form-control" name="new_price" 
                value="{{ old('new_price') ?? $product->new_price ?? '' }}">
            <small style="font-size: 12px;">* If there is no discount, then enter the same amount as in 'Price'</small>
        </div>
    </div>
</div>

<div style="margin-top: 20px;" class="form-group">
    <label style="margin-bottom: 10px;">Description</label>
    <textarea class="form-control" name="description"
              rows="4">{{ old('description') ?? $product->description ?? '' }}</textarea>
</div>


<div style="margin-top: 20px;" class="form-group">
    <button type="submit" class="btn btn-primary">Save product</button>
</div>