<div class="form-group">
    <h4 class="card-title">Detalles de compra</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio $</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchaseDetails as $detail)
                    <tr class="selected" id="fila{{$detail->product_id}}">
                        <td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td>
                        <td><input type="hidden" name="product_id[]" value="{{$detail->product_id}}">{{ $detail->product->name }}</td>
                        <td><input type="hidden" id="price[]" name="price[]" value="{{ $detail->price }}"> <input class="form-control" type="text" id="price[]" value="{{ $detail->price }}" disabled> </td> </td>
                        <td><input type="hidden" name="cantidad[]" value="{{ $detail->cantidad }}"> <input class="form-control" type="number" value="{{ $detail->cantidad }}" disabled> </td>
                        <td align="right">$ {{ $subtotal}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ {{ $purchase->total }}</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO (12%):</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ {{ $purchase->total * $purchase->impuesto /100}}</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right">
                            <span align="right" id="total_pagar_html">$ {{ $purchase->total }}</span>
                            <input type="hidden" name="total" id="total_pagar">
                        </p>
                    </th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>