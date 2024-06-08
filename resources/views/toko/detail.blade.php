@extends('layouts.template')
@section('page-title')
Detail {{$data->nama_toko}}
@endsection

@section('content')
{{-- Area Detail Pemilik Toko --}}
<div class="row">
    <div class="col-md-12 col-sm-12">
        {{-- Show Data Card --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Details Toko
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
                            <th width='35%'>Name Store</th>
                            <td width="5%">:</td>
                            <td>{{$data->nama_toko}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Category Store</th>
                            <td width="5%">:</td>
                            <td>{{$data->kategori_toko}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Description Store</th>
                            <td width="5%">:</td>
                            <td>{{strip_tags($data->desc_toko)}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Owner Store</th>
                            <td width="5%">:</td>
                            <td>{{$data->user->name}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Day</th>
                            <td width="5%">:</td>
                            <td>{{$data->hari_buka}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Open</th>
                            <td width="5%">:</td>
                            <td>{{$data->jam_buka}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Closed</th>
                            <td width="5%">:</td>
                            <td>{{$data->jam_libur}}</td>
                        </tr>
                        <tr>
                            <th width='35%'>Status Store</th>
                            <td width='5%'>:</td>
                            <td>
                                @if ($data->status_aktif == FALSE){
                                <span class="badge badge-danger">Not Active</span>
                                }@else
                                <span class="badge badge-success text-center">Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th width='35%'>Icon Store</th>
                            <td width='5%'>:</td>
                            <td><img src="{{ asset('storage/images/toko/' . $data->icon_toko) }}"
                                    class="img-responsive " style="width: 100px;" /></td>
                            </td>
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
                <form class="p-4 md:p-5" action="{{ route('toko.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 form-group">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                                Name</label>
                            <input type="text" name="nama_toko" id="name" class="form-control"
                                placeholder="Enter store name" value="{{$data->nama_toko}}" required="">
                        </div>
                        <div class="col-span-2 form-group">
                            <label for="kategori"
                                class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                                Category</label>
                            <select name="kategori_toko" id="kategori" class="form-control" required="">
                                <option value="otomotif" {{ $data->kategori_toko == 'otomotif' ? 'selected' : '' }}>
                                    Otomotif</option>
                                <option value="elektronik" {{ $data->kategori_toko == 'elektronik' ? 'selected' : '' }}>
                                    Elektronik</option>
                                <option value="sembako" {{ $data->kategori_toko == 'sembako' ? 'selected' : '' }}>
                                    Sembako</option>
                                <option value="fashion" {{ $data->kategori_toko == 'fashion' ? 'selected' : '' }}>
                                    Fashion</option>
                                <option value="makanan" {{ $data->kategori_toko == 'makanan' ? 'selected' : '' }}>
                                    Makanan</option>
                                <option value="obat" {{ $data->kategori_toko == 'obat' ? 'selected' : '' }}>
                                    Obat</option>
                                <option value="aksesoris" {{ $data->kategori_toko == 'aksesoris' ? 'selected' : '' }}>
                                    Aksesoris</option>
                                <option value="perabotan" {{ $data->kategori_toko == 'perabotan' ? 'selected' : '' }}>
                                    Perabotan</option>
                            </select>
                        </div>
                        <div class="col-span-2 form-group">
                            <label for="desc" class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Store
                                Description</label>
                            <textarea name="desc_toko" id="summernote" rows="3" class="form-control"
                                placeholder="Enter store description"
                                required="">{{ old('desc_toko', $data->desc_toko) }}</textarea>
                        </div>
                        <div class="container mt-5">
                            <div class="col-span-2 form-group">
                                <label for="hari_buka"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Opening
                                    Days</label>
                                <div class="form-group flex flex-wrap gap-4">
                                    @php
                                    $hariBuka = $data->hari_buka ? explode(',', $data->hari_buka) : [];
                                    @endphp
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                            name="hari_buka[]" value="senin"
                                            {{ in_array('senin', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox1" class="custom-control-label">Senin</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2"
                                            name="hari_buka[]" value="selasa"
                                            {{ in_array('selasa', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox2" class="custom-control-label">Selasa</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox3"
                                            name="hari_buka[]" value="rabu"
                                            {{ in_array('rabu', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox3" class="custom-control-label">Rabu</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox4"
                                            name="hari_buka[]" value="kamis"
                                            {{ in_array('kamis', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox4" class="custom-control-label">Kamis</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                            id="customCheckbox5" name="hari_buka[]" value="jumat"
                                            {{ in_array('jumat', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox5" class="custom-control-label">Jumat</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                            id="customCheckbox6" name="hari_buka[]" value="sabtu"
                                            {{ in_array('sabtu', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox6" class="custom-control-label">Sabtu</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                            type="checkbox" id="customCheckbox7" name="hari_buka[]" value="minggu"
                                            {{ in_array('minggu', $hariBuka) ? 'checked' : '' }}>
                                        <label for="customCheckbox7" class="custom-control-label">Minggu</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 form-group">
                            <label for="jam_buka"
                                class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Opening
                                Hours</label>
                            <input type="time" name="jam_buka" id="jam_buka" class="form-control"
                                value="{{$data->jam_buka}}" required="">
                        </div>
                        <div class="col-span-2 form-group">
                            <label for="jam_libur"
                                class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">Closing
                                Hours</label>
                            <input type="time" name="jam_libur" id="jam_libur" class="form-control"
                                value="{{$data->jam_libur}}" required="">
                        </div>
                        <div class="col-span-2 form-group">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-200 dark:text-white">StoreStatus</label>
                            <select name="status_aktif" id="status" class="form-control" required>
                                <option value="0" {{ $data->status_aktif == '0' ? 'selected' : '' }}>Inactive</option>
                                <option value="1" {{ $data->status_aktif == '1' ? 'selected' : '' }}>Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="icon_toko" id="exampleInputFile" onchange="updateFileName(this)">
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
                       <a href="{{ route('toko.index') }}"><button type="button" class="btn btn-default" data-dismiss="modal">Back</button></a>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Update Store
                        </button>
                    </div>

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
