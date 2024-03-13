@extends('layouts.client')
@section('title')
{{ $title }}
@endsection

@section('content')
<h1>Add Product</h1>
<form action="{{ route('post-add')}}" method="POST" id="product-form">
    <div class="alert alert-danger text-center msg" style="display: none;">
        {{$message}}
    </div>
    <div class="mb-3">
        <label for="">Name product: </label>
        <input type="text" class="form-control" name="product_name" placeholder="Product name...." value="{{old('product_name')}}">

        <span style="color: red;" class="error product_name_error"></span>
    </div>

    <div class="mb-3">
        <label for="">Price product: </label>
        <input type="text" class="form-control" name="product_price" placeholder="Product price...." value="{{old('product_price')}}">
        <span style="color: red;" class="error product_price_error"></span>
    </div>

    <button class="btn btn-primary" type="submit">Add</button>
    @csrf
</form>
@endsection

@section('css')

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('product-form').on('submit', function(e) {
            e.preventDefault();
            alert('OK')

            let productName = $('imput[name = "product_name"]').val().trim();
            let productPrice = $('imput[name = "product_price"]').val().trim();
            let actionUrl = $(this).attr('action')

            console.log(actionUrl)

            let csrfToken = $(this).find('input[name="_token"]').val();

            $('.error').text('');
            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: {
                    producproduct_nametName: productName,
                    product_price: productPrice,
                    _token: csrfToken

                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                },
                error: function(error) {
                    $('.msg').show();
                    let responseJSON = error.responseJSON.errors;
                    console.log(responseJSON);
                    if (Object.keys(responseJSON).lenghth > 0) {
                        $('.msg').text(responseJSON.msg);
                        for (let key in responseJSON) {
                            $('.' + key + "_error").text(responseJSON[key][0]);
                        }
                    }

                }
            })

        })
    })
</script>
@endsection