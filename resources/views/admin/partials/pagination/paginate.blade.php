<div class="row mt-4 offset-md-5" v-if="dateSearch == '' && pagination" v-cloak> 
    <nav>
        <ul class="pagination">
            <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page -1)">
                    <span>Atrás</span>
                </a>
            </li>

            <li class="page-item" v-for="page in pagesNumber" :class="page == isActive ? 'active' : '' "v-if="pagination.total > 10">
                <a class="page-link" href="#" @click.prevent="changePage(page)">
                    <span>@{{ page }}</span>
                </a>
            </li>
            
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                    <span>Siguiente</span>
                    </a>
                </li>
        </ul>
    </nav>
   
</div>
<button class="btn d-inline btn-sm btn-warning float-right" v-if="dateSearch != ''" @click.prevent="cleanSearch">Volver</button>
    <button class="btn d-inline btn-sm btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#date">Buscar por fecha</button>
