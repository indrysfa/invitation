@extends('admin.layouts.app')
@section('title', 'Gallery Page')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @can('view', App\Gallery::class)
            @if ($gallery->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Perhatikan!</strong> Pastikan halaman ini sudah ada data, jika belum silahkan Add New!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif ($gallery)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Kamu bisa juga menambahkan gallery lebih banyak lagi, sesuaikan dengan kebutuhanmu..
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                {{ '' }}
            @endif
        @endcan

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('create', App\Gallery::class)
                    <a href="{{ route('admin.gallery.add') }}" class="nav-link">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"> Add
                                New</i></button>
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Picture</th>
                                <th>Caption Image</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($gallery as $d)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $d->m_slug->slug }}</td>
                                    <td><img src="{{ Storage::url('public/images/' . $d->picture) }}" alt="gallery"
                                            class="img-responsive" width="80"></td>
                                    <td>{{ $d->caption }}</td>
                                    <td>
                                        @can('update', App\Gallery::class)
                                            <button type="button" class="btn btn-warning btn-circle btn-sm" data-toggle="modal"
                                                data-target="#modal-edit{{ $d->id }}"><i class="fa fa-pen"
                                                    aria-hidden="true"></i></button>
                                        @endcan
                                        @can('delete', App\Gallery::class)
                                            <form action="{{ route('admin.gallery.delete', $d->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @foreach ($gallery as $item)
        {{-- Modal Edit --}}
        <div class="modal fade" id="modal-edit{{ $item->id }}" tabindex="-1" aria-labelledby="modal-editLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-editLabel">Edit Gallery Wedding</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ route('admin.gallery.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($role == 2)
                                <input type="text" class="form-control" name="slug_id"
                                    value="{{ old('slug_id', $item->slug_id) }}" hidden>
                            @else
                                <div class="form-group row">
                                    <label for="slug_id" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10 pt-2">
                                        <input type="text" class="form-control" name="slug_id"
                                            value="{{ old('slug_id', $item->slug_id) }}" hidden>
                                        <p>{{ $item->m_slug->slug }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="caption" class="col-sm-2 col-form-label">Caption</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="caption"
                                        value="{{ old('caption', $d->caption) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="picture" class="col-sm-2 col-form-label">Picture</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="picture"
                                        value="{{ old('picture', $d->picture) }}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@prepend('datatables')
    {{-- Datatables --}}
    <script src="{{ asset('admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [
                    [4, "desc"]
                ]
            });
        });
    </script>
@endprepend
