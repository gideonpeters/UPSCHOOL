<template>
	<v-app>
		<!-- <v-card flat class="pa-3 transparent">
			<v-tabs v-model="tab" background-color="transparent">
				<v-tab v-for="item in items" :key="item.id">{{ item.tab }}</v-tab>
			</v-tabs>

			<v-tabs-items v-model="tab">
				<v-tab-item v-for="(item, ix) in items" :key="ix">
					<v-container fluid class="pa-0">
						<v-row>
							<v-col cols="12">
								<div class="d-flex justify-end">
									<v-btn depressed class="primary">EDIT</v-btn>
								</div>
							</v-col>
							
							<v-col cols="8">
								<v-card flat class="pa-3">
									<v-subheader>CURRENT COURSES</v-subheader>
								</v-card>

								<v-card flat class="pa-3 mt-5">
									<v-subheader>PENDING COURSES</v-subheader>
								</v-card>

								<v-card flat class="pa-3 mt-5">
									<v-subheader>FAILED COURSES</v-subheader>
								</v-card>
							</v-col>
						</v-row>
					</v-container>
				</v-tab-item>
			</v-tabs-items>
		</v-card>-->
		<v-container fluid class="pa-0">
			<v-row>
				<!-- <v-col cols="4">
					<v-card class="pa-3" flat>
						<v-subheader class="pa-0">Courses</v-subheader>
						<div>
							<div class="font-weight-medium grey--text fs-3">2018/2019 Session</div>
							<div class="fs-4">Introduction to Embedded Systems and Microcontroller designs and concepts</div>
						</div>
					</v-card>
				</v-col>-->
				<v-col>
					<v-card class="pa-3" flat>
						<v-tabs>
							<v-tab>
								<v-icon left>mdi-lock</v-icon>CURRENT ENROLLMENT
							</v-tab>
							<v-tab>
								<v-icon left>mdi-lock</v-icon>ENROLLMENT HISTORY
							</v-tab>

							<v-tab-item>
								<v-card flat>
									<div class="d-flex justify-space-between align-center">
										<v-subheader class="ml-3 font-weight-bold">2018/2019 SESSION</v-subheader>
										<div class="d-flex flex-lg-row flex-column align-center">
											<v-subheader class="fs-5 font-weight-bold">MAX REGISTERABLE: 28</v-subheader>
											<v-btn
												color="primary"
												outlined
												@click="isEnrolling = !isEnrolling"
											>{{ isEnrolling ? 'DONE' : 'ENROLL COURSES'}}</v-btn>
										</div>
									</div>

									<div v-if="isEnrolling">
										<v-card-text>
											<div class="d-flex justify-space-between">
												<v-subheader>APPROVAL STATUS: Approved</v-subheader>
												<div class="d-flex align-center">
													<v-subheader
														class="pa-0 fs-5 font-weight-bold"
													>TOTAL UNITS REGISTERED: {{courses.reduce((acc, val) => {return acc + val.credit_unit}, 0)}}</v-subheader>
													<v-btn color="success" icon @click="editCourses">
														<v-icon size="18" color="grey">mdi-pencil</v-icon>
													</v-btn>
												</div>
											</div>

											<v-data-table
												v-model="selectedCourses"
												:headers="headers"
												:items="courses"
												:show-select="showEdit"
												:items-per-page="10"
												hide-default-footer
											></v-data-table>
										</v-card-text>

										<div>
											<v-card-text>
												<div class="d-flex justify-space-between">
													<v-subheader>PENDING COURSES</v-subheader>
													<div class="d-flex align-center">
														<v-subheader
															class="pa-0 fs-5 font-weight-bold"
														>TOTAL UNITS PENDING: {{pendingCourses.reduce((acc, val) => {return acc + val.credit_unit}, 0)}}</v-subheader>
														<v-btn color="success" icon @click="editPendingCourses">
															<v-icon size="18" color="grey">mdi-pencil</v-icon>
														</v-btn>
													</div>
												</div>

												<v-data-table
													v-model=" pendingCourses "
													:headers="pendingHeaders"
													:items="pendingCourses"
													:show-select="showPendingSelect"
													:items-per-page="10"
													hide-default-footer
												>
													<template v-slot:item.status="{item}">
														<!-- <div class="d-flex mt-4 justify-end">
														<div class="fs-3 mr-4 font-weight-bold">GPA: 4.94</div>
														<div class="fs-3 font-weight-bold">CGPA: 4.96</div>
														</div>-->
														<v-chip :color="getColor(item.status)" small>
															<div
																class="white--text px-3 fs-5 d-flex justify-center text-center text-uppercase"
															>{{getStatus(item.status)}}</div>
														</v-chip>
													</template>
												</v-data-table>
											</v-card-text>
										</div>
									</div>
									<div v-else>
										<v-card-text>
											<div class="d-flex justify-space-between">
												<v-subheader>APPROVAL STATUS: {{currentEnrollment.approval_status ? 'Approved': 'Pending'}}</v-subheader>
												<!-- <div class="d-flex align-center">
													<v-subheader
														class="pa-0 fs-5 font-weight-bold"
													>TOTAL UNITS REGISTERED: {{courses.reduce((acc, val) => {return acc + val.credit_unit}, 0)}}</v-subheader>
													<v-btn color="success" icon @click="editCourses">
														<v-icon size="18" color="grey">mdi-pencil</v-icon>
													</v-btn>
												</div>-->
											</div>
											<v-data-table
												:headers="enrollmentHeaders"
												:items="currentEnrollment.curriculum_items"
												hide-default-footer
											></v-data-table>
										</v-card-text>
									</div>
								</v-card>
							</v-tab-item>
							<v-tab-item>
								<v-card flat v-for="items in enrollments" :key="items.id">
									<v-card-text>
										<div class="text-bold">{{ items.semester.name }}</div>
										<v-data-table
											:headers="enrollmentHeaders"
											:items="items.curriculum_items"
											hide-default-footer
										></v-data-table>
									</v-card-text>
								</v-card>
							</v-tab-item>
						</v-tabs>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			tab: null,
			isStudent: false,
			selectedCourses: [],
			pendingSelected: [],
			awaitingApprovalCourses: [],
			showPendingSelect: false,
			showEdit: false,
			showAwaiting: false,
			isEnrolling: false,
			items: [
				{ id: 1, tab: "OVERVIEW" },
				{ id: 2, tab: "EDIT" },
				{ id: 3, tab: "HISTORY" }
			],
			asgnHeaders: [
				{ text: "COURSE CODE ", value: "course_code", sortable: false },
				{
					text: "TOPIC",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "WEIGHT", value: "weight", sortable: false },
				{ text: "DUE DATE", value: "time", sortable: false },
				{ text: "ACTIONS", value: "action", sortable: false }
			],
			asgn: [
				{
					id: 1,
					course_code: "GST411",
					name: "GST111: Communications in English Language",
					time: "Nov 26, 2020",
					weight: "10%"
				},
				{
					id: 2,
					course_code: "EIE411",
					name: "EIE517: applied Electronics",
					time: "June 26, 2020",
					weight: "20%"
				},
				{
					id: 3,
					course_code: "CEN411",
					name: "Report on the 8051 micro controller",
					time: "Mar 31, 2020",
					weight: "20%"
				}
			],
			text:
				"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
			headers: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "COURSE TITLE", value: "calories" },
				{ text: "CREDIT UNIT", value: "credit_unit" },
				{ text: " SEMESTER", value: "carbs" }
				// { text: "GRADE SCORE", value: "carbs" },
				// { text: "WEIGHTED SCORE", value: "protein" }
			],
			// currentEnrollment: [],
			courses: [
				{
					name: "CST111",
					calories:
						"Use of Library, Study Skills and Information Communication Technology I",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.0,
					iron: "1%"
				},
				{
					name: "GEC117",
					calories: "Technical Drawing",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					iron: "1%"
				},
				{
					name: "MAT111",
					calories: "Mathematics I: Algebra",
					credit_unit: 3.0,
					carbs: "ALPHA",
					protein: 6.0,
					iron: "7%"
				},
				{
					name: "MAT112",
					calories: "Mathematics II: Trigonometry and Geometry",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					iron: "8%"
				},
				{
					name: "PHY111",
					calories: "Mechanics and Properties of Matter",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 3.9,
					iron: "16%"
				},
				{
					name: "PHY112",
					calories: "Heat, Sound and Optics",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 0.0,
					iron: "0%"
				},
				{
					name: "PHY119",
					calories: "Physics Practicals IA",
					credit_unit: 1.0,
					carbs: "OMEGA",
					protein: 0,
					iron: "2%"
				},
				{
					name: "CHM111",
					calories: "General Physical Chemistry",
					credit_unit: 3.0,
					carbs: "OMEGA",
					protein: 6.5,
					iron: "45%"
				},
				{
					name: "CHM119",
					calories: "General Chemistry Practical I",
					credit_unit: 1.0,
					carbs: "OMEGA",
					protein: 4.9,
					iron: "22%"
				},
				{
					name: "EDS111",
					calories: "Entrepreneurial DevelopmentStudies I",
					credit_unit: 1.0,
					carbs: "OMEGA",
					protein: 7,
					iron: "6%"
				},
				{
					name: "TMC111",
					calories: "Total Man Concept I",
					credit_unit: 1.0,
					carbs: "ALPHA",
					protein: 7,
					iron: "6%"
				},
				{
					name: "TMC112",
					calories: "Total Man Concept - Sports",
					credit_unit: 0.0,
					carbs: "ALPHA",
					protein: 7,
					iron: "6%"
				},
				{
					name: "GST111",
					calories: "Communication in English",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 7,
					iron: "6%"
				}
			],
			pendingHeaders: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "COURSE TITLE", value: "calories" },
				{ text: "CREDIT UNIT", value: "credit_unit" },
				{ text: "STATUS", value: "status" },
				{ text: " SEMESTER", value: "carbs" }
				// { text: "WEIGHTED SCORE", value: "protein" }
			],
			awaitingHeaders: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "COURSE TITLE", value: "calories" },
				{ text: "CREDIT UNIT", value: "credit_unit" },
				{ text: "ACTION", value: "action" },
				{ text: " SEMESTER", value: "carbs" }
				// { text: "WEIGHTED SCORE", value: "protein" }
			],
			//status ? 1 = completed/passed, 2 = dropped, 3 = failed
			pendingCourses: [
				{
					id: 1,
					name: "CST121",
					calories:
						"Use of Library, Study Skills and Information Communication Technology II",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.0,
					status: 2,
					iron: "1%"
				},
				{
					id: 2,
					name: "GEC117",
					calories: "Technical Drawing",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					status: 2,
					iron: "1%"
				},
				{
					id: 3,
					name: "MAT111",
					calories: "Mathematics I: Algebra",
					credit_unit: 3.0,
					carbs: "ALPHA",
					protein: 6.0,
					status: 3,

					iron: "7%"
				},
				{
					id: 4,
					name: "MAT112",
					calories: "Mathematics II: Trigonometry and Geometry",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					status: 2,
					iron: "8%"
				},
				{
					id: 5,
					name: "PHY111",
					calories: "Mechanics and Properties of Matter",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 3.9,
					status: 2,
					iron: "16%"
				},
				{
					id: 6,
					name: "PHY112",
					calories: "Heat, Sound and Optics",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 0.0,
					status: 3,
					iron: "0%"
				}
			],
			awaitingCourses: [
				{
					id: 1,
					name: "CST121",
					calories:
						"Use of Library, Study Skills and Information Communication Technology II",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.0,
					action: "Drop",
					status: 2,
					iron: "1%"
				},
				{
					id: 2,
					name: "GEC117",
					calories: "Technical Drawing",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					action: "Drop",
					status: 2,
					iron: "1%"
				},
				{
					id: 3,
					name: "MAT111",
					calories: "Mathematics I: Algebra",
					credit_unit: 3.0,
					carbs: "ALPHA",
					protein: 6.0,
					action: "Register",
					status: 3,
					iron: "7%"
				},
				{
					id: 4,
					name: "MAT112",
					calories: "Mathematics II: Trigonometry and Geometry",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 4.3,
					action: "Drop",
					status: 2,
					iron: "8%"
				},
				{
					id: 5,
					name: "PHY111",
					calories: "Mechanics and Properties of Matter",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 3.9,
					action: "Register",
					status: 2,
					iron: "16%"
				},
				{
					id: 6,
					name: "PHY112",
					calories: "Heat, Sound and Optics",
					credit_unit: 2.0,
					carbs: "ALPHA",
					protein: 0.0,
					action: "Register",
					status: 3,
					iron: "0%"
				}
			],
			enrollmentHeaders: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "curriculumable.course_code"
				},
				{ text: "COURSE TITLE", value: "curriculumable.title" },
				{ text: "CREDIT UNIT", value: "credit_unit" },
				{ text: "COURSE STATUS", value: "status.short_name" }
			],
			enrollments: [
				// { text: " SEMESTER", value: "carbs" }
			]
		};
	},
	computed: {
		currentEnrollment() {
			return this.enrollments[0];
		}
	},
	methods: {
		getColor(val) {
			if (val == 1) return "green accent-3";
			else if (val == 2) return "blue accent-4";
			else if (val == 3) return "red accent-2";
			else return "green";
		},
		getStatus(val) {
			if (val == 1) return "Completed";
			else if (val == 2) return "Dropped";
			else if (val == 3) return "Failed";
			else return "green";
		},
		editCourses() {
			this.showPendingSelect = false;
			this.showAwaiting = false;
			this.showEdit = true;
		},
		editPendingCourses() {
			this.showEdit = false;
			this.showAwaiting = false;
			this.showPendingSelect = true;
		},
		editAwaitingCourses() {
			this.showEdit = false;
			this.showPendingSelect = false;
			this.showAwaiting = true;
		}
	},
	async mounted() {
		try {
			this.enrollments = await this.$store.dispatch(
				"getStudentEnrollments"
			);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>