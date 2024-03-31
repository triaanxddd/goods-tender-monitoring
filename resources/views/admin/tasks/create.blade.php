<x-app-layout>
    <x-slot name="title">New Task</x-slot>
    <a class="btn btn-primary" href="/admin/tasks" role="button">Back to Tasks</a>
    <div class="col-lg-8 mt-5">

        <form method="post" action="/admin/tasks" enctype="multipart/form-data" class="mb-7">
            @csrf
            <div class="mb-3 row">
                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-8">
                    <input autofocus type="text" class="form-control @error('title') is-invalid  @enderror" id="title" name="title" value="{{ old('title') }}">
                    @error('title') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="">
                <!-- mb-3 row -->
                <!-- <label for="slug" class="col-sm-2 col-form-label">Slug</label> -->
                <div class="col-sm-8">
                    <input type="hidden" class="form-control  @error('slug') is-invalid  @enderror" id="slug" name="slug" disable readonly value="{{ old('slug') }}">
                    @error('slug') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="category" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-4">
                    <select class="form-select col-sm-6" name="category_id">
                        @foreach($categories as $category)
                            @if(old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
    
                        @endforeach
                    </select>
                    
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="file" class="col-sm-2 col-form-label">Dokumen</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control  @error('file') is-invalid  @enderror" id="file" name="file" value="{{ old('file') }}">
                    @error('file') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="body" class="col-sm-2 col-form-label">Batas Waktu</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control @error('due_date') is-invalid  @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}">
                </div>
                @error('due_date') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="title" class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-8">
                    <input autofocus type="text" class="form-control @error('title') is-invalid  @enderror" id="price" name="price" value="{{ old('price') }}">
                    @error('price') 
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!-- Form Deskripsi -->            
            <!-- perbaikan -->
            <div class="mb-3">
                <label for="body" class="form-label">Deskripsi</label>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="body" type="hidden" name="body" required value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
            </div>
            <button type="submit" class="btn btn-primary">Buat Task</button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/admin/tasks/checkSlug?title=' + title.value)
             .then(response => response.json())
             .then(data => slug.value = data.slug)
        });
        
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
</x-app-layout>

