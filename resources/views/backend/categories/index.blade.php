@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>{{ $page }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card px-3 pt-3">
                    <form method="GET">
                        <div class="row my-3">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter category name ..." value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="status" class="form-control">
                                    <option {{ request()->status === 1 ? 'selected' : '' }} value="1">Show</option>
                                    <option {{ request()->status === 0 ? 'selected' : '' }} value="0">Hide</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">Add new Category</h3>
                    </div>
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            {{-- Name --}}
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Url --}}
                            <div class="form-group">
                                <label for="slug">Url :</label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug"
                                    name="slug" value="{{ old('slug') }}" autofocus>
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="category_image">Choose Image :</label>
                                <input class="form-control-file" type="file" id="category_image" name="category_image">
                                @error('category_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <label for="status">Status: </label>
                            <select class="form-control" name="status" id="status">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success mt-2">
                                Add new !
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <section class="content-page">
                    @includeIf('backend.layouts.alert')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable Categoris</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-hover table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Url</th>
                                        <th width="20%">Image</th>
                                        <th width="10%">Status</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($categories) == 0)
                                    <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                                        <span>No any categories here !</span>
                                    </div>
                                    @else
                                    @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <p>{{ Str::limit($category->name, 15, '...') }}</p>
                                        </td>
                                        <td>{{ Str::limit($category->slug, 15, '...') }}</td>
                                        <td><img class="w-100"
                                                src="{{ asset('uploads/categories') . '/' . $category->image  }}"
                                                alt="{{ $category->name }}"></td>
                                        <td>
                                            @if($category->status == 1)
                                            <span class="badge badge-success">Show</span>
                                            @else
                                            <span class="badge badge-secondary">Hide</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-info" href="categories/{{ $category->id }}/edit"
                                                role="button"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('categories.destroy', $category->id ) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Are you sure to take this action ?')"
                                                    class="btn btn-danger" type="submit">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="dataTables_info my-2">
                                <p>Showing {{ $categories->firstItem() }} to
                                    {{ $categories->lastItem() }} of
                                    {{$categories->total()}} entries</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="float-right">
                                {{ $categories->withQueryString()->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</main>

@endsection

@section('script-option')
<script src="{{ asset('assets/backend/js/slug.js') }}"></script>
@endsection
