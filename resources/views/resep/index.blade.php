@extends('layouts.app')

@section('content')
    <div class="mb-5">
        <a href="{{ route('resep.create') }}" class="btn btn-success px-4">Buat Resep</a>
    </div>

    <h1 class="text-center mb-4">Data Resep</h1>

    <table class="table table-bordered table-sm table-responsive mb-2">
        <thead class="table-light">
            <tr>
                <th class="px-2 py-1">#</th>
                <th class="px-2 py-1">Kode Resep</th>
                <th class="px-2 py-1">Tanggal</th>
                <th class="px-2 py-1">Dibuat</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($resep as $i => $r)
                <tr>
                    <td class="px-2 py-1">{{ $i+1 }}</td>
                    <td class="px-2 py-1">{{ $r->kode }}</td>
                    <td class="px-2 py-1">Tanggal</td>
                    <td class="px-2 py-1">Dibuat</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
