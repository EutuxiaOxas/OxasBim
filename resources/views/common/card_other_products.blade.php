
    <div class="card" style="border: 0px;">
        <a class="card_product" href="{{route('producto.show', $o_product->slug)}}">
            <img class="img_product" src="{{asset('storage/'. $o_product->image)}}" alt="{{$o_product->title}}">
        </a>
        <div class="card-body" style="padding: 0.6rem 0.8rem 0 0.8rem;">
            <div class="row px-3">
                <div class="col-12 px-0">
                    <a class="text_title_card_product" href="{{route('producto.show', $o_product->slug)}}">{{$o_product->title}}</a>
                </div>
                <div class="col-12 px-0 mb-2">
                    <span class="price_card_product">${{$o_product->price}}</span>
                    <span class="referencial_price_card_product pl-2">${{$o_product->price_reference}}</span>
                </div>
            </div>
            <input type="text" value="{{$o_product->slug}}" style="visibility: hidden; height:0; margin: 0; padding: 0;">
        </div>
    </div>