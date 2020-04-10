export default [
	{
		path: "",
		name: "student.dashboard",
		meta: { title: "Dashboard" },
		component: () => import("./../views/student/PStudentDashboard")
	},
	{
		path: "inbox",
		name: "student.inbox",
		meta: { title: "Inbox" },
		component: () => import("./../views/student/StudentInbox")
	},
	{
		path: "academic-profile",
		name: "student.profile",
		meta: { title: "Academic Profile" },
		component: () => import("./../views/student/StudentAcademicProfile")
	},
	{
		path: "courses",
		component: () => import("./../views/apps/Courses"),
		children: [
			{
				path: "",
				name: "student.course-reg",
				meta: { title: "Course Registration", key: 3 },
				component: () =>
					import("./../views/student/StudentCourseRegistration")
			},
			{
				path: "plan",
				name: "student.courses.plan",
				meta: { title: "My Courses", key: 3 },
				component: () => import("./../views/student/StudentCoursePlan")
			},
			{
				path: "assignments",
				name: "student.courses.assignments",
				meta: { title: "My Assignments", key: 3 },
				component: () =>
					import("./../views/student/StudentCourseAssignments")
			},
			{
				path: "grading",
				name: "student.courses.grading",
				meta: { title: "My Assignments", key: 3 },
				component: () =>
					import("./../views/student/StudentCourseGrading")
			},
			{
				path: "view/:id",
				name: "student.courses.view",
				meta: { title: "My Courses", key: 3 },
				component: () => import("./../views/student/StudentCourseView")
			},
			{
				path: "register",
				name: "student.courses.register",
				meta: { title: "Manage Courses", key: 3 },
				component: () =>
					import("./../views/student/StudentCourseManage.vue")
			}
		]
	},
	{
		path: "payment",
		// name: "student.payments",
		component: () => import("./../views/apps/Payments"),
		// meta: { title: "Payments" },
		children: [
			{
				path: "",
				name: "student.payments",
				meta: { key: 5 },
				component: () => import("./../views/student/StudentPaymentFees")
			},
			{
				path: "history",
				name: "student.payments.history",
				meta: { key: 5 },
				component: () =>
					import("./../views/student/StudentPaymentHistory")
			}
			// {
			// 	path: "wallets",
			// 	name: "student.payments",
			// 	meta: { key: 5 },
			// 	component: () => import("./../views/student/StudentPaymentFees")
			// },
		]
	},
	{
		path: "planner",
		// name: "student.calendar",
		// meta: { title: "Calendar" },
		component: () => import("./../views/apps/Planner"),
		children: [
			{
				path: "",
				name: "student.calendar",
				meta: { key: 6 },
				component: () => import("./../views/student/StudentCalendar")
			},
			{
				path: "schedule",
				name: "student.schedule",
				meta: { key: 6 },
				component: () => import("./../views/student/StudentCalendar")
			}
		]
	},
	{
		path: "results",
		// name: "student.results",
		component: () => import("./../views/apps/Results"),
		children: [
			{
				path: "",
				name: "student.results",
				meta: { title: "Result Anaylysis", key: 4 },
				component: () => import("./../views/student/StudentResult")
			},
			{
				path: "breakdown",
				name: "student.results.breakdown",
				meta: { title: "Result Breakdown", key: 4 },
				component: () =>
					import("./../views/student/StudentResultBreakdown")
			},
			{
				path: "calculator",
				name: "student.results.calculator",
				meta: { title: "Bull's Eye", key: 4 },
				component: () =>
					import("./../views/student/StudentResultCalculator")
			}
		]
	},
	{
		path: "attendance",
		name: "student.attendance",
		meta: { title: "Attendance" },

		component: () => import("./../views/student/StudentAttendance")
	},
	{
		path: "notifications",
		name: "student.notifications",
		meta: { title: "Notifications" },
		component: () => import("./../views/student/StudentNotifications")
	},
	{
		path: "news/:id",
		name: "student.news.details",
		meta: { title: "Latest News Details" },
		component: () => import("./../views/student/StudentNewsDetails")
	},
	{
		path: "news",
		name: "student.news",
		meta: { title: "Latest News" },
		component: () => import("./../views/student/StudentNews")
	},
	{
		path: "residence",
		name: "student.residence",
		meta: { title: "Residence" },
		component: () => import("./../views/student/StudentResidence")
	},
	{
		path: "settings",
		name: "student.settings",
		meta: { title: "Settings" },
		component: () => import("./../views/student/StudentSettings")
	},
	{
		path: "help",
		name: "student.help",
		meta: { title: "Help" },
		component: () => import("./../views/student/StudentHelp")
	}
];
