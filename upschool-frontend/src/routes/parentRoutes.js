export default [
	{
		path: "/",
		name: "parent.dashboard",
		component: () => import("./../views/parent/ParentDashboard"),
	},
	{
		path: "courses",
		name: "parent.courses",
		component: () => import("./../views/parent/ParentCourses"),
	},
	{
		path: "courses/:id",
		component: () => import("./../views/parent/ParentCourseView"),
		children: [
			{
				path: "overview",
				name: "parent.courses.view",
				meta: { title: "My Courses", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewOverview"),
			},
			{
				path: "materials",
				name: "parent.courses.view.materials",
				meta: { title: "Course Materials", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewMaterials"),
			},
			{
				path: "participants",
				name: "parent.courses.view.participants",
				meta: { title: "Course Participants", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewParticipants"),
			},
			{
				path: "submissions",
				name: "parent.courses.view.submissions",
				meta: { title: "Course Submissions", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewSubmissions"),
			},
			{
				path: "submissions/:submission_id",
				name: "parent.courses.view.submissions.details",
				meta: { title: "Course Submissions Details", key: 3 },
				component: () =>
					import(
						"./../views/parent/ParentCourseViewSubmissionsDetails"
					),
			},
			{
				path: "assessments",
				name: "parent.courses.view.assessments",
				meta: { title: "Course Assessments", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewAssessments"),
			},
			{
				path: "grades",
				component: () =>
					import("./../views/parent/ParentCourseViewGradeView"),

				children: [
					{
						path: "",
						name: "parent.courses.view.grades",
						meta: { title: "Course Grades", key: 3 },
						component: () =>
							import("./../views/parent/ParentCourseViewGrades"),
					},
					{
						path: ":grade_id/view",
						name: "parent.courses.view.grades.view",
						meta: { title: "Course Grade Details", key: 3 },
						component: () =>
							import(
								"./../views/parent/ParentCourseViewGradeDetail"
							),
					},
				],
			},
			{
				path: "settings",
				name: "parent.courses.view.settings",
				meta: { title: "Course Settings", key: 3 },
				component: () =>
					import("./../views/parent/ParentCourseViewSettings"),
			},
		],
	},
	{
		path: "students",
		name: "parent.students",
		component: () => import("./../views/parent/ParentStudents"),
	},
	{
		path: "students/:id",
		name: "parent.students.view",
		component: () => import("./../views/parent/ParentStudentView"),
	},
	{
		path: "staff",
		name: "parent.staff",
		component: () => import("./../views/parent/ParentStaff"),
	},
	{
		path: "staff/:id",
		name: "parent.staff.view",
		component: () => import("./../views/parent/ParentStaffView"),
	},
	{
		path: "admins",
		name: "parent.admins",
		component: () => import("./../views/parent/ParentAdmins"),
	},
	{
		path: "admins/:id",
		name: "parent.admins.view",
		component: () => import("./../views/parent/ParentAdminView"),
	},
	{
		path: "inbox",
		name: "parent.inbox",
		component: () => import("./../views/parent/ParentInbox"),
	},

	{
		path: "residence",
		name: "parent.residence",
		component: () => import("./../views/parent/ParentResidence"),
	},
	{
		path: "halls",
		name: "parent.halls",
		component: () => import("./../views/parent/ParentHalls"),
	},
	{
		path: "halls/:id",
		name: "parent.halls.details",
		component: () => import("./../views/parent/ParentHallsDetails"),
	},
	{
		path: "rooms",
		name: "parent.rooms",
		component: () => import("./../views/parent/ParentRooms"),
	},
	{
		path: "rooms/:id",
		// name: "parent.rooms.details",
		component: () => import("./../views/parent/ParentRoomsDetails"),
		children: [
			{
				path: "overview",
				name: "parent.rooms.details",
				component: () => import("./../views/parent/room-view/Overview"),
			},
			{
				path: "occupancy",
				name: "parent.rooms.details.occupancy",
				component: () =>
					import("./../views/parent/room-view/Occupancy"),
			},
			{
				path: "issues",
				name: "parent.rooms.details.issues",
				component: () => import("./../views/parent/room-view/Issues"),
			},
		],
	},
	{
		path: "room/types",
		name: "parent.rooms.types",
		component: () => import("./../views/parent/ParentRoomTypes"),
	},
	{
		path: "room/types/:id",
		name: "parent.rooms.types.details",
		component: () => import("./../views/parent/ParentRoomTypesDetails"),
	},
	{
		path: "room/allocation",
		name: "parent.rooms.settings",
		component: () => import("./../views/parent/ParentAllocationSettings"),
	},
	{
		path: "fees",
		name: "parent.fees",
		component: () => import("./../views/parent/ParentFees"),
	},
	{
		path: "financials",
		name: "parent.financials",
		component: () => import("./../views/parent/ParentFinancials"),
	},
	{
		path: "calendar",
		name: "parent.calendar",
		component: () => import("./../views/parent/ParentCalendar"),
	},
	{
		path: "attendance",
		name: "parent.attendance",
		component: () => import("./../views/parent/ParentAttendance"),
	},
	{
		path: "attendance/:id",
		name: "parent.attendance.details",
		component: () => import("./../views/parent/ParentAttendanceDetails"),
	},
	{
		path: "attendance/view/:id",
		name: "parent.attendance-view",
		component: () => import("./../views/parent/ParentAttendanceView"),
	},
	{
		path: "reports",
		name: "parent.reports",
		component: () => import("./../views/parent/ParentReports"),
	},
	{
		path: "home",
		name: "parent.home",
		component: () => import("./../views/parent/ParentHome"),
	},
	{
		path: "settings",
		name: "parent.settings",
		component: () => import("./../views/parent/ParentSettings"),
	},
	{
		path: "help",
		name: "parent.help",
		component: () => import("./../views/parent/ParentHelp"),
	},
	{
		path: "applications",
		component: () => import("./../views/parent/ParentApplications"),
		children: [
			{
				path: "leave",
				name: "parent.leave.view",
				component: () =>
					import("./../views/parent/leave-view/ParentLeave"),
			},
			{
				path: "leave/:id",
				name: "parent.leave.details",
				component: () =>
					import("./../views/parent/leave-view/ParentLeaveDetails"),
			},
			{
				path: "exeat",
				name: "parent.exeat.view",
				component: () =>
					import("./../views/parent/exeat-view/ParentExeat"),
			},
			{
				path: "exeat/:id",
				name: "parent.exeat.details",
				component: () =>
					import("./../views/parent/exeat-view/ParentExeatDetails"),
			},
			{
				path: "types",
				name: "parent.applications.types",
				component: () =>
					import(
						"./../views/parent/application-view/ParentApplicationTypes"
					),
			},
		],
	},
	{
		path: "news",
		name: "parent.news",
		component: () => import("./../views/parent/ParentNews"),
	},
	{
		path: "news/:id",
		name: "parent.news.details",
		component: () => import("./../views/parent/ParentNewsDetails"),
	},
	{
		path: "setup",
		name: "parent.setup",
		component: () => import("./../views/parent/ParentSetup"),
	},
	{
		path: "college",
		name: "parent.colleges",
		component: () => import("./../views/parent/ParentCollege"),
	},
	{
		path: "college/:id",
		name: "parent.colleges.details",
		component: () => import("./../views/parent/ParentCollegeDetails"),
	},
	{
		path: "school-assessment",
		name: "parent.school-assessments",
		component: () => import("./../views/parent/ParentSchoolAssessment"),
	},
	{
		path: "school-assessment/:id",
		name: "parent.school-assessments.view",
		component: () =>
			import("./../views/parent/ParentSchoolAssessmentDetail"),
	},
	{
		path: "department",
		name: "parent.departments",
		component: () => import("./../views/parent/ParentDepartment"),
	},
	{
		path: "department/:id",
		name: "parent.departments.details",
		component: () => import("./../views/parent/ParentDepartmentDetails"),
	},
	{
		path: "program",
		name: "parent.programs",
		component: () => import("./../views/parent/ParentProgram"),
	},
	{
		path: "program/:id",
		name: "parent.programs.details",
		component: () => import("./../views/parent/ParentProgramDetails"),
	},
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
