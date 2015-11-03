@extends('app')
@section('content')
    <div class="container">
        <h3>Clients</h3>

        <a href="{{route('admin.clients.create')}}" class="btn btn-default">Novo Cliente</a>
        <br><br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->user->name}}</td>
                        <td>
                            <a href="{{route('admin.clients.edit', ['id' => $client->id])}}" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>
@endsection