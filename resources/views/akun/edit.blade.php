@extends('layouts.template')

@section('content')
    <form action="{{ route('akun.update', $users['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
        <ul class="alert alert-danger p-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name= "name" value="{{ $users['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label"> Tipe Pengguna:</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disbled hidden>Pilih</option>
                    <option value="admin" {{ $users['role'] == 'admin' ? 'selected' : ''}}>admin</option>
                    <option value="cashier" {{ $users['role'] == 'kasir' ? 'selected' : ''}}>kasir</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name= "email" value="{{ $users['email'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primay mt-3">Ubah Data</button>
        </div>
    </form>
    @endsection