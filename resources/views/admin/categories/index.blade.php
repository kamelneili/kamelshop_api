@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
            <a
                class="btn btn-primary my-2">
                    <i class="fa fa-plus"></i>
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Qty</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title}}</td>
                            <td>{{ Str::limit($category->slug,50) }}</td>

                            <td>
                                <img src="{{ asset($category->image) }}"
                                     alt="{{ $category->title }}"
                                    width="50"
                                    height="50"
                                    class="img-fluid rounded"
                                >
                            </td>

                            <td class="d-flex flex-row justify-content-center align-items-center">
                                <a
                                    class="btn btn-sm btn-warning mr-2">
                                        <i class="fa fa-edit"></i>
                                </a>
                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="justify-content-center d-flex">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
