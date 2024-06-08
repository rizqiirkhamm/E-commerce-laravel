@extends('layouts.template')
@section('page-title')
Toko
@endsection
@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Sorry, Error</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">This is store data</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
                            Add New Store
                        </button>
                    </div>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Category Store</th>
                            <th>Owner Store</th>
                            <th>Opening days</th>
                            <th>Opening Hours</th>
                            <th>Closing Hours</th>
                            <th>Status Store</th>
                            <th>Icon Store</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $item)
                        <tr>
                            <td>{{$item->nama_toko}}</td>
                            <td>{{$item->kategori_toko}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->hari_buka}}</td>
                            <td>{{$item->jam_buka}}</td>
                            <td>{{$item->jam_libur}}</td>
                            <td>
                                @if ($item->status_aktif == FALSE)
                                <span class="badge badge-danger">Not Active</span>
                                @else
                                <span class="badge badge-success text-center">Active</span>
                                @endif
                            </td>
                            <td><img src="{{ asset('storage/images/toko/' . $item->icon_toko) }}"
                                    class="img-responsive " style="width: 150px;" /></td>

                            <td>
                                <div class="margin">
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-default btn-flat dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="toko/{{$item->id}}">Detail</a>

                                            <form id="delete-form" action="{{ route('toko.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Store</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 form-group">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                            Name</label>
                        <input type="text" name="nama_toko" id="name" class="form-control"
                            placeholder="Enter store name" required="">
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="owner_name">Owner's Name</label>
                        <select name="id_user" id="owner_name" class="form-control">
                            @foreach ($user as $item )
                            @if ($item->level == 'penjual')
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                            Category</label>
                        <select name="kategori_toko" id="kategori" class="form-control" required="">
                            <option value="elektronik">Elektronik</option>
                            <option value="otomotif">Otomotif</option>
                            <option value="sembako">Sembako</option>
                            <option value="fashion">Fashion</option>
                            <option value="makanan">Makanan</option>
                            <option value="obat">Obat</option>
                            <option value="aksesoris">Aksesoris</option>
                            <option value="perabotan">Perabotan</option>
                        </select>
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="desc" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                            Description</label>
                        <textarea name="desc_toko" id="summernote" rows="3" class="form-control"
                            placeholder="Enter store description" required=""></textarea>
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="hari_buka"
                            class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Opening Days</label>
                        <div class="form-group flex flex-wrap gap-4">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                    name="hari_buka[]" value="senin">
                                <label for="customCheckbox1" class="custom-control-label">Senin</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox2"
                                    name="hari_buka[]" value="selasa">
                                <label for="customCheckbox2" class="custom-control-label">Selasa</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox3"
                                    name="hari_buka[]" value="rabu">
                                <label for="customCheckbox3" class="custom-control-label">Rabu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox4"
                                    name="hari_buka[]" value="kamis">
                                <label for="customCheckbox4" class="custom-control-label">Kamis</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="customCheckbox5" name="hari_buka[]" value="jumat">
                                <label for="customCheckbox5" class="custom-control-label">Jumat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="customCheckbox6" name="hari_buka[]" value="sabtu">
                                <label for="customCheckbox6" class="custom-control-label">Sabtu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input
                                    class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                    type="checkbox" id="customCheckbox7" name="hari_buka[]" value="minggu">
                                <label for="customCheckbox7" class="custom-control-label">Minggu</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="jam_buka"
                            class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Opening Hours</label>
                        <input type="time" name="jam_buka" id="jam_buka" class="form-control" required="">
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="jam_libur"
                            class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Closing Hours</label>
                        <input type="time" name="jam_libur" id="jam_libur" class="form-control" required="">
                    </div>
                    <div class="col-span-2 form-group">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                            Status</label>
                        <select name="status_aktif" id="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    {{-- <div class="col-span-2 form-group">
                        <label for="icon_toko"
                            class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store Icon</label>
                        <div class="custom-file">
                            <input type="file" name="icon_toko" class="custom-file-input" id="exampleInputFile"
                                required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="icon_toko" onchange="updateFileName(this)" required>
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <script>
                        function updateFileName(input) {
                            var fileName = input.files[0] ? input.files[0].name : 'Choose file';
                            var label = input.nextElementSibling;
                            label.innerText = fileName;
                        }

                    </script>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new Store
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection
