import Vue from "vue";
import Vuetify from "vuetify/lib";
import "vuetify/dist/vuetify.css";
// import "vuetify/src/stylus/app.styl";

import SidebarMenu from "@/components/icons/SidebarMenu";
import SidebarDashboard from "@/components/icons/SidebarDashboard";
import SidebarCourseRegistration from "@/components/icons/SidebarCourseRegistration";
import SidebarCalendar from "@/components/icons/SidebarCalendar";
import SidebarPayment from "@/components/icons/SidebarPayment";
import SidebarResult from "@/components/icons/SidebarResult";
import SidebarEmail from "@/components/icons/SidebarEmail";
import SidebarAttendance from "@/components/icons/SidebarAttendance";
import ResultPassed from "@/components/icons/ResultPassed";
import ResultFailed from "@/components/icons/ResultFailed";
import ResultCgpa from "@/components/icons/ResultCgpa";

let values = {
	theme: {
		themes: {
			light: {
				primary: "#683587",
				secondary: "#59C203",
				accent: "#FF2323"
			}
		}
	},
	options: { customProperties: true },
	iconfont: "mdi",
	icons: {
		values: {
			"sidebar-menu": {
				component: SidebarMenu
			},
			"sidebar-dashboard": {
				component: SidebarDashboard
			},
			"sidebar-course-registration": {
				component: SidebarCourseRegistration
			},
			"sidebar-calendar": {
				component: SidebarCalendar
			},
			"sidebar-payment": {
				component: SidebarPayment
			},
			"sidebar-result": {
				component: SidebarResult
			},
			"sidebar-email": {
				component: SidebarEmail
			},
			"sidebar-attendance": {
				component: SidebarAttendance
			},
			"result-passed": {
				component: ResultPassed
			},
			"result-failed": {
				component: ResultFailed
			},
			"result-cgpa": {
				component: ResultCgpa
			}
		}
	}
};
Vue.use(Vuetify);

export default new Vuetify(values);
