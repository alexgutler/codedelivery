@extends('app')
@section('content')
    <div class="container">
        <h3>Editar categoria</h3>

        @include('errors._check')

        {!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'POST', 'class' => 'form']) !!}
            @include('admin.categories._form')
            <div class="form-group">
                {!! Form::submit('Alterar Categoria', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

    </div>
@endsection