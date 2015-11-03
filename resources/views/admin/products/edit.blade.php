@extends('app')
@section('content')
    <div class="container">
        <h3>Editar produto</h3>

        @include('errors._check')

        {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'POST', 'class' => 'form']) !!}
            @include('admin.products._form')
            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
@endsection