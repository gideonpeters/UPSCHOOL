export default [
	{
		path: "",
		name: "staff.dashboard",
		component: () => import("./../views/staff/StaffDashboard")
	},
	{
		path: "profile",
		name: "staff.profile",
		component: () => import("./../views/staff/StaffProfile")
	},
	{
		path: "inbox",
		name: "staff.inbox",
		component: () => import("./../views/staff/StaffInbox")
	},
	{
		path: "courses",
		name: "staff.courses",
		component: () => import("./../views/staff/StaffCourses")
	},
	{
		path: "finances",
		name: "staff.finances",
		component: () => import("./../views/staff/StaffFinances")
	},
	{
		path: "calendar",
		name: "staff.calendar",
		component: () => import("./../views/staff/StaffCalendar")
	},
	{
		path: "result",
		name: "staff.result",
		component: () => import("./../views/staff/StaffResult")
	},
	{
		path: "attendance",
		name: "staff.attendance",
		component: () => import("./../views/staff/StaffAttendance")
	},
	{
		path: "news",
		name: "staff.news",
		component: () => import("./../views/staff/StaffNews")
	},
	// {
	// 	path: "residence",
	// 	name: "staff.residence",
	// 	component: () => import("./../views/staff/StaffResidence")
	// },
	{
		path: "settings",
		name: "staff.settings",
		component: () => import("./../views/staff/StaffSettings")
	},
	{
		path: "help",
		name: "staff.help",
		component: () => import("./../views/staff/StaffHelp")
	}
];
