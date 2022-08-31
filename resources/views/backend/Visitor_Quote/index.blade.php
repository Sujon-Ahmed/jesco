@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Quotes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Visitor Quotes</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Visitor Quotes</h5>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>message</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->id }}</td>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{{ $visitor->message }}</td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
