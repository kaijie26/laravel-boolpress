import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from "./pages/HomePage.vue";
import AboutPage from "./pages/AboutPage.vue";
import BlogPage from "./pages/BlogPage.vue";
import ErrorNotFound from "./pages/ErrorNotFound.vue";
import SinglePost from "./pages/SinglePost.vue";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: HomePage,
            name: 'home'

        },
        {
            path: '/about',
            component: AboutPage,
            name: 'about'

        },
        {
            path: '/blog',
            component: BlogPage,
            name: 'blog'

        },
        {
            path: '/blog/:slug',
            component: SinglePost,
            name: 'single-post'

        },
        {
            path: '/*',
            component: ErrorNotFound,
            name: 'error'

        },

    ]
  })

  export default router;