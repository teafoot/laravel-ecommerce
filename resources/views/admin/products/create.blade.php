@extends("admin.layouts.master")

@section("page")
    Add Product
@endsection

@section("content")
    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include("admin.layouts.message")
            <div class="card">
                <div class="header">
                    <h4 class="title">Add Product</h4>
                </div>
                <div class="content">
                    {{ Form::open(['route' => 'products.index', 'method' => 'post', 'files' => true]) }}
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.products._fields')
                                <div class="form-group">
                                    {{ Form::button('Add Product', ['type' => 'submit', 'class' => 'btn btn-info btn-fill btn-wd']) }}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
