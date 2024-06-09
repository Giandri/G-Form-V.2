@foreach ($articles as $article)

<form enctype="multipart/form-data" action="{{ route('account.update', $article->id) }}" method="post">
  @method('PUT')
  @csrf
  <div class="modal fade" id="ModalEdit-{{ $article->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-light">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="" class="ms-2 form-label h5">Judul Artikel</label>
            <input value="{{ old('name', $article->name) }}" type="text"
              class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="article name"
              name="name">
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="ms-2 form-label h5">Tag</label>
            <input value="{{ old('tag', $article->tag) }}" type="text"
              class="@error('tag') is-invalid @enderror form-control form-control-lg" placeholder="tag" name="tag">
            @error('tag')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="" class="ms-2 form-label h5">Deskripsi</label>
            <textarea name="description" placeholder="description" class="form-control" cols="30"
              rows="2">{{ old('description', $article->description) }}</textarea>
          </div>
          <div class="mb-3">
            <label for="" class="ms-2 form-label h5">Gambar</label>
            <input type="file" class="form-control form-control-lg" name="image">
            @if($article->image != "")
            <img class="w-50 my-5" style="margin-left: 25%" src="{{ asset('upload/articles/'.$article->image) }}"
              alt="">
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endforeach