@extends('admin.layouts.admin')

@section('title')
    Create Category
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد دسته بندی </h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="slug"> نام انگلیسی</label>
                        <input type="text" class="form-control" name="slug" id="slug">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="parent_id">والد</label>
                        <select class="form-control" name="" id="parent_id">
                            <option value="0" selected>بدون والد</option>
                            @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>

            </form>
        </div>
    </div>
@endsection
