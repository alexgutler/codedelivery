@extends('app')
@section('content')
    <div class="container">
        <h3>Editar cliente</h3>
        @include('errors._check')
        {!! Form::model($client, ['route' => ['admin.clients.update', $client->id], 'method' => 'POST', 'class' => 'form']) !!}
            @include('admin.clients._form')
            <div class="form-group">
                {!! Form::submit('Alterar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection