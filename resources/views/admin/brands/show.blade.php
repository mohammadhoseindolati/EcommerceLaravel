@extends('admin.layouts.admin')

@section('title')
    Show Brand
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
           <div class="mb-4">
               <h5 class="font-weight-bold">برند : {{ $brand->name }} </h5>
           </div>
            <hr>
                @include('admin.sections.errors')

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" value="{{ $brand->name }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">وضعیت</label>
                            <input type="text" class="form-control"  value="{{ $brand->is_active }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">تاریخ ایجاد</label>
                            <input type="text" class="form-control"  value="{{ verta($brand->created_at) }}" disabled>
                        </div>

                    </div>

                    <a href="{{ route('admin.brands.index') }}" class="btn btn-dark mt-5">بازگشت</a>
        </div>
    </div>
@endsection
