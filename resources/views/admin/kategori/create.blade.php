@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<h4 class="mb-3 mt-3">Tambah Kategori</h4>

<div class="card">
    <form action="{{ route('admin.kategori.store') }}" 
          method="POST" 
          class="card-body">

        @csrf

        <div class="row">
            <div class="col-md-6">
                
                <x-input name="nama_kategori" 
                         placeholder="Nama Kategori" 
                         :value="old('nama_kategori')" />

                <button type="submit" class="btn btn-primary mt-2">
                    Simpan
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