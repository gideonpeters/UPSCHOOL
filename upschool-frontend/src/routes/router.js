import Vue from "vue";
import VueRouter from "vue-router";
import store from "./../store/store";

import studentRoutes from "./studentRoutes";
import staffRoutes from "./staffRoutes";
import adminRoutes from "./adminRoutes";
import parentRoutes from "./parentRoutes";

import StudentPlatform from "./../layouts/StudentPlatform";
import StaffPlatform from "./../layouts/StaffPlatform";
import AdminPlatform from "./../layouts/AdminPlatform";
import ParentPlatform from "./../layouts/ParentPlatform";

Vue.use(VueRouter);

// const ifNotAuthenticated = (to, from, next) => {
// 	if (!store.getters.isAuthenticated) {
// 		next();
// 		return;
// 	}
// 	next("/");
// };

// const ifAuthenticated = (to, from, next) => {
// 	if (store.getters.isAuthenticated) {
// 		next();
// 		return;
// 	}
// 	next("/");
// };

export default new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: [
		{
			path: "/upschool",
			component: ParentPlatform,
			children: parentRoutes
			// beforeEnter: ifAuthenticated
		},
		{
			path: "/",
			component: () => import("./../layouts/Auth"),
			// beforeEnter: ifNotAuthenticated,
			children: [
				{
					path: "",
					name: "main.login",
					component: () => import("./../views/general/Login")
				},
				{
					path: "register",
					name: "main.register",
					component: () => import("./../views/general/Register")
				}
			]
		},
		{
			path: "/student",
			component: StudentPlatform,
			children: studentRoutes
			// beforeEnter: ifAuthenticated
		},
		{
			path: "/staff",
			component: StaffPlatform,
			children: staffRoutes
			// beforeEnter: ifAuthenticated
		},
		{
			path: "/admin",
			component: AdminPlatform,
			children: adminRoutes
			// beforeEnter: ifAuthenticated
		},
		{
			path: "/help",
			name: "main.help",
			component: () => import("./../views/general/Help")
		}
	]
});
