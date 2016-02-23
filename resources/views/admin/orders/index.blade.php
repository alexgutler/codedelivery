@extends('app')
@section('content')
    <div class="container">
        <h3>Pedidos</h3>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Data</th>
                    <th>Itens</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{$order->id}}</td>
                        <td>R$ {{$order->total}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <ul>
                                @foreach($order->items as $item)
                                    <li>{{$item->product->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($order->deliveryman)
                                {{$order->deliveryman->name}}
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            @if($order->status == 0)
                                Pendente
                            @elseif($order->status == 1)
                                A caminho
                            @elseif($order->status == 2)
                                Entregue
                            @else
                                Cancelado
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.orders.edit', ['id' => $order->id])}}" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
@endsection