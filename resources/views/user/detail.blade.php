@extends('layouts.template')
@section('page-title')
Detail {{$user->name}}
@endsection

@section('content')
{{-- Area Detail Pemilik Toko --}}
<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- Show Data Card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Details User
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">

                        <tr>
                            <th width='35%'>User Name (Owner Store)</th>
                            <td width="5%">:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Email</th>
                            <td width="5%">:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- card-edit --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('penjual.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control">
                            <option value="penjual" {{ $user->level == 'penjual' ? 'selected' : '' }}>Penjual</option>
                            <option value="customer" {{ $user->level == 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Sorry, Error!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
