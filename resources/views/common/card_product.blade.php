<style>
    .text-rubik{
        font-family: 'Rubik', sans-serif;
        font-weight: 300;
    }
    .card:hover{
        box-shadow: 0 0.3rem 1.525rem -0.375rem rgba(0,0,0,0.1);
    }
    .card_product{
        display: flex;
        flex-direction:row;
	    justify-content: center;
	    align-items: center;
        max-height: 40vh;
        min-height: 40vh;
        max-width:100%;

        border-radius: 5px 5px 0 0;
        overflow: hidden;
    }
    .img_product{
        max-height: 40vh;
        min-height: auto;
        min-width: auto;
        max-width: 100%;   
    }
    .text_categorie_card{
        font-size: 0.8rem;
        font-family: 'Rubik', sans-serif;
        font-weight: 400;
        margin-bottom: 0.2rem;
        color:#7d879c;
    }
    .text_categorie_card:hover{
        text-decoration: none;
        color: #4b566b;
        transition: color 0.5s;
    }
    .text_title_card_product{
        font-size: 1rem;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
        color: #373f50;
        text-decoration: none;
    }
    .text_title_card_product:hover{
        text-decoration: none;
        color: #0068cb;
        transition: color 0.5s;
    }
    .price_card_product{
        margin:0.25rem 0;
        font-size: 1.2rem;
        font-family: 'Rubik', sans-serif;
        font-weight: 400;
        color: #4e54c8 ;
    }
    .referencial_price_card_product{
        color:#7d879c;
        font-size: 1rem;
        font-family: 'Rubik', sans-serif;
        font-weight: 400;
        text-decoration: line-through;
    }
    .btn-secondary-product{
        /*cambiar para otro modelo*/
        background-color: #009a6b!important;
		border-radius: 3px;
		width: 100%;
        color:#fff;
    }
    .btn-secondary-product:hover{
        color:#fff;
    }
    .btn-outline-primary-product{
        background-color: #dadada!important;
		border-radius: 3px;
		width: 100%;
    }
    
</style>
<div class="col-12 col-sm-6 col-md-6 col-lg-4 px-2 mb-4 pb-0">
    <div class="card" style="border: 0px;">
        <div class="card_product">
            <a href="{{route('producto.show', $producto->slug)}}" itemprop="url">
                <img class="img_product" src="{{asset('storage/'. $producto->image)}}" alt="{{$producto->title}}" itemprop="image">
            </a>
        </div>        
        <div class="card-body" style="padding: 0.6rem 0.8rem 0 0.8rem;">
            <div class="row px-3">
                <div class="col-12 px-0 mt-0 pt-0">
                    <a class="text_categorie_card" href="{{route('product.category.show', $producto->category->slug)}}" > <span itemprop="category">{{$producto->category->title}}</span> </a>
                </div>
                <div class="col-12 px-0">
                    <a class="text_title_card_product" href="{{route('producto.show', $producto->slug)}}" itemprop="url"> <span itemprop="name">{{$producto->title}}</span> </a>
                </div>
                <div class="col-12 px-0 mb-2" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <span class="price_card_product"><span itemprop="priceCurrency" content="USD">$</span> <span itemprop="price" content="{{number_format($producto->price, 2)}}">{{number_format($producto->price, 2)}}</span> </span>
                    <span class="referencial_price_card_product pl-2">${{number_format($producto->price_reference, 2)}}</span>
                </div>
            </div>            
            <div class="row px-3">
                @if($producto->quantity >= 10)
                    <select class="form-control mb-1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                @else
                    @php $contador = 1 @endphp
                    <select class="form-control mb-1">
                        @while($contador <= $producto->quantity)
                            <option value="{{$contador}}">{{$contador}}</option>
                            @php $contador += 1 @endphp
                        @endwhile
                    </select>
                @endif

                @if($producto->quantity > 0)
                    @if(auth()->user())
                        <button id="{{$producto->id}}" class="col-12 btn btn-secondary-product text-rubik to_server">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" width="16px" height="16px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                             Agregar al carrito
                            </button>
                    @else
                        <button id="{{$producto->id}}" class="col-12 btn btn-secondary-product text-rubik to_storage">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fff" width="16px" height="16px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                            Agregar al carrito
                        </button>
                    @endif
                @else
                    <button class="col-12 btn btn-secondary text-rubik">Agotado</button>
                @endif
            </div>
            <div class="row px-3 mt-1">
                <a href="{{route('producto.show', $producto->slug)}}" class="col-12 btn btn-outline-primary-product text-rubik" itemprop="image">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#222" width="16px" height="16px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6.5c3.79 0 7.17 2.13 8.82 5.5-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12C4.83 8.63 8.21 6.5 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5 4.5-2.02 4.5-4.5-2.02-4.5-4.5-4.5z"/></svg>
                    Ver producto
                </a>
            </div>
            <input type="text" value="{{$producto->slug}}" style="visibility: hidden; height:0; margin: 0; padding: 0;">
        </div>
    </div>
  </div>