@extends('admin.layouts.admin')

@section('title')
    Index Tags
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست ویژگی ها ({{ $attributes->total() }}) </h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.attributes.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد ویژگی
                </a>
            </div>
            <div class="">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>نام</td>
                            <td>عملیات</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $key => $attribute)
                            <tr>
                                <td>{{ $attributes->firstItem() + $key }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>
                                    <a class="btn btn-sm btn-success"
                                        href="{{ route('admin.attributes.show', ['attribute' => $attribute->id]) }}">نمایش</a>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('admin.attributes.edit', ['attribute' => $attribute->id]) }}">ویرایش</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{--                    {{ $brands->links() }} --}}
                </table>
            </div>
        </div>
    </div>
@endsection
