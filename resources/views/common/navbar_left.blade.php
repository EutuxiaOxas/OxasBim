<div class="col-12 col-md-2 px-2" id="categories_container" style="position:relative;">
    <h5 class="my-4 text-rubik">Categorias</h5>
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