import { ref } from '@vue/reactivity';
import { useRoute, useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default function Filter() {

    const store = useStore();
    const route = useRoute();
    const router = useRouter();

    const budgetArr = ref([
        { 
            filter: 'price<',
            filter_value: '50',
            label: 'less - €50'
        },
        { 
            filter: 'price',
            filter_value: '50,100',
            label: '€50 - €100'
        },
        { 
            filter: 'price',
            filter_value: '100,500',
            label: '€100 - €500'
        },
        { 
            filter: 'price',
            filter_value: '500,1000',
            label: '€500 - €1000'
        },
        { 
            filter: 'price>',
            filter_value: '1000',
            label: 'above - €1000'
        },
    ]);
    const handleBugdetFilter = (index) => {
        let budget = budgetArr.value[index];

        let path="/gigs/"+route.params.slug;

        if(route.query.id){
            path+=`?id=${route.query.id}`;
        }
        path+= path.includes("&") ? "?" : "&"+`filter=${budget.filter}&filter_value=${budget.filter_value}&page=1`;

        router.push(path);
    }

    const handleCategoriesFilter = (slug) => {
        router.push(`/gigs/${slug}`)
    }

    const loadCategories = () => {
        store.dispatch('loadCategories');
    }

    return {
        budgetArr,
        loadCategories,
        handleCategoriesFilter,
        handleBugdetFilter
    }
}