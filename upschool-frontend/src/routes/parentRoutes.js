export default [
	{
		path: "/",
		name: "parent.dashboard",
		component: () => import("./../views/parent/ParentDashboard")
	},
	{
		path: "courses",
		name: "parent.courses",
		component: () => import("./../views/parent/ParentCourses")
	},
	{
		path: "courses/:id",
		name: "parent.courses-view",
		component: () => import("./../views/parent/ParentCourseView")
	},
	{
		path: "students",
		name: "parent.students",
		component: () => import("./../views/parent/ParentStudents")
	},
	{
		path: "students/:id",
		name: "parent.students.view",
		component: () => import("./../views/parent/ParentStudentView")
	},
	{
		path: "staff",
		name: "parent.staff",
		component: () => import("./../views/parent/ParentStaff")
	},
	{
		path: "staff/:id",
		name: "parent.staff.view",
		component: () => import("./../views/parent/ParentStaffView")
	},
	{
		path: "inbox",
		name: "parent.inbox",
		component: () => import("./../views/parent/ParentInbox")
	},
	{
		path: "leave",
		name: "parent.leave",
		component: () => import("./../views/parent/ParentLeave")
	},
	{
		path: "leave/:id",
		name: "parent.leave-details",
		component: () => import("./../views/parent/ParentLeaveDetails")
	},
	{
		path: "residence",
		name: "parent.residence",
		component: () => import("./../views/parent/ParentResidence")
	},
	{
		path: "fees",
		name: "parent.fees",
		component: () => import("./../views/parent/ParentFees")
	},
	{
		path: "financials",
		name: "parent.financials",
		component: () => import("./../views/parent/ParentFinancials")
	},
	{
		path: "calendar",
		name: "parent.calendar",
		component: () => import("./../views/parent/ParentCalendar")
	},
	{
		path: "attendance",
		name: "parent.attendance",
		component: () => import("./../views/parent/ParentAttendance")
	},
	{
		path: "attendance/:id",
		name: "parent.attendance.details",
		component: () => import("./../views/parent/ParentAttendanceDetails")
	},
	{
		path: "attendance/view/:id",
		name: "parent.attendance-view",
		component: () => import("./../views/parent/ParentAttendanceView")
	},
	{
		path: "reports",
		name: "parent.reports",
		component: () => import("./../views/parent/ParentReports")
	},
	{
		path: "home",
		name: "parent.home",
		component: () => import("./../views/parent/ParentHome")
	},
	{
		path: "settings",
		name: "parent.settings",
		component: () => import("./../views/parent/ParentSettings")
	},
	{
		path: "help",
		name: "parent.help",
		component: () => import("./../views/parent/ParentHelp")
	},
	{
		path: "applications",
		name: "parent.applications",
		component: () => import("./../views/parent/ParentApplications")
	},
	{
		path: "news",
		name: "parent.news",
		component: () => import("./../views/parent/ParentNews")
	},
	{
		path: "news/:id",
		name: "parent.news.details",
		component: () => import("./../views/parent/ParentNewsDetails")
	},
	{
		path: "setup",
		name: "parent.setup",
		component: () => import("./../views/parent/ParentSetup")
	},
	{
		path: "college",
		name: "parent.colleges",
		component: () => import("./../views/parent/ParentCollege")
	},
	{
		path: "college/:id",
		name: "parent.colleges.details",
		component: () => import("./../views/parent/ParentCollegeDetails")
	},
	{
		path: "department",
		name: "parent.departments",
		component: () => import("./../views/parent/ParentDepartment")
	},
	{
		path: "department/:id",
		name: "parent.departments.details",
		component: () => import("./../views/parent/ParentDepartmentDetails")
	},
	{
		path: "program",
		name: "parent.programs",
		component: () => import("./../views/parent/ParentProgram")
	},
	{
		path: "program/:id",
		name: "parent.programs.details",
		component: () => import("./../views/parent/ParentProgramDetails")
	}
	// {
	// 	path: "/finances",
	// 	name: "parent.finances",
	// 	component: () => import("./../views/parent/parentFinances")
	// },
	// {
	// 	path: "/calendar",
	// 	name: "parent.calendar",
	// 	component: () => import("./../views/parent/parentCalendar")
	// },
	// {
	// 	path: "/result",
	// 	name: "parent.result",
	// 	component: () => import("./../views/parent/parentResult")
	// },
	// {
	// 	path: "/attendance",
	// 	name: "parent.attendance",
	// 	component: () => import("./../views/parent/parentAttendance")
	// }
];
