<div class="container d-md-none">
    <div class="row align-items-center" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
        <span class="col-auto" style="font-family: Rubik;font-size:1.25rem;">
            Categorias
        </span>
        <svg class="col-auto ml-auto" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 4H4v7l9 9.01L20 13l-9-9zM6.5 8C5.67 8 5 7.33 5 6.5S5.67 5 6.5 5 8 5.67 8 6.5 7.33 8 6.5 8z" opacity=".3"/><path d="M12.41 2.58C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58s1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41s-.23-1.06-.59-1.42l-9-9zM13 20.01L4 11V4h7v-.01l9 9-7 7.02z"/><circle cx="6.5" cy="6.5" r="1.5"/></svg>
    </div>
    <div class="row px-4 mt-2">
        <div class="collapse" id="collapseCategories">
            @foreach($categorias as $categoria)
                @if($categoria->padre_id == 0)
                    <div class="categories_card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a class="text-rubik" href="{{route('product.category.show', $categoria->slug)}}">{{$categoria->title}}</a>
                            </div>
                            <div class="col-auto ml-auto">
                                <svg class="span-circle arrow_class" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 25 25" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </div>
                        </div>
                        <ul class="acordeon_container">
                            @foreach($categorias as $cat_hijo)
                                @if($cat_hijo->padre_id == $categoria->id)
                                    <li class="sub_categorie_item">
                                        <a class="text-rubik" href="{{route('product.category.show', $cat_hijo->slug)}}">{{$cat_hijo->title}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <hr>
</div>

<div class="d-none d-md-block col-md-2 px-2" id="categories_container" style="position:relative;">
    <h5 class="my-4 text-rubik">Categorias</h5>
    @foreach($categorias as $categoria)
        @if($categoria->padre_id == 0)
            <div class="categories_card">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a class="text-rubik" href="{{route('product.category.show', $categoria->slug)}}">
                            {{$categoria->title}}
                            <small class="ml-1">({{$categoria->products->count() ? $categoria->products->count() : ''}})</small>
                        </a>
                    </div>
                    <div class="col-auto ml-auto">
                        <svg class="span-circle arrow_class" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 25 25" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                </div>
                <ul class="acordeon_container">
                    @foreach($categorias as $cat_hijo)
                        @if($cat_hijo->padre_id == $categoria->id)
                            <li class="sub_categorie_item">
                                <a class="text-rubik" href="{{route('product.category.show', $cat_hijo->slug)}}">
                                    {{$cat_hijo->title}}
                                    <small>({{$cat_hijo->products->count() ? $cat_hijo->products->count() : ''}})</small>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    @endforeach
</div>

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', () => {
        const categorieCards = document.querySelectorAll('.categories_card')

        if(categorieCards){
            categorieCards.forEach(card => {
                let arrow = card.children[0].children[1];

                if(card.children[1].children.length === 0){
                    arrow.style.display  = 'none'
                }
            })
        }
    })

	function openCloseSubCategories(container, arrow){
		container.classList.toggle('active')
		arrow.classList.toggle('active')
	}

	const categoryContainer = document.getElementById('categories_container')

	categoryContainer.addEventListener('click', e => {
		if(e.target.classList.contains('arrow_class')){
			let subCategoriesContainer = e.target.parentNode.parentNode.parentNode.children[1]
			openCloseSubCategories(subCategoriesContainer, e.target)
		}
	})

</script>
