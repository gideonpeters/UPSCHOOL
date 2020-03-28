export default [
	{
		path: "",
		name: "admin.dashboard",
		component: () => import("./../views/admin/AdminDashboard")
	},
	{
		path: "admissions",
		name: "admin.admissions",
		component: () => import("./../views/admin/AdminAdmissions")
	},
	{
		path: "students/list",
		name: "admin.students.list",
		component: () => import("./../views/admin/AdminStudents")
	},
	{
		path: "attendance/events",
		name: "admin.events",
		component: () => import("./../views/admin/attendance/AdminEvents")
	},
	{
		path: "attendance/students",
		name: "admin.events.students",
		component: () =>
			import("./../views/admin/attendance/AdminAttendanceStudents")
	},
	{
		path: "attendance/staff",
		name: "admin.events.staff",
		component: () =>
			import("./../views/admin/attendance/AdminAttendanceStaff")
	}
];
