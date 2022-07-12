<div class="card">

    <div id="carousel{{$product->id}}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach($product->images as $image)
                <div class="carousel-item {{$loop->first? 'active': ''}}">
                    <img class="d-block w-100 card-img-top" src="{{asset($image->path)}}" alt="{{$product->title}}"
                         style="max-height: 500px">
                </div>
            @endforeach
        </div>
        <a href="#carousel{{$product->id}}" class="carousel-control-prev" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a href="#carousel{{$product->id}}" class="carousel-control-next" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="card-body">
        <h4 class="text-right">
            <strong>
                $ {{$product->price}}
            </strong>
        </h4>
        <h5 class="card-title">
            {{$product->title}}
        </h5>
        <p class="card-text"> {{$product->description}} </p>
        <p class="card-text"><strong> {{$product->stock}} restantes</strong></p>
        @if(isset($cart))
            <p class="card-text"><strong> {{$product->pivot->quantity}} en el carrito </strong>$ ({{$product->total}})</p>
            <form class="d-inline" method="POST"
                  action="{{route('products.carts.destroy',
['cart'=> $cart->id, 'product' => $product->id]
)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Eliminar del carrito</button>

            </form>
        @else

            <form class="d-inline" method="POST"
                  action="{{route('products.carts.store', ['product' => $product->id])}}">
                @csrf
                <button type="submit" class="btn btn-success">Agregar al carrito</button>

            </form>
        @endif
    </div>
</div>


