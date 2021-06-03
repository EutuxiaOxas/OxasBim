
    <div class="card shadow-md" style="border: 0px;" itemscope itemtype="https://schema.org/Product">
        <span class="card_product">
            <a href="{{route('producto.show', $o_product->slug)}}" itemprop="url">
                <img class="img_product" src="{{asset('storage/'. $o_product->image)}}" alt="{{$o_product->title}}" itemprop="image">
            </a>
        </span>
        <div class="card-body" style="padding: 0.6rem 0.8rem 0 0.8rem;">
            <div class="row px-3">
                <div class="col-12 px-0">
                    <a class="text_title_card_product" href="{{route('producto.show', $o_product->slug)}}" itemprop="url"> <span itemprop="name">{{$o_product->title}}</span> </a>
                </div>
                <div class="col-12 px-0 mb-2" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <span class="price_card_product" itemprop="price" content="{{$o_product->price}}"> <span itemprop="priceCurrency" content="USD">$</span> {{$o_product->price}}</span>
                    <span class="referencial_price_card_product pl-2">${{$o_product->price_reference}}</span>
                </div>
            </div>
            <input type="text" value="{{$o_product->slug}}" style="visibility: hidden; height:0; margin: 0; padding: 0;">
        </div>
    </div>
