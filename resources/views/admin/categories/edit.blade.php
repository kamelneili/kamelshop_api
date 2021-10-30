@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include("layouts.sidebar")
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h3 class="card-title">Update {{ $category->title }}</h3>
                <div class="card-body">
                    <form method="post" action="{{ route("categories.update",$product->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <input type="text"
                            name="title"
                            placeholder="Titre"
                            value="{{ $category->title }}"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="slug" placeholder="Slug"
                                cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                        </div>


                        <div class="form-group">
                            <img src="{{ asset($category->image) }}"
                            width="200"
                            height="200"
                            alt="{{ $category->title }}">
                        </div>
                        <div class="form-group">
                            <input type="file"
                            name="image"
                            class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
