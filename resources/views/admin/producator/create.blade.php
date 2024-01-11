@extends('admin.layouts.admin')

@section('title', 'Adaugă un producaător')

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
    <div class="content">
        <div class="container">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Adăugare producător</h3>
                    </div>
                    <form action="{{route('producatori.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nume Producător</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{old('name')}}" placeholder="Nume Producător" required>
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo Producătorului</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/png, image/jpeg">
                                        <label class="custom-file-label" for="logo">Selecteză Logoul</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website">Web Site</label>
                                <input type="text" class="form-control" id="website" name="website"
                                       value="{{old('website')}}" placeholder="Pagina Web">
                            </div>
                            <div class="form-group">
                                <label for="country">Țara</label>
                                <input type="text" class="form-control" id="country" name="country"
                                       value="{{old('country')}}" placeholder="Țara">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Salvează</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
