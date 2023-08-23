<template>
    <div class="col-lg-3">
        <div class="filters shadow-sm rounded bg-white mb-4">
            <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
            <h5 class="m-0">{{ $t('service.filterBy') }}</h5>
            </div>

        <div class="filters-body">
        <div id="accordion">
            
            <div class="filters-card border-bottom p-4" v-if="!$route.query.id">
                <div class="filters-card-header" id="headingTwo">
                    <h6 class="mb-0">
                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                    {{ $t('service.categories') }} <i class="mdi mdi-chevron-down float-right" @click.prevent="loadCategories"></i>
                    </a>
                    </h6>
                </div>
                <div id="collapsetwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="filters-card-body card-shop-filters">
                    <div class="custom-control custom-radio" 
                        v-for="category in $store.getters.getCategories" :key="category.id"
                        >
                        <input type="radio" class="custom-control-input" name="customRadio" :id="category.id" 
                            @change="handleCategoriesFilter(category.slug)"
                            :checked="category.slug===$route.params.slug"
                            >
                        <label class="custom-control-label" :for="category.id">{{ category.title }} </label>
                    </div>
                    </div>
                </div>
            </div>
            <div class="filters-card border-bottom p-4">
                <div class="filters-card-header" id="headingCategory">
                    <h6 class="mb-0">
                    <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
                    {{ $t('service.budget') }} <i class="mdi mdi-chevron-down float-right"></i>
                    </a>
                    </h6>
                </div>
                <div id="collapseCategory" class="collapse" :class="{show: $route.query.id}" aria-labelledby="headingCategory" data-parent="#accordion">
                    <div class="filters-card-body card-shop-filters">
                        <div class="custom-control custom-radio" v-for="(budget,index) in budgetArr" :key="index">
                            <input type="radio" :id="index" name="customRadio" class="custom-control-input"
                                @change="handleBugdetFilter(index)"
                                :checked="budget.filter_value===$route.query.filter_value"
                            >
                            <label class="custom-control-label" :for="index">{{ budget.label }}</label>
                        </div>
                    
                    </div>
                </div>
            </div>
           
            
        </div>
    </div>
    </div>
</div>
</template>

<script>
import useFilter from '@/composables/useFilter'

export default {
    setup() {
        const { budgetArr,
          handleBugdetFilter,
          loadCategories, 
          handleCategoriesFilter } = useFilter();
        
        return {
            budgetArr,
            loadCategories,
            handleBugdetFilter,
            handleCategoriesFilter
        }
    }
}
</script>

<style>

</style>