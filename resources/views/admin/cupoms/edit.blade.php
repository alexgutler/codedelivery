@extends('app')
@section('content')
    <div class="container">
        <h3>Editar cupom</h3>

        @include('errors._check')

        {!! Form::model($cupom, ['route' => ['admin.cupoms.update', $cupom->id], 'method' => 'POST', 'class' => 'form']) !!}
            @include('admin.cupoms._form')
            <div class="form-group">
                {!! Form::submit('Alterar cupom', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
@endsection