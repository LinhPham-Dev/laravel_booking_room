@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 mx-2">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>{{ $page }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Name --}}
                            <div class="form-group">
                                <label for="title">Title :</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" id="name"
                                    name="title" value="{{ old('title') }}" autofocus>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Slug --}}
                            <div class="form-group">
                                <label for="slug">Url :</label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug"
                                    name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="room_avatar">Choose Image :</label>
                                <input class="form-control-file d-block" type="file" id="blog_image" name="blog_image">
                                @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-2">
                                <img id="image-show" style="padding: 18px 10px 10px 0;" width="70%"
                                    style="display: none">
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            {{-- Category --}}
                            <div class="form-group">
                                <label for="category">Blog Category: </label>
                                <select class="form-control" name="blog_category_id" id="category">
                                    @foreach ($categories as $category)
                                    <option {{ request()->blog_category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="summernote">Description: </label>
                            <textarea class="form-control" name="content" id="summernote"></textarea>
                            @error('content')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <button type="submit" class="btn btn-info btn-lg mx-3">
                    Add New Blog !
                </button>
            </form>
        </div>
    </div>
</main>

@endsection

@section('script-option')
<!-- Compiled Slug -->
<script src="{{ asset('assets/backend/js/slug.js') }}"></script>
@includeIf('backend.layouts.preview-input-selected')
@endsection
