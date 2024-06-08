@extends('layouts.template')
@section('page-title')
Dashboard
@endsection
@section('content')
{{-- Content yang menampilkan sesuai dengan frame yang di template --}}


@if (Auth::user()->level === 'admin')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
@else
{{-- kondisi jika profile belum di isi --}}
@if(!$data_profile)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading"><i class="icon fas fa-exclamation-triangle"></i> Attention, {{ Auth::user()->name }}</h4>
    <p>Your profile is incomplete. Please complete it now for a better experience.</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
        Create New Users
      </button>
    <hr>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="alert-icon">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div class="alert-content">
        <h5 class="alert-heading">Oops! Invalid Input</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
{{-- Modal untuk Profile --}}

<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lengkapi Data Diri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="p-4 md:p-5 bg-gray-800 rounded-lg shadow-md" action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <h5 class="text-xl font-medium text-gray-200">lengkapkan data diri</h5>
                    <p class="text-gray-400">Please provide your personal information.</p>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="form-group">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-200">Phone Number</label>
                        <input type="tel" name="nomor_hp" id="phone" class="form-control " placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-200">Date of Birth</label>
                        <input type="date" name="tgl_lahir" id="birthdate" class="form-control" required>
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-200">Gender</label>
                        <select name="jenis_kelamin" id="gender" class="form-control" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="laki-laki">Male</option>
                            <option value="perempuan">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-200">Address</label>
                        <textarea name="alamat" id="address" rows="3" class="form-control" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="form-group custom-file">
                        <label for="profile_icon" class="custom-file-label block mb-2 text-smfont-medium text-gray-200">Choose file</label>
                        <input type="file" name="icon_profile" id="profile_icon" accept="image/*" class="form-control custom-file-input" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>

            <div class="modal-body">

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!--
        @/.modal-dialog -->
</div>
@else
{{-- Alert for successful profile completion --}}
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading"><i class="icon fas fa-check-circle"></i> Profile Completed!</h4>
    <p>Thank you, {{ Auth::user()->name }} for completing your profile.</p>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Welcome, {{ Auth::user()->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-4">Account Information</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @foreach ($data_profile as $profile)
                                <tr>
                                    <th width="30%">Name</th>
                                    <td width="5%">:</td>
                                    <td>{{ $profile->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $profile->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>:</td>
                                    <td>{{ $profile->user->level }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-4">Personal Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @foreach ($data_profile as $item)
                                <tr>
                                    <th width="30%">Phone Number</th>
                                    <td width="5%">:</td>
                                    <td>{{ $item->nomor_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>:</td>
                                    <td>{{ $item->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>:</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endif
@endif

@endsection
