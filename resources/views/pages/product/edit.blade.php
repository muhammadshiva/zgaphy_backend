@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Product</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Text</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.update', $product)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name"
                                    type="text"
                                    class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                    name="name" value="{{$product->name}}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input id="description"
                                    type="text"
                                    class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                    name="description" value="{{$product->description}}">
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input id="price"
                                        type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{$product->price}}">
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group" style="margin-top: 20px">
                                <label>Category</label>
                                <select id="category"
                                    class="form-control selectric @error('category') is-invalid @enderror"
                                    name="category">
                                    <option value="motobike" {{ old('category', $product->category) == 'motobike' ? 'selected' : '' }}>Clean Motobike</option>
                                    <option value="helmet" {{ old('category', $product->category) == 'helmet' ? 'selected' : '' }}>Clean Helmet</option>
                                    <option value="apparel" {{ old('category', $product->category) == 'apparel' ? 'selected' : '' }}>Clean Apparels</option>
                                    <option value="fnb" {{ old('category', $product->category) == 'fnb' ? 'selected' : '' }}>Food and Beverages</option>
                                    <option value="additional" {{ old('category', $product->category) == 'additional' ? 'selected' : '' }}>Additional</option>
                                </select>
                                @error('category')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Photo Product</label>
                                @if ($product->images)
                                        <img src="{{ asset($product->images) }}" width="100px" alt="Product Image" class="img-thumbnail">
                                    @else
                                    <span class="badge badge-danger">No Image</span>
                                @endif

                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="images" @error('images') is-invalid @enderror>
                                </div>

                                @error('images')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{-- Function --}}
    <script>
        $(document).ready(function(){
            $('.selectric').selectric();
        });
    </script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
