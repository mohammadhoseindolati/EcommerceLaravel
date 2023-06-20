@extends('admin.layouts.admin')

@section('title')
    Index Brand
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست دسته بندی ها ({{ $categories->total() }}) </h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>
            <div class="">
                <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>نام</td>
                                <td>نام انگلیسی</td>
                                <td>والد</td>
                                <td>وضعیت</td>
                                <td>عملیات</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->parent_id == 0 )
                                            {{ "بدون والد" }}
                                        @else
                                            {{ $category->parent->name }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                            {{ $category->is_active }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.categories.show' , ['category' => $category->id ]) }}">نمایش</a>
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.categories.edit' , ['category' => $category->id ]) }}">ویرایش</a>
                                    </td>
                                </tr>
                            @endforeach
                         </tbody>
{{--                    {{ $brands->links() }}--}}
                </table>
            </div>
        </div>
    </div>
@endsection
