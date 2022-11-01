import { createRouter,createWebHistory } from "vue-router";
import adminExperienceIndex from '../components/admin/experience/index.vue'
import adminEducationIndex from '../components/admin/educations/index.vue'
import adminSkillIndex from '../components/admin/skills/index.vue'
import adminServiceIndex from '../components/admin/service/index.vue';
import homeAdminIndex from '../components/admin/home/index.vue'
import adminAboutIndex from '../components/admin/About/index.vue'
import homePageIndex from '../components/pages/home/index.vue'
import userIndex from '../components/usersview/index.vue'
import notFound from '../components/notfound.vue'
import login from '../components/auth/login.vue'
import register from '../components/auth/register.vue'
const routes =[
    //admin
    {
        path:'/admin/home',
        name: 'adminHome',
        component : homeAdminIndex,
        meta:{
            requiresAuth:true
        }
    },
    //about
    {
        path:'/admin/about',
        name:'adminAbout',
        component : adminAboutIndex,
        meta:{
            requiresAuth: true
        }
    },
    //service
    {
        path:'/admin/service',
        name:'adminService',
        component: adminServiceIndex,
        meta:{
            requiresAuth:true
        }
    },
    //skill
    {
        path:'/admin/skill',
        name:'adminSkill',
        component: adminSkillIndex,
        meta:{
            requiresAuth:true
        }

    },

    //education
    {
        path:'/admin/education',
        name:'adminEducation',
        component: adminEducationIndex,
        meta:{
            requiresAuth:true
        }
    },

    //experience
    {
        path:'/admin/experience',
        name:'adminExperience',
        component: adminExperienceIndex,
        meta:{
            requiresAuth:true
        }
    },

    //view
    {
        path:'/view',
        name: 'ViewUsers',
        component: userIndex,
        meta:{
            requiresAuth:true
        }
    },
    //page
    {
        path:'/page/home',
        name: 'Home',
        component : homePageIndex,
        meta:{
            requiresAuth:false
        }
    },
    //register
    {
        path:'/register',
        name:'Register',
        component: register,
        meta:{
            requiresAuth:false
        }
    },
    //login
    {
        path:'/login',
        name: 'Login',
        component : login,
        meta:{
            requiresAuth:false
        }
    },

    //not found
    {
        path: '/:pathMatch(.*)*',
        name: 'notFound',
        component: notFound,
        meta:{
            requiresAuth:false
        }
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to,from)=>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name:'Login'}
    }

    if(to.meta.requiresAuth==false && localStorage.getItem('token')){
        return { name:'adminHome'}
    }
})
export default router
