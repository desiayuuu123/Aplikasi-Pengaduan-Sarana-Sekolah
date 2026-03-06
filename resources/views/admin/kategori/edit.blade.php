@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<h4 class="mb-3 mt-3">Edit Kategori</h4>

<div class="card">
    <form class="card-body"
          action="{{ route('admin.kategori.update', $kategori->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">

                <x-input 
                    name="nama_kategori"
                    :value="old('nama_kategori', $kategori->nama_kategori)"
                    placeholder="Nama Kategori" />

                <button type="submit" class="btn btn-primary mt-2">
                    Update
                </button>

                <a href="{{ route('admin.kategori.index') }}"
                   class="btn btn-secondary mt-2">
                    Kembali
                </a>

            </div>
        </div>

    </form>
</div>
@endsection