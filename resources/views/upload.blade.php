@extends('layouts.base')

@section('content')
    <form method="POST" action="{{ Route('table') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="driversFile" class="form-label">Drivers File</label>
                <input class="form-control" type="file" id="driversFile" name="driversFile">
            </div>
            @error('driversFile')
                    <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="adressFile" class="form-label">Adress File</label>
                <input class="form-control" type="file" id="adressFile" name="adressFile">
            </div>
            @error('adressFile')
                    <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Generate</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Adress</th>
            </tr>
        </thead>
        <tbody>
            @empty($shipments)
                <tr>
                    <td colspan="2">No shipments</td>
                </tr>
            @else
            @foreach ($shipments as $name => $adress)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $adress }}</td>
                </tr>
            @endforeach
            @endempty
        </tbody>
    </table>
@endsection

@yield('table')
