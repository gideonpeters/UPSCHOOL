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
				component: () => import("./../views/staff/StaffCourseView"),
				children: [
					{
						path: "overview",
						name: "staff.courses.view",
						meta: { title: "My Courses", key: 3 },
						component: () =>
							import("./../views/staff/StaffCourseViewOverview")
					},
					{
						path: "materials",
						name: "staff.courses.view.materials",
						meta: { title: "Course Materials", key: 3 },
						component: () =>
							import("./../views/staff/StaffCourseViewMaterials")
					},
					{
						path: "participants",
						name: "staff.courses.view.participants",
						meta: { title: "Course Participants", key: 3 },
						component: () =>
							import(
								"./../views/staff/StaffCourseViewParticipants"
							)
					},
					{
						path: "submissions",
						name: "staff.courses.view.submissions",
						meta: { title: "Course Submissions", key: 3 },
						component: () =>
							import(
								"./../views/staff/StaffCourseViewSubmissions"
							)
					},
					{
						path: "grades",
						component: () =>
							import("./../views/staff/StaffCourseViewGradeView"),

						children: [
							{
								path: "",
								name: "staff.courses.view.grades",
								meta: { title: "Course Grades", key: 3 },
								component: () =>
									import(
										"./../views/staff/StaffCourseViewGrades"
									)
							},
							{
								path: ":grade_id/view",
								name: "staff.courses.view.grades.view",
								meta: { title: "Course Grade Details", key: 3 },
								component: () =>
									import(
										"./../views/staff/StaffCourseViewGradeDetail"
									)
							}
						]
					},
					{
						path: "settings",
						name: "staff.courses.view.settings",
						meta: { title: "Course Settings", key: 3 },
						component: () =>
							import("./../views/staff/StaffCourseViewSettings")
					}
				]
			},
			{
				path: "register",
				name: "staff.courses.register",
				meta: { title: "Manage Courses", key: 3 },
				component: () =>
					import("./../views/staff/StaffCourseManage.vue")
			},
			{
				path: "advisees/:id",
				name: "staff.courses.approve",
				meta: { title: "Approve Courses", key: 3 },
				component: () =>
					import("./../views/staff/StaffEnrollmentView.vue")
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
	{
		path: "news/:id",
		name: "staff.news.details",
		component: () => import("./../views/staff/StaffNewsDetails")
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
