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
		component: () => import("./../views/apps/Courses"),
		children: [
			{
				path: "",
				name: "staff.courses",
				meta: { key: 3 },
				component: () => import("./../views/staff/StaffCourses")
			},
			{
				path: "plan",
				name: "staff.courses.plan",
				meta: { title: "My Courses", key: 3 },
				component: () => import("./../views/staff/StaffCoursePlan")
			},
			{
				path: "assignments",
				name: "staff.courses.assignments",
				meta: { title: "My Assignments", key: 3 },
				component: () =>
					import("./../views/staff/StaffCourseAssignments")
			},
			{
				path: "grading",
				name: "staff.courses.grading",
				meta: { title: "My Assignments", key: 3 },
				component: () => import("./../views/staff/StaffCourseGrading")
			},
			{
				path: "view/:id",
				name: "staff.courses.view",
				meta: { title: "My Courses", key: 3 },
				component: () => import("./../views/staff/StaffCourseView")
			},
			{
				path: "register",
				name: "staff.courses.register",
				meta: { title: "Manage Courses", key: 3 },
				component: () =>
					import("./../views/staff/StaffCourseManage.vue")
			}
		]
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
