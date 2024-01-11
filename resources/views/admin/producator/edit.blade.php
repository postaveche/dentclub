@extends('admin.layouts.admin')

@section('title', 'Editează un producaător')

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
    <div class="content">
        <div class="container">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editare producător</h3>
                    </div>
                    <form action="{{route('producatori.update', $producator[0]->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nume Producător</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{$producator[0]->name}}" placeholder="Nume Producător" required>
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo Producătorului</label>
                                <img src="/storage/producatori/{{$producator[0]->logo}}" alt="{{$producator[0]->name}}" style="height: 64px;">
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
                                       value="{{$producator[0]->site}}" placeholder="Pagina Web">
                            </div>
                            <div class="form-group">
                                <label for="country">Țara</label>
                                <input type="text" class="form-control" id="country" name="country"
                                       value="{{$producator[0]->country}}" placeholder="Țara">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Editează</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
