import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueAnime from 'vue-animejs';


import navMenu from './02-objects/o-01-menu/menu.vue'
import logo from './02-objects/o-02-logo/logo.vue'
import scrollButtons from './02-objects/o-03-scroll_buttons/scroll_buttons.vue'
import caseItem from './03-components/c-01-case-item/case_item.vue'


Vue.component('navMenu', navMenu);
Vue.component('logo', logo);
Vue.component('scrollButtons', scrollButtons);
Vue.component('caseItem', caseItem);

Vue.use(VueAnime);

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
