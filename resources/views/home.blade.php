@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        {{ __('Dashboard') }}
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-modal">create</button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Short URL</th>
                              <th scope="col">Orginal URL</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($urls as $url)
                                <tr>
                                    <th scope="row">{{ $loop->iteration}}</th>
                                    <td>{{ config('app.url').$url->encryptUrl }}</td>
                                    <td>{{ $url->orgUrl }}</td>
                                    <td>{!! $url->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Disabled</span>' !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning edit-url" data-bs-toggle="modal" data-bs-target="#create-modal" data-id="{{$url->id}}" data-action="{{route('url.edit',[$url->id])}}" data-form_action="{{route('url.update',[$url->id])}}">Edit</button>
                                        <button type="button" class="btn btn-danger remove-url" data-id="{{$url->id}}" data-action="{{route('url.destroy',[$url->id])}}">Delete</button>
                                    </td>
                                </tr>                                
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('urls.form')
@endsection
