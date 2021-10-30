@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 card p-3">
            <h4 class="text-dark">Your cart</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->associatedModel->image) }}"
                                     alt="{{ $item->title }}"
                                     width="50"
                                     height="50"
                                     class="img-fluid rounded"
                                >
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                <form class="d-flex flex-row justify-content-center align-items-center" action="{{ route("update.cart",$item->associatedModel->slug) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <input type="number" name="qty" id="qty"
                                            value="{{ $item->quantity }}"
                                            placeholder="Quantité"
                                            max="{{ $item->associatedModel->inStock }}"
                                            min="1"
                                            class="form-control"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                {{ $item->price }} $
                            </td>
                            <td>
                                {{ $item->price * $item->quantity}} $
                            </td>
                            <td>
                                <form class="d-flex flex-row justify-content-center align-items-center" action="{{ route("remove.cart",$item->associatedModel->slug) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-dark font-weight-bold">
                        <td colspan="3" class="border border-success">
                            Total
                        </td>
                        <td colspan="3" class="border border-success">
                            {{ Cart::getSubtotal() }} $
                        </td>
                    </tr>
                </tbody>
            </table>
            @if(Cart::getSubtotal() > 0)
                <div class="form-group">
                    <a href="{{ route("make.payment") }}" class="btn btn-primary mt-3">
                        Pay {{ Cart::getSubtotal() }} $ via PayPal
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
