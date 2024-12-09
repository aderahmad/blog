@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Category</h1>
</div>

<div class="col-lg-8">
<form method="post" action="{{ route('category.update', $category->slug) }}" class="mb-5" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name Category</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $category->name) }}">
    @error('name') 
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $category->slug) }}">
    @error('slug') 
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Edit</button>
</form>
</div>

<!-- <script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

     function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview')
      imgPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }

      }
</script> -->
@endsection