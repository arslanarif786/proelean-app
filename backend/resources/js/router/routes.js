import { createRouter } from 'vue-router'
import home from '../components/index.vue'


const router = new createRouter({
    routes:[
        {path:'',name:'home',component:home}
    ]
});
export default router;
