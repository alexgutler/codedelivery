@extends('app')
@section('content')
    <div class="container">
        <h3>Novo pedido</h3>
        @include('errors._check')

        {!! Form::open(['class' => 'form', 'route' => 'customer.order.store']) !!}
            <div class="form-group">
                <label>Total:</label>
                <p id="total"></p>
                <a href="#" id="btnNewItem" class="btn btn-default">Novo item</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="items[0][product_id]">
                                    @foreach($products as $p)
                                        <option value="{{$p->id}}" data-price="{{$p->price}}">{{$p->name}} --- {{$p->price}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                {!! Form::text('items[0][qtd]', 1, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                {!! Form::submit('Finalizar pedido', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('post-script')
    <script>
        $('#btnNewItem').click(function(){
            var row = $('table tbody > tr:last'),
                    newRow = row.clone(),
                    length = $('table tbody > tr').length;

            newRow.find('td').each(function(){
                var td = $(this),
                        input = td.find('input,select'),
                        name = input.attr('name');

                // seta o atributo name da seguinte forma:
                // items[0][product_id] - onde o '0' é procurado atraves do ((length - 1) + "")
                // e substitui por items[1][product_id] onde o '1' é o (length + "") atual
                input.attr('name', name.replace((length - 1) + "", length + "") );
            });

            newRow.find('input').val(1);
            newRow.insertAfter(row);
            calculateTotal();
        });

        $(document.body).on('click','select', function(){
            calculateTotal();
        });

        $(document.body).on('blur','input', function(){
           calculateTotal();
        });

        function calculateTotal(){
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, price, qtd;

            for(var i = 0; i < trLen; i++){
                tr = $('table tbody tr').eq(i);
                price  = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }

            $('#total').html(total);
        }
    </script>
@endsection