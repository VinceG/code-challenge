import Vue from 'vue';
import App from "./Entry";
import router from "./router";
import store from "./store";

Vue.config.productionTip = false;

import { sync } from "vuex-router-sync";
sync(store, router);

new Vue({
    router,
    store,
    render: h => h(App),
  }).$mount("#app");