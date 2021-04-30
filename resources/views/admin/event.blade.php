@extends('admin.layouts.app')
@section('title', 'Wedding User Page')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Wedding User Page</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.event.add') }}" class="nav-link">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"> Add New
                            Event</i></button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date Event</th>
                                <th>Name Man</th>
                                <th>Name Woman</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('F j, Y, g:i a', strtotime($d->created_at)) }}</td>
                                    <td>{{ $d->user_man }}</td>
                                    <td>{{ $d->user_women }}</td>
                                    <td>{{ $d->address }}</td>
                                    <td>{{ $d->city }}</td>

                                    <td>
                                        @if ($d->status == 1)
                                            {{ 'Aktif' }}
                                        @else
                                            {{ 'Nonaktif' }}
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal"
                                            data-target="#modal-detail{{ $d->id }}"><i class="fa fa-eye"
                                                aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-warning btn-circle btn-sm" data-toggle="modal"
                                            data-target="#modal-edit{{ $d->id }}"><i class="fa fa-pen"
                                                aria-hidden="true"></i></button>
                                        <form action="{{ route('admin.event.delete', $d->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
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

    {{-- Modal Detail --}}
    <div class="modal fade col-12" id="modal-detail{{ $d->id }}" tabindex="-1" aria-labelledby="modal-detailLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-detailLabel">Detail Event Wedding</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                {{ $d->title }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_wedding" class="col-sm-2 col-form-label">Date Wedding</label>
                            <div class="col-sm-10">
                                {{ date('F j, Y', strtotime($d->date_wedding)) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                                {{ $d->city }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="caption" class="col-sm-4 col-form-label">Caption</label>
                            <div class="col-sm-8">
                                {{ $d->caption }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="user_man">Name Man</label>
                                {{ $d->user_man }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_women">Name Woman</label>
                                {{ $d->user_women }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="pic_man">Picture Man</label>
                                <img style="width: 90px" src="{{ Storage::url('public/images/' . $d->pic_man) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pic_women">Picture Woman</label>
                                <img style="width: 90px" src="{{ Storage::url('public/images/' . $d->pic_women) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="caption_man">Caption Man</label>
                                {{ $d->caption_man }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="caption_women">Caption Woman</label>
                                {{ $d->caption_women }}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="ceremony_date">Ceremony Date</label>
                                {{ $d->ceremony_date }}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ceremony_time_start">Start Ceremony Time</label>
                                {{ $d->ceremony_time_start }}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ceremony_time_end">End Ceremony Time</label>
                                {{ $d->ceremony_time_end }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ceremony_caption" class="col-sm-4 col-form-label">Ceremony Caption</label>
                            <div class="col-sm-8">
                                {{ $d->ceremony_caption }}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="party_date">Party Date</label>
                                {{ $d->party_date }}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="party_time_start">Start Party Time</label>
                                {{ $d->party_time_start }}
                            </div>
                            <div class="form-group col-md-4">
                                <label for="party_time_end">End Party Time</label>
                                {{ $d->party_time_end }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="party_caption" class="col-sm-4 col-form-label">Party Caption</label>
                            <div class="col-sm-8">
                                {{ $d->party_caption }}
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit{{ $d->id }}" tabindex="-1" aria-labelledby="modal-editLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Event Wedding</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{ route('admin.event.update', $d->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $d->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_wedding" class="col-sm-2 col-form-label">Date Wedding</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date_wedding"
                                    value="{{ old('date_wedding', $d->date_wedding) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control"
                                    name="address">{{ old('address', $d->address) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="city" value="{{ old('city', $d->city) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="caption" class="col-sm-4 col-form-label">Caption</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control"
                                    name="caption">{{ old('caption', $d->caption) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="user_man">Name Man</label>
                                <input type="text" class="form-control" name="user_man"
                                    value="{{ old('user_man', $d->user_man) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_women">Name Woman</label>
                                <input type="text" class="form-control" name="user_women"
                                    value="{{ old('user_women', $d->user_women) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="pic_man">Picture Man</label>
                                <input type="file" class="form-control @error('pic_man') is-invalid @enderror"
                                    name="pic_man" value="{{ old('pic_man', $d->pic_man) }}">
                                <img style="width: 90px" src="{{ Storage::url('public/images/' . $d->pic_man) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pic_women">Picture Woman</label>
                                <input type="file" class="form-control @error('pic_women') is-invalid @enderror"
                                    name="pic_women" value="{{ old('pic_women', $d->pic_women) }}">
                                <img style="width: 90px" src="{{ Storage::url('public/images/' . $d->pic_women) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="caption_man">Caption Man</label>
                                <textarea type="text" class="form-control"
                                    name="caption_man">{{ old('caption_man', $d->caption_man) }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="caption_women">Caption Woman</label>
                                <textarea type="text" class="form-control"
                                    name="caption_women">{{ old('caption_women', $d->caption_women) }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="ceremony_date">Ceremony Date</label>
                                <input type="date" class="form-control" name="ceremony_date"
                                    value="{{ old('ceremony_date', $d->ceremony_date) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ceremony_time_start">Start Ceremony Time</label>
                                <input type="time" class="form-control" name="ceremony_time_start"
                                    value="{{ old('ceremony_time_start', $d->ceremony_time_start) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ceremony_time_end">End Ceremony Time</label>
                                <input type="time" class="form-control" name="ceremony_time_end"
                                    value="{{ old('ceremony_time_end', $d->ceremony_time_end) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ceremony_caption" class="col-sm-4 col-form-label">Ceremony Caption</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control"
                                    name="ceremony_caption">{{ old('ceremony_caption', $d->ceremony_caption) }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="party_date">Party Date</label>
                                <input type="date" class="form-control" name="party_date"
                                    value="{{ old('party_date', $d->party_date) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="party_time_start">Start Party Time</label>
                                <input type="time" class="form-control" name="party_time_start"
                                    value="{{ old('party_time_start', $d->party_time_start) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="party_time_end">End Party Time</label>
                                <input type="time" class="form-control" name="party_time_end"
                                    value="{{ old('party_time_end', $d->party_time_end) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="party_caption" class="col-sm-4 col-form-label">Party Caption</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control"
                                    name="party_caption">{{ old('party_caption', $d->party_caption) }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection