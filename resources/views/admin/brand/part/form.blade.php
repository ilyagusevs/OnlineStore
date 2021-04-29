@csrf
<div class="row">
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Title</label>
            <input type="text" class="form-control" name="brand" 
                required maxlength="100" value="{{ old('brand') ?? $brand->brand ?? '' }}">
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Slug</label>
            <input type="text" class="form-control" name="brand_slug" 
                required maxlength="100" value="{{ old('brand_slug') ?? $brand->brand_slug ?? '' }}">
        </div>
    </div>
</div>

<div class="form-group">
    <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Save brand</button>
</div>