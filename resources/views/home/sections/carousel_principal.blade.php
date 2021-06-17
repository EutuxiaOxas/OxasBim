<?php $contador = 1; ?>
    {{-- Carousel principal --}}
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $slider)
                    <div <?php if ($contador==1) { echo 'class="carousel-item active"' ; } else {
                        echo 'class="carousel-item"' ; } ?>>
                        <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100 img_banner_principal" alt="{{ $slider->title }}">
                        <div class="carousel_body">
                            <h2>{{ $slider->title }}</h2>
                            <p>{{ $slider->description }}</p>
                        </div>
                    </div>
                    <?php $contador++; ?>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
