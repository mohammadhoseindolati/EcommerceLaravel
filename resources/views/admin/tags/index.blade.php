@extends('admin.layouts.admin')

@section('title')
    Index Tags
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4 d-flex justify-content-between">
                <h5 class="font-weight-bold"> لیست تگ ها ({{ $tags->total() }}) </h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.attributes.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد تگ
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
                        @foreach ($tags as $key => $tag)
                            <tr>
                                <td>{{ $tags->firstItem() + $key }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a class="btn btn-sm btn-success"
                                        href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}">نمایش</a>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}">ویرایش</a>
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
