@if ($project->exists)
    <form action="{{route('admin.projects.update', $project)}}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else
    <form action="{{route('admin.projects.store')}}" enctype="multipart/form-data" method="POST"> 
@endif

    @csrf
    <div class="row g-4">
        <div class="col-6">
            {{-- Input title --}}
            <div class="form-group">
                <label for="title">Titolo Progetto</label>
                <input id="title" class="form-control my-2 @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror" type="text" name="title" value="{{old('title', $project->title)}}" >
                @error('title')
                <div class="invalid-feedback">{{$message}}</div>
                @else
                <div class="form-text">Inserisci il titolo del progetto</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <label for="slug">Slug</label>
            <input type="text" id="slug" class="form-control my-2" value="{{Str::slug(old('title', $project->title))}}" disabled >
        </div>
        <div class="col-10">
            {{-- Input image --}}
            <div class="form-group">
                <label for="image">Screenshot progetto</label>
                <input id="image" class="form-control my-2 @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" type="file" name="image" value="{{old('image', $project->image)}}" >
                @error('image')
                <div class="invalid-feedback">{{$message}}</div>
                @else
                <div class="form-text">Inserisci il link dell'immagine</div>
                @enderror
            </div>
        </div>
        <div class="col-1">
            {{-- Preview image --}}
            <img src="{{old('image', $project->image) ? $project->printImage() : 'https://marcolanci.it/boolean/assets/placeholder.png'}}" alt="{{ $project->image ? $project->title : 'preview'}}" class="img-fluid" id="preview">
        </div>
        <div class="col-12">
            {{-- Input content --}}
            <div class="form-group">
                <label for="content">Descrizione progetto</label>
                <textarea name="content" id="content" class="form-control my-2 @error('content') is-invalid @elseif(old('content', '')) is-valid @enderror" rows="10">{{old('content', $project->content)}}</textarea>
                @error('content')
                <div class="invalid-feedback">{{$message}}</div>
                @else
                <div class="form-text">Inserisci la descrizione del progetto</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between my-4">
        <a href="{{route('admin.projects.index')}}" class="btn btn-outline-secondary"><i class="far fa-hand-point-left me-2"></i>Torna indietro</a>
        <div>
            <button type="reset" class="btn btn-info"><i class="fas fa-eraser me-2"></i>Svuota i campi</button>
            <button type="submit" class="btn btn-success"><i class="far fa-floppy-disk me-2"></i>Salva</button>
        </div>
    </div>
</form>