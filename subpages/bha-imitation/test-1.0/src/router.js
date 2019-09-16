import Vue from 'vue'
import Router from 'vue-router'
import Cases from './01-views/v-01-cases/Cases.vue'
import About from './01-views/v-02-about/About.vue'
import Contact from './01-views/v-03-contact/Contact.vue'


Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'cases',
      component: Cases
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    }
  ]
})
