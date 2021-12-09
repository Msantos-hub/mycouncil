import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

const routes = [

  //-------------------------------------------------------------------------------------------------------------------------------
  //    paginas principales
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/',
    name: 'Inicio',
    component: () => import(/* webpackChunkName: "about" */ '../views/Inicio.vue')
  },
  {
    path: '/user',
    name: 'Perfil',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Perfil.vue')
  },
  {
    path: '/catalogo',
    name: 'Catalogo',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Catalogo.vue')
  },
  {
    path: '/comic',
    name: 'Comic',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Comic.vue')
  },
  {
    path: '/listas',
    name: 'Listas',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Listas.vue')
  },
  {
    path: '/sugerencias',
    name: 'Sugerencias',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Sugerencias.vue')
  },
  {
    path: '/Controlpanel',
    name: 'PanelControl',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/PanelControl.vue')
  },
  //-------------------------------------------------------------------------------------------------------------------------------
  //    Registro, login y password
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/login',
    name: 'Login',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Login.vue')
  },
  {
    path: '/loginA',
    name: 'LoginA',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/LoginA.vue')
  },
  {
    path: '/recoveryPass',
    name: 'RecPassword',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/RecPassword.vue')
  },
  {
    path: '/newPass',
    name: 'NewPassword',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/NewPassword.vue')
  },
  {
    path: '/register',
    name: 'Registro',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Registro.vue')
  },
  //-------------------------------------------------------------------------------------------------------------------------------
  //    crud de Usuarios
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/UsersList',
    name: 'ListarU',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ListarU.vue')
  },
  //-------------------------------------------------------------------------------------------------------------------------------
  //    crud de Comics
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/listComic',
    name: 'ListarCo',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ListarCo.vue')
  }, 
  //-------------------------------------------------------------------------------------------------------------------------------
  //    crud de Categorias
  //-------------------------------------------------------------------------------------------------------------------------------
{
    path: '/listCat',
    name: 'ListarCat',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ListarCat.vue')
  },
  //-------------------------------------------------------------------------------------------------------------------------------
  //    crud de sugerencias
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/listSu',
    name: 'ListarSu',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/ListarSu.vue')
  },
  //-------------------------------------------------------------------------------------------------------------------------------
  //    Categorias
  //-------------------------------------------------------------------------------------------------------------------------------
  {
    path: '/heroes',
    name: 'Heroes',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaH.vue')
  },
  {
    path: '/mutantes',
    name: 'Mutantes',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaM.vue')
  },
  {
    path: '/jovenesmarvel',
    name: 'JovenesMarvel',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaJM.vue')
  },
  {
    path: '/universodc',
    name: 'UniversoDC',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaDC.vue')
  },
  {
    path: '/vertigo',
    name: 'Vertigo',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaV.vue')
  },
  {
    path: '/jovenesdc',
    name: 'JovenesDC',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaJDC.vue')
  },
  {
    path: '/nacional',
    name: 'Nacional',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaN.vue')
  },
  {
    path: '/millarverse',
    name: 'Millarverse',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaK.vue')
  },
  {
    path: '/superheroes',
    name: 'SuperHeroes',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaSH.vue')
  },
  {
    path: '/manga',
    name: 'Manga',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaMA.vue')
  },
  {
    path: '/manhwa',
    name: 'Manhwa',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaMAN.vue')
  },
  {
    path: '/webtoons',
    name: 'Webtoons',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/categorias/CategoriaW.vue')
  },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
