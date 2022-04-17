import { createRouter, createWebHistory } from 'vue-router'
import notFound from '../components/notFound.vue'
//importacion de componentes de las tareas
import Index from '../components/task/Index.vue'
//importacion de componentes de login
import Login from '../components/login/Login.vue'
import Base from '../components/Base.vue';

const routes = [ 
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: { requiresAuth: false }
    },
    {
        name: 'base',
        path: '/',
        component: Base,
        meta: { requiresAuth: true },
        children: [{
            path: '',
            name: 'task',
            component: Index
        },       
        
        ]
    },    
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    },    
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes

})

function loggedIn() {
    return localStorage.getItem('token')
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {      
        if (!loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {

            next({
                path: '/',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {

        next() // make sure to always call next()!
    }
})
export default router