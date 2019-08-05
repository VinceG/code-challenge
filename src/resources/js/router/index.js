import Vue from "vue";
import Router from "vue-router";
import routes from "./routes";
import store from "store";
import { get } from "@/utils/lodash";

Vue.use(Router);

const router = new Router({
  mode: "history",
  base: __dirname,
  routes: routes
});

router.beforeEach((to, from, next) => {
  let isLoggedIn = get(store.getters, "auth/token", null);
  if (to.name != "login") {
    if (isLoggedIn) {
      next();
      return;
    }
    next({ name: "login" });
  } else if (to.name == "login" && isLoggedIn) {
    next({ name: "index" });
  } else {
    next();
  }
});

export default router;
