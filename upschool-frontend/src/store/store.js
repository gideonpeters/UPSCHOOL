import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		token: localStorage.getItem("upschool-token"),
		selectedCourses: [],
		courseCategories: [
			{
				id: 1,
				title: "Departmental Courses",
				subCategories: [
					{ id: 1, title: "EIE Courses" },
					{ id: 2, title: "Mech Courses" },
				],
			},
			{
				id: 2,
				title: "College Wide Courses Course",
				subCategories: [
					{ id: 1, title: "CST Courses" },
					{ id: 2, title: "COE Courses" },
				],
			},
		],
		courses: [],
		course_statuses: [],
		student_courses: [
			{
				id: 1,
				title: "Real Analysis",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.75,
			},
			{
				id: 2,
				title: "Real Analysis II",
				course_code: "MAT412",
				status: "registered",
				attendance: 1,
			},
			{
				id: 3,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.5,
			},
			{
				id: 4,
				title: "Numerical Analysis",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.2,
			},
			{
				id: 5,
				title:
					"Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.9,
			},
			{
				id: 6,
				title: "Real Analysis",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.75,
			},
			{
				id: 7,
				title: "Real Analysis II",
				course_code: "MAT412",
				status: "registered",
				attendance: 1,
			},
			{
				id: 8,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				status: "registered",
				attendance: 0.5,
			},
			{
				id: 9,
				title: "Numerical Analysis",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.2,
			},
			{
				id: 10,
				title:
					"Introduction to Embedded Systems and VHDL design patterns Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				status: "Pending",
				attendance: 0.9,
			},
		],
		studentHeaders: [
			{
				text: "Name",
				align: "left",
				sortable: false,
				value: "name",
			},
			{ text: "Matriculation Number", value: "matric_number" },
			{ text: "Registration Number", value: "reg_number" },
			{ text: "Department", value: "department" },
			{ text: "Grade/Level", value: "level" },
			{ text: "Residence", value: "residence" },
			{ text: "Actions", value: "actions", sortable: false },
		],
		students: [],
		studentEvents: [],
		staff: [],
		events: [],
		snackbar: {
			timeout: 3000,
			text: "",
			isActive: false,
		},
		loggedInUser: null,
		curriculum_types: [],
		colleges: [],
		departments: [],
		programs: [],
		semesterTypes: [
			{ id: 1, title: "Alpha Semester", short_name: "Alpha" },
			{ id: 2, title: "Omega Semester", short_name: "Omega" },
		],
		semesters: [],
		sessions: [],
		news: [],
		schoolEvents: [],
		enrollments: [],
		messageList: [],
		settings: {
			canEnroll: true,
			canAddAndDrop: true,
			enrollBySemester: false,
			enrollBySession: true,
		},
		currentAcademicSession: {},
		selectedPendingCourses: [],
		facilitated: [],
		schoolAssessments: [],
	},
	getters: {
		getCourses({ courses }) {
			return courses;
		},
		getCoursesFromEnrollments({ enrollments }) {
			if (enrollments.length > 0) {
				let enrolled = enrollments[0].curriculum_items;
				let ans = enrolled.map((item) => item.curriculumable);
				// console.log(ans);
				return ans;
			}
			return [];
		},
		getFacilitatedCourses({ facilitated }) {
			return facilitated;
		},
		isAuthenticated: ({ token }) => !!token,
		getEvent: ({ events }) => (id) => {
			return events.find((event) => event.id == id);
		},
		getStudent: ({ students }) => (id) => {
			return students.find((student) => student.matric_number == id);
		},
		getStaffById: ({ staff }) => (id) => {
			return staff.find((staf) => staf.staff_number == id);
		},
		getStudentEvent: ({ studentEvents }) => (id) => {
			return studentEvents.filter(
				(studentEvent) => studentEvent.student.matric_number == id
			);
		},
		getCourseById: ({ courses }) => (id) => {
			return courses.find((course) => course.id == id);
		},
		getSemesterById: ({ semesters }) => (id) => {
			return semesters.find((semester) => semester.id == id);
		},
		getNewsById: ({ news }) => (id) => {
			return news.find((item) => item.id == id);
		},
		snackbar({ snackbar }) {
			return snackbar;
		},
	},
	mutations: {
		openSnackbar({ snackbar }, payload) {
			snackbar.text = payload;
			return (snackbar.isActive = true);
		},
		auth_success(state, payload) {
			state.loggedInUser = payload;
			return;
		},
		closeSnackbar({ snackbar }) {
			return (snackbar.isActive = false);
		},
	},
	actions: {
		async login({ commit }, payload) {
			try {
				// commit("auth_request");
				let res = await axios.post("auth/login", payload);

				const token = res.data.token;
				const userInfo = res.data.user;

				localStorage.setItem("upschool-token", token);
				axios.defaults.headers.common[
					"Authorization"
				] = `Bearer ${token}`;

				if (token) {
					commit("auth_success", userInfo);
					commit(
						"openSnackbar",
						`Welcome to Upschool ${userInfo.name}`
					);
				} else {
					commit("openSnackbar", `Something went wrong`);
				}

				return { data: res.data, type: userInfo.type };
			} catch (error) {
				// commit("auth_eror");
				localStorage.removeItem(`upschool-token`);
			}
		},
		async logout({ commit }) {
			try {
				await axios.post("auth/logout");
				localStorage.removeItem(`upshool-token`);
				commit("openSnackbar", "Logged out successfully!");
			} catch (error) {
				console.log(error);
			}
		},
		async getUser({ state }) {
			let res = await axios.post("auth/me");
			console.log(res.data);

			state.loggedInUser = res.data.user;
			// return res.data.user;
		},
		async getUserEvents({}, id) {
			let body = { user_id: id };
			let res = await axios.post("user-event", body);
			console.log(res.data);
			return res.data.data;
		},
		async getUserSchedule() {
			let res = await axios.get("schedule");
			console.log(res.data);

			return res.data;
		},
		async getColleges({ state }) {
			let res = await axios.get("college");
			console.log(res.data);
			state.colleges = res.data.data;
		},
		async getDepartments({ state }) {
			let res = await axios.get("department");
			console.log(res.data);
			state.departments = res.data.data;
		},
		async getPrograms({ state }) {
			let res = await axios.get("program");
			console.log(res.data);
			state.programs = res.data.data;
		},
		async getStudents({ state }) {
			let res = await axios.get("student");
			console.log(res.data);
			state.students = res.data.data;
			return res.data;
		},
		async getSchoolAssessments({ state }, course_id) {
			let res = await axios.get(
				`school-assessment?course_id=${course_id}`
			);
			console.log(res.data);
			state.schoolAssessments = res.data.data;
			return res.data;
		},
		async getAllSchoolAssessments({ state }) {
			let res = await axios.get(`school-assessment`);

			console.log(res.data);

			state.schoolAssessments = res.data.data;
			return res.data;
		},
		async getStaff({ state }) {
			let res = await axios.get("staff");
			console.log(res.data);
			state.staff = res.data.data;
		},
		async getFacilitatedCourses({ state }, id) {
			try {
				let res = await axios.get(
					`courses-facilitators?staff_id=${id}`
				);
				console.log(res.data);

				state.facilitated = res.data.data;
			} catch (error) {
				console.log(eror);
			}
		},
		async getCourseParticipants({}, id) {
			try {
				let res = await axios.get(`courses/${id}/participants`);
				console.log(res.data);
				return res.data;
			} catch (error) {
				console.log(error);
			}
		},
		async getNews({ state }) {
			let res = await axios.get("news");
			console.log(res.data);
			state.news = res.data.data;
		},
		async getSchoolEvents({ state }) {
			let res = await axios.get("school-event");
			console.log(res.data);
			state.schoolEvents = res.data.data;
			return res.data;
		},

		async getCourseStatus({ state }) {
			let res = await axios.get("course-status");

			state.course_statuses = res.data.data;
		},
		async getEnrolledCourses({ state }) {
			let body = {
				student_id: state.loggedInUser.matric_number,
			};

			let res = await axios.post(`enroll/courses`, body);
			console.log(res.data);
			state.enrollments = res.data.data;
		},
		async getCurrentEnrollment({ state }, id) {
			let body = {
				student_id: id,
				semester_id: state.currentAcademicSession.semester.id,
			};
			let res = await axios.post("enroll/student-latest", body);
			console.log(res.data);
			return res.data.data;
		},
		async getEnrollableItems({}, id) {
			let res = await axios.get(`curriculum-block-student/${id}`);
			console.log(res.data);
			return res.data;
		},
		async getStudentEnrollments({}, id) {
			let body = { student_id: id };
			let res = await axios.post("enroll/student", body);

			console.log(res.data);

			return res.data.data;
		},
		async enrollCourses({ state }) {
			let arr = [];

			state.selectedCourses.forEach((item) => {
				arr.push(item.id);
			});

			let body = {
				ids: JSON.stringify(arr),
				student_id: state.loggedInUser.id,
			};

			let res = await axios.post("enroll", body);

			console.log(res.data);

			return res.data;
		},
		async addAndDrop({}, payload) {
			let body = {
				ids: JSON.stringify(payload),
				// student_id: 1
				student_id: this.state.loggedInUser.id,
			};

			let res = await axios.post("add-and-drop", body);

			return res.data;
		},
		async approveEnrollment({}, id) {
			try {
				let body = { enrollment_id: id };
				let res = await axios.patch("enroll", body);

				return res.data;
			} catch (error) {
				console.log(error);
			}
		},
		async getStudentResults({ state }, student_id) {
			let id = state.loggedInUser ? state.loggedInUser.id : student_id;
			let res = await axios.get(`result/${id}`);

			console.log(res.data);

			return res.data.data;
		},
		async getCourseSection({}, id) {
			let res = await axios.get(`course-section/${id}`);

			console.log(res.data);

			return res.data.data;
		},
		async getAllCourses({ state }) {
			let res = await axios.get("courses");
			console.log(res.data);
			state.courses = res.data.data;
		},
		async getCourseById({}, id) {
			let res = await axios.get(`courses/${id}`);
			return res.data.data;
		},
		async getCurricula({}, id) {
			let res = await axios.get(`curriculum-block/${id}`);
			console.log(res.data);
			return res.data.data;
		},
		async saveBulkCourses({ dispatch }, payload) {
			let body = { data: JSON.stringify(payload) };
			let res = await axios.post("bulk/courses", body);
			if (res.data.status) {
				dispatch("getAllCourses");
			}
			console.log(res.data);
			return res.data;
		},
		async uploadSchoolAssessment({ commit }, payload) {
			let res = await axios.post("school-assessment-upload", payload);
			commit("openSnackbar", res.data.message);
			return res.data;
		},
		async getCourseGradelist({}, id) {
			let res = await axios.get(`gradelist?course_id=${id}`);
			console.log(res.data);
			return res.data;
		},
		async saveCourseGradelist({ commit }, body) {
			let res = await axios.post(`gradelist`, body);
			console.log(res.data);
			commit("openSnackbar", res.data.message);
			return res.data;
		},
		async saveCourseSection({ commit }, body) {
			let res = await axios.post("course-section", body);

			if (res.data.status) {
				commit("openSnackbar", res.data.message);
			}

			return res.data;
		},
		async addCourseToCurriculum({}, payload) {
			let res = await axios.post(
				`curriculum-item/${payload.blockId}`,
				payload.body
			);
			console.log(res.data);
			return res.data;
		},
		async getCurrentAcademicSession({ state }) {
			let res = await axios.get("academic-session-current");
			console.log(res.data);
			state.currentAcademicSession = res.data.data;
		},
		async getAdvisees({ state }) {
			let res = await axios.get(
				`staff-advisees?staff_id=${state.loggedInUser.id}`
			);
			console.log(res.data);
			return res.data;
		},
		async testEcho({}) {
			try {
				let res = await axios.post("message", { body: "yoooo" });

				console.log(res.data);
			} catch (error) {
				console.log(error);
			}
		},
		setupDashboard({ dispatch }) {
			dispatch("getStudents");
			dispatch("getStaff");
			dispatch("getDepartments");
			dispatch("getColleges");
			dispatch("getNews");
		},
	},
});
