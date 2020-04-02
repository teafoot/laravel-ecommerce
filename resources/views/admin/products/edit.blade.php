@extends("admin.layouts.master")

@section("page")
    Edit Product
@endsection

@section("content")
    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include("admin.layouts.message")
            <div class="card">
                <div class="header">
                    <h4 class="title">Edit Product</h4>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::open(['route' => ['products.update', $product->id], 'method' => 'put', 'files' => true, 'id' => 'update_product_form']) }}
                                    @include('admin.products._fields')
                                    {{ Form::button('Update Product', ['type' => 'submit', 'class' => 'btn btn-info btn-fill btn-wd']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
