@csrf
<div class="row">
    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Title</label>
            <input type="text" class="form-control" name="title" 
                required maxlength="100" value="{{ old('title') ?? $brand->title ?? '' }}">
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label style="margin-bottom: 10px;">Slug</label>
            <input type="text" class="form-control" name="slug" 
                required maxlength="100" value="{{ old('slug') ?? $brand->slug ?? '' }}">
        </div>
    </div>
</div>

<div class="form-group">
    <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Save brand</button>
</div>