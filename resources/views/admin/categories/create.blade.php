@extends('admin.layouts.admin')

@section('title')
    Create Category
@endsection

@section('script')
    <script>
        $('#attributVariationSelect').selectpicker({
            'title': 'انتخاب متغییر'
        });

        $('#attributSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributSelect').on('changed.bs.select', function() {

            let attributesSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected, function(i, element) {
                    if (attribute.id == element) {
                        attributeForFilter.push(attribute)
                    }
                })
            });
            $("#attributeIsFilterSelect").find('option').remove();
            $("#attributVariationSelect").find('option').remove();
            attributeForFilter.forEach((element) => {
                let attributeForFilterOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });

                let attributeForVariationOption = $("<option/>", {
                    value: element.id,
                    text: element.name
                });

                $("#attributeIsFilterSelect").append(attributeForFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#attributVariationSelect").append(attributeForVariationOption);
                $("#attributVariationSelect").selectpicker('refresh');
            });
        });

        $('#attributeIsFilterSelect').selectpicker({
            'title': 'انتخاب فیلتر'
        });
    </script>
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

                    <div class="form-group col-md-3">
                        <label for="attributSelect">ویژگی</label>
                        <select id="attributSelect" name="attribute_ids[]" class="form-control" multiple
                            data-live-search="true">
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}"> {{ $attribute->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="attributeIsFilterSelect">انتخاب ویژگی های قابل فیلتر </label>
                        <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]" class="form-control" multiple
                            data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="attributVariationSelect">انتخاب ویژگی متغیر</label>
                        <select id="attributVariationSelect" name="variation_id" class="form-control"
                            data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="icon">آیکون</label>
                        <input type="text" class="form-control" name="icon" id="icon">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea  class="form-control" name="description" id="description"></textarea>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>

            </form>
        </div>
    </div>
@endsection
