@extends('admin.layouts.admin')

@section('title')
    Index Brand
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست برند ها ({{ $brands->total() }}) </h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.brands.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد برند
                </a>
            </div>
            <div class="">
                <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>نام</td>
                                <td>وضعیت</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $brands->firstItem() + $key }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        <span class="{{ $brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                            {{ $brand->is_active }}
                                        </span>
                                    </td>
                                    <td><a class="btn btn-sm btn-success" href="{{ route('admin.brands.show' , ['brand' => $brand->id ]) }}">نمایش</a></td>
                                </tr>
                            @endforeach
                         </tbody>
{{--                    {{ $brands->links() }}--}}
                </table>
            </div>
        </div>
    </div>
@endsection
