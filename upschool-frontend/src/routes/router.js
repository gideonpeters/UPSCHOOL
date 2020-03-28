import Vue from "vue";
import VueRouter from "vue-router";

import studentRoutes from "./studentRoutes";
import staffRoutes from "./staffRoutes";
import adminRoutes from "./adminRoutes";
import parentRoutes from "./parentRoutes";

import StudentPlatform from "./../layouts/StudentPlatform";
import StaffPlatform from "./../layouts/StaffPlatform";
import AdminPlatform from "./../layouts/AdminPlatform";
import ParentPlatform from "./../layouts/ParentPlatform";

Vue.use(VueRouter);

export default new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: [
		{
			path: "/upschool",
			component: ParentPlatform,
			children: parentRoutes
		},
		{
			path: "/",
			component: () => import("./../layouts/Auth"),
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
		},
		{ path: "/staff", component: StaffPlatform, children: staffRoutes },
		{ path: "/admin", component: AdminPlatform, children: adminRoutes },
		{
			path: "/help",
			name: "main.help",
			component: () => import("./../views/general/Help")
		}
	]
});
