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
                                        placeholder="Enter room name ..." value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="status" class="form-control">
                                    <option>Choose status</option>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block my-0" style="line-height: 35px">DataTable Rooms</h5>
                        <a href="{{ route('rooms.trash') }}" class="btn btn-outline-danger float-right"><i
                                class="fa fa-trash m-1"></i>Trash</a>
                        <a href="{{ route('rooms.create') }}" class="btn btn-outline-success float-right mx-3"><i
                                class="fas fa-plus mr-2"></i>Add New</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @includeIf('backend.layouts.alert')
                                @if(count($rooms) == 0)
                                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>No any rooms here !</span>
                                </div>
                                @else
                                {{-- Show All Rooms --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Information</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rooms as $room)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>
                                                <p>
                                                    <a class="text-dark" href="{{ route('rooms.show', $room->id) }}">
                                                        <strong>Name</strong>: {{ $room->name }}
                                                    </a>
                                                </p>
                                                <p><strong>Category</strong>: {{ $room->category->name }}</p>
                                                <p><strong>Bed</strong>: {{ $room->bed}}</p>
                                                <p><strong>Bath</strong>: {{ $room->bath}}</p>
                                                <p><strong>Area</strong>: {{ $room->area }}</p>
                                            </td>
                                            <td><img width="150px"
                                                    src="{{ asset("uploads/rooms/room_avatar/$room->image") }}"
                                                    alt="{{ $room->name }}">
                                            </td>
                                            <td>
                                                @if ($room->sale_price > 0)
                                                <p class="text-decoration-line-through">
                                                    <del>{{ number_format($room->price, 2, ',') }}$</del>
                                                </p>
                                                <p>{{ number_format($room->sale_price, 2, ',') }}$</p>
                                                @else
                                                <p>{{ number_format($room->price, 2, ',') }}$</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($room->status == 1)
                                                <span class="badge badge-success">Show</span>
                                                @else
                                                <span class="badge badge-secondary">Hide</span>
                                                @endif
                                            </td>
                                            <td width="15%">
                                                <a class="btn btn-info m-1" href="{{ route('rooms.edit', $room->id) }}"
                                                    role="button"><i class="fas fa-pen"></i></a>
                                                <form class="d-inline-block"
                                                    action="{{ route('rooms.destroy', $room->id ) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure to take this action?')"
                                                        class="btn btn-danger m-1" type="submit"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info my-2">
                                            <p>Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of
                                                {{$rooms->total()}} entries</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="float-right">
                                            {{ $rooms->withQueryString()->links() }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</main>

@endsection
