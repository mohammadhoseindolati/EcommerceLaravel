@extends('admin.layouts.admin')

@section('title')
    Create Brand
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
           <div class="mb-4">
               <h5 class="font-weight-bold">ایجاد برند </h5>
           </div>
            <hr>
                @include('admin.sections.errors')
                <form action="{{ route('admin.brands.store') }}" method="post">
                    @csrf
                    <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input type="text" class="form-control" name="name" id="name">
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
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>

                </form>
        </div>
    </div>
@endsection
