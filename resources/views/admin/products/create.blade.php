@extends('admin.layouts.admin')

@section('title')
    Create Product
@endsection

@section('script')
    <script>
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });
        $('#brand_id').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#primary_image').change(function() {

            var filename = $(this).val();

            $(this).next('.custom-file-label').html(filename);
        });
        $('#images').change(function() {

            var filename = $(this).val();

            $(this).next('.custom-file-label').html(filename);
        });
        $('#CategorySelect').selectpicker({
            'title': 'انتخاب دسته بندی '
        });
        $('#attributeContainer').hide();
        $('#CategorySelect').change(function() {

            let attributesSelected = $(this).val();

            $.get(`{{ url('/admin-panel/management/category-attribute/${attributesSelected}') }}`, function(data,
                status) {
                if (status == "success") {

                    $('#attributeContainer').fadeIn();

                    $('#category-attribute').find('div').remove();

                    data.attributes.forEach((attribute) => {
                        console.log(attribute)
                        let attributeFormGroup = $('<div />' , {
                            class : 'form-group col-md-3' ,
                        }) ;
                        attributeFormGroup.append($('<label />' , {
                            for : attribute.name ,
                            text : attribute.name ,
                        }))

                        attributeFormGroup.append($('<input />' , {
                            type : 'text' ,
                            name : `attribute_ids[${attribute.id}]` ,
                            class : 'form-control' ,
                            id : attribute.name ,
                        }));

                        $('#category-attribute').append(attributeFormGroup) ;
                    })

                    $('#variation-name').text(data.variation.name);
                }
            });
        })
        $("#czContainer").czMore();
    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد محصول </h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select id="brand_id" name="brand_id" class="form-control" data-live-search="true">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
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
                    <div class="form-group col-md-3">
                        <label for="tagSelect">تگ</label>
                        <select id="tagSelect" name="tag_ids[]" class="form-control" multiple data-live-search="true">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                    </div>

                    {{--                    Product Image Section --}}

                    <div class="col-md-12">
                        <hr>
                        <p> تصاویر محصول </p>
                    </div>

                    <div class="form-group col-md-3">

                        <label for="product_image">انتخاب تصویر اصلی</label>
                        <div class="custom-file">
                            <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                            <label class="custom-file-label" for="primary_image">انتخاب فایل</label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">

                        <label for="product_image">انتخاب تصاویر</label>
                        <div class="custom-file">
                            <input type="file" name="images[]" id="images" multiple class="custom-file-input"
                                id="primary_image">
                            <label class="custom-file-label" for="images">انتخاب فایل ها</label>
                        </div>
                    </div>

                    {{--                    Product Category&Attribute Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p> دسته بندی و ویژگی محصول : </p>
                    </div>

                    <div class="form-group col-md-3 ">
                        <label for="CategorySelect">دسته بندی</label>
                        <select id="CategorySelect" name="category_id" class="form-control" data-live-search="true">
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} - {{ $category->parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id=attributeContainer class="form-group col-md-12" >
                        <div class="row" id="category-attribute">
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <p>وارد کردن مقدار برای متغییر <span id="variation-name"></span></p>
                        </div>
                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>مقدار </label>
                                        <input type="text" class="form-control" name="variation_value[value][]" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>قیمت </label>
                                        <input type="text" class="form-control" name="variation_value[price][]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>تعداد </label>
                                        <input type="text" class="form-control" name="variation_value[quantity][]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>sku</label>
                                        <input type="text" class="form-control" name="variation_value[sku][]">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--   Delivery Amount Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p> هزینه ارسال : </p>
                    </div>

                    <div class="form-group col-md-3 ">
                            <label for="deliveryAmount">هزینه ارسال</label>
                            <input type="text" id="deliveryAmount" class="form-control" name="deliveryAmount">
                    </div>
                    <div class="form-group col-md-3 ">
                            <label for="">هزینه ارسال به ازای محصول اضافی</label>
                            <input type="text" id="deliveryAmountPerAdditional" class="form-control" name="deliveryAmountPerAdditional">
                        </div>
                    </div>

                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>

            </form>
        </div>
    </div>
@endsection
