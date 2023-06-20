@extends('admin.layouts.admin')

@section('title')
    Show Brand
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
           <div class="mb-4">
               <h5 class="font-weight-bold">دسته بندی  : {{ $category->name }} </h5>
           </div>
            <hr>
                @include('admin.sections.errors')

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="name">نام</label>
                            <input type="text" class="form-control" value="{{ $category->name }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">نام انگلیسی</label>
                            <input type="text" class="form-control" value="{{ $category->slug }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">والد</label>
                            <div class="form-control div-disable" >
                                @if($category->parent_id == 0 )
                                    {{ "" }}
                                @else
                                    {{ $category->parent->name }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">وضعیت</label>
                            <input type="text" class="form-control"  value="{{ $category->is_active }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">آیکون</label>
                            <input type="text" class="form-control"  value="{{ $category->icon }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name">تاریخ ایجاد</label>
                            <input type="text" class="form-control"  value="{{ verta($category->created_at) }}" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">توضیحات</label>
                            <textarea type="text" class="form-control" disabled>{{ $category->description }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <hr>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">ویژگی</label>
                                    <div class="form-control div-disable" >
                                        @foreach($category->attributes as $attribute)
                                            {{ $attribute->name }} {{ $loop->last ? '' : ',' }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">ویژگی های قابل فیلتر</label>
                                    <div class="form-control div-disable" >
                                        @foreach($category->attributes()->wherePivot('is_filter', 1)->get() as $attribute)
                                            {{ $attribute->name }} {{ $loop->last ? '' : ',' }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">متغییر</label>
                                    <div class="form-control div-disable" >
                                        @foreach($category->attributes()->wherePivot('is_variation', 1)->get() as $attribute)
                                            {{ $attribute->name }} {{ $loop->last ? '' : ',' }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5">بازگشت</a>
        </div>
    </div>
@endsection
