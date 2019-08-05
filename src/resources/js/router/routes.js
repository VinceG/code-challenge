const routes = [
    {
        path: "/login",
        //   component: () => import(/* webpackChunkName: "auth" */ "@/views/auth/base"),
        component: require("@/views/auth/base").default,
        children: [
            {
                path: "",
                name: "login",
                // component: () => import(/* webpackChunkName: "auth" */ "@/views/auth/login")
                component: require("@/views/auth/login").default,
            }
        ]
    },
    {
        path: "/",
        // component: () => import(/* webpackChunkName: "dashboard" */ "@/views/dashboard/base"),
        component: require("@/views/dashboard/base").default,
        children: [
            {
                path: "",
                name: "index",
                component: require("@/views/dashboard/index").default,
                // component: () => import(/* webpackChunkName: "dashboard" */ "@/views/dashboard/index")
            }
        ]
    },
    {
        path: "*",
        component: require("@/views/errors/base").default,
        // component: () => import(/* webpackChunkName: "error" */ "@/views/errors/base"),
        children: [
            {
                path: "",
                name: "catcha-all",
                component: require("@/views/errors/404").default,
                // component: () => import(/* webpackChunkName: "error" */ "@/views/errors/404")
            }
        ]
    }
];

export default routes;
