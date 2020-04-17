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
					<v-card class="pa-3" flat min-height="600px">
						<v-tabs>
							<v-tab>
								<v-icon left>mdi-lock</v-icon>CURRENT ENROLLMENT
							</v-tab>
							<v-tab>
								<v-icon left>mdi-lock</v-icon>ENROLLMENT HISTORY
							</v-tab>

							<v-tab-item>
								<v-card flat>
									<div
										class="d-flex flex-lg-row flex-column justify-space-between align-center"
									>
										<v-subheader
											class="ml-3 font-weight-bold"
											>{{
												academicSession.title +
													" | " +
													semester.name
											}}</v-subheader
										>
										<div
											class="d-flex flex-lg-row flex-column align-center"
										>
											<div>
												<v-subheader
													class="fs-5 font-weight-bold"
													>MAX REGISTERABLE:
													28</v-subheader
												>
											</div>
											<v-btn
												class="mx-2"
												color="primary"
												v-if="
													settings.canEnroll &&
														!isAddingAndDropping
												"
												outlined
												@click="enroll"
												>{{
													isEnrolling
														? "DONE"
														: "ENROLL COURSES"
												}}</v-btn
											>
											<v-btn
												color="primary"
												v-if="
													settings.canAddAndDrop &&
														!isEnrolling
												"
												outlined
												@click="addAndDrop"
												>{{
													isAddingAndDropping
														? "DONE"
														: "ADD/DROP"
												}}</v-btn
											>
										</div>
									</div>

									<div v-if="isEnrolling">
										<v-card-text>
											<div
												class="d-flex justify-space-between"
											>
												<v-subheader
													>APPROVAL STATUS:
													{{
														currentEnrollment
															? currentEnrollment.approval_status
															: "Unapproved"
													}}</v-subheader
												>
												<div
													class="fs-2 font-italic font-weight-light"
												>
													{{ totalUnitsSelected }}
													units selected
												</div>
												<!-- <div
													class="d-flex align-center"
												>
													<v-subheader
														class="pa-0 fs-5 font-weight-bold"
														>TOTAL UNITS REGISTERED:
														{{
															courses.reduce(
																(acc, val) => {
																	return (
																		acc +
																		val.credit_unit
																	);
																},
																0
															)
														}}</v-subheader
													>
													<v-btn
														color="success"
														icon
														@click="editCourses"
													>
														<v-icon
															size="18"
															color="grey"
															>mdi-pencil</v-icon
														>
													</v-btn>
												</div> -->
											</div>
											<div
												v-for="curriculumItem in enrollableItems.filter(
													it =>
														it.level == level &&
														it.curriculum_items
															.length > 0
												)"
												:key="curriculumItem.id"
											>
												<curriculum-table
													:isEnrolling="isEnrolling"
													:selectedCourses="
														selectedCourses
													"
													:level="`${level}`"
													:status="
														curriculumItem.status
													"
													:curriculumItem="
														curriculumItem
													"
												/>
											</div>

											<!-- <v-data-table
												v-model="selectedCourses"
												:headers="enrollableHeaders"
												:items="enrollableItems"
												:show-select="true"
												hide-default-footer
											></v-data-table> -->
										</v-card-text>
									</div>
									<div
										v-if="
											!isEnrolling && !isAddingAndDropping
										"
									>
										<v-card-text v-if="currentEnrollment">
											<div
												class="d-flex justify-space-between"
											>
												<v-subheader
													>APPROVAL STATUS:
													{{
														currentEnrollment.approval_status
															? "Approved"
															: "Pending"
													}}</v-subheader
												>
												<div
													class="d-flex align-center"
												>
													<v-subheader
														class="pa-0 fs-5 font-weight-bold"
														>TOTAL UNITS REGISTERED:
														{{
															currentEnrollment.curriculum_items.reduce(
																(acc, val) => {
																	return (
																		acc +
																		val.credit_unit
																	);
																},
																0
															)
														}}</v-subheader
													>
												</div>
											</div>
											<v-data-table
												:headers="enrollmentHeaders"
												:items="
													currentEnrollment.curriculum_items
												"
												hide-default-footer
											></v-data-table>
										</v-card-text>
										<v-card-text
											v-if="!currentEnrollment"
											class="text-center py-5"
										>
											<h2>
												You are yet to enroll for this
												semester
											</h2>
										</v-card-text>
									</div>
									<div>
										<v-card-text>
											<div
												class="d-flex justify-space-between"
											>
												<v-subheader
													>PENDING
													COURSES</v-subheader
												>
												<div
													class="d-flex align-center"
												>
													<v-subheader
														class="pa-0 fs-5 font-weight-bold"
														>TOTAL UNITS PENDING:
														{{ 5 }}</v-subheader
													>
													<v-btn
														color="success"
														icon
														@click="
															editPendingCourses
														"
													>
														<v-icon
															size="18"
															color="grey"
															>mdi-pencil</v-icon
														>
													</v-btn>
												</div>
											</div>

											<v-data-table
												v-model="selectedPendingCourses"
												:headers="pendingHeaders"
												:items="pendingItems"
												@item-selected="selectItem"
												class="elevation-1"
												:show-select="
													isEnrolling ||
														isAddingAndDropping
												"
												hide-default-footer
											>
												<template
													v-slot:header.data-table-select
												>
													<div></div>
												</template>
												<template
													v-slot:item.status="{
														item
													}"
												>
													<!-- <div class="d-flex mt-4 justify-end">
														<div class="fs-3 mr-4 font-weight-bold">GPA: 4.94</div>
														<div class="fs-3 font-weight-bold">CGPA: 4.96</div>
														</div>-->
													<v-chip small>
														<div
															class="white--text px-3 fs-5 d-flex justify-center text-center text-uppercase"
														>
															{{ item.status }}
														</div>
													</v-chip>
												</template>
											</v-data-table>
										</v-card-text>
									</div>
								</v-card>
							</v-tab-item>
							<v-tab-item>
								<v-card
									flat
									v-for="items in enrollments"
									:key="items.id"
								>
									<v-card-text>
										<div class="text-bold">
											{{ items.semester.name }}
										</div>
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
		<div>
			<v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
				{{ snackbar.text }}
				<v-btn color="blue" text @click="snackbar.isActive - false"
					>Close</v-btn
				>
			</v-snackbar>
		</div>
	</v-app>
</template>

<script>
import CurriculumTable from "@/components/general/CurriculumItem";

export default {
	components: { CurriculumTable },
	data() {
		return {
			tab: null,
			snackbar: {
				isActive: false,
				text: "",
				timeout: 3000
			},
			isStudent: false,
			selectedCourses: [],
			pendingSelected: [],
			awaitingApprovalCourses: [],
			showPendingSelect: false,
			showEdit: false,
			showAwaiting: false,
			isEnrolling: false,
			isAddingAndDropping: false,
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
			// courses: [
			// 	{
			// 		name: "CST111",
			// 		calories:
			// 			"Use of Library, Study Skills and Information Communication Technology I",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 4.0,
			// 		iron: "1%"
			// 	},
			// 	{
			// 		name: "GEC117",
			// 		calories: "Technical Drawing",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 4.3,
			// 		iron: "1%"
			// 	},
			// 	{
			// 		name: "MAT111",
			// 		calories: "Mathematics I: Algebra",
			// 		credit_unit: 3.0,
			// 		carbs: "ALPHA",
			// 		protein: 6.0,
			// 		iron: "7%"
			// 	},
			// 	{
			// 		name: "MAT112",
			// 		calories: "Mathematics II: Trigonometry and Geometry",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 4.3,
			// 		iron: "8%"
			// 	},
			// 	{
			// 		name: "PHY111",
			// 		calories: "Mechanics and Properties of Matter",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 3.9,
			// 		iron: "16%"
			// 	},
			// 	{
			// 		name: "PHY112",
			// 		calories: "Heat, Sound and Optics",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 0.0,
			// 		iron: "0%"
			// 	},
			// 	{
			// 		name: "PHY119",
			// 		calories: "Physics Practicals IA",
			// 		credit_unit: 1.0,
			// 		carbs: "OMEGA",
			// 		protein: 0,
			// 		iron: "2%"
			// 	},
			// 	{
			// 		name: "CHM111",
			// 		calories: "General Physical Chemistry",
			// 		credit_unit: 3.0,
			// 		carbs: "OMEGA",
			// 		protein: 6.5,
			// 		iron: "45%"
			// 	},
			// 	{
			// 		name: "CHM119",
			// 		calories: "General Chemistry Practical I",
			// 		credit_unit: 1.0,
			// 		carbs: "OMEGA",
			// 		protein: 4.9,
			// 		iron: "22%"
			// 	},
			// 	{
			// 		name: "EDS111",
			// 		calories: "Entrepreneurial DevelopmentStudies I",
			// 		credit_unit: 1.0,
			// 		carbs: "OMEGA",
			// 		protein: 7,
			// 		iron: "6%"
			// 	},
			// 	{
			// 		name: "TMC111",
			// 		calories: "Total Man Concept I",
			// 		credit_unit: 1.0,
			// 		carbs: "ALPHA",
			// 		protein: 7,
			// 		iron: "6%"
			// 	},
			// 	{
			// 		name: "TMC112",
			// 		calories: "Total Man Concept - Sports",
			// 		credit_unit: 0.0,
			// 		carbs: "ALPHA",
			// 		protein: 7,
			// 		iron: "6%"
			// 	},
			// 	{
			// 		name: "GST111",
			// 		calories: "Communication in English",
			// 		credit_unit: 2.0,
			// 		carbs: "ALPHA",
			// 		protein: 7,
			// 		iron: "6%"
			// 	}
			// ],
			enrollableItems: [],
			enrollableHeaders: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "curriculumable.course_code"
				},
				{ text: "COURSE TITLE", value: "curriculumable.title" },
				{ text: "CREDIT UNIT", value: "credit_unit" },
				{
					text: "COURSE STATUS",
					value: "curriculum_block.status.short_name"
				}
			],
			pendingHeaders: [
				{
					text: "COURSE CODE",
					align: "start",
					sortable: false,
					value: "curriculum_item.curriculumable.course_code"
				},
				{
					text: "COURSE TITLE",
					value: "curriculum_item.curriculumable.title"
				},
				{ text: "CREDIT UNIT", value: "curriculum_item.credit_unit" },
				{
					text: "COURSE STATUS",
					value: "curriculum_item.curriculum_block.status.short_name"
				},
				{ text: "STATUS", value: "status" },
				{
					text: " SEMESTER",
					value:
						"curriculum_item.curriculumable.semester_type.short_title"
				}
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
			selectedPendingCourses: [],
			//status ? 1 = completed/passed, 2 = dropped, 3 = failed
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
				{
					text: "COURSE STATUS",
					value: "curriculum_block.status.short_name"
				}
			],
			enrollments: [],
			pendingItems: [],
			currentEnrollment: null
		};
	},
	computed: {
		academicSession() {
			return this.$store.state.currentAcademicSession.session;
		},
		semester() {
			return this.$store.state.currentAcademicSession.semester;
		},
		settings() {
			return this.$store.state.settings;
		},
		level() {
			return this.$store.state.loggedInUser.level;
		},
		totalUnitsSelected() {
			return this.$store.state.selectedCourses.reduce((acc, val) => {
				return acc + val.credit_unit;
			}, 0);
		},
		pendingItemsSelected() {
			return this.selectedPendingCourses.reduce((acc, val) => {
				return acc + val.credit_unit;
			}, 0);
		}
	},
	methods: {
		async saveEnrolled() {
			console.log(this.$store.state.selectedCourses);
			try {
				let res = await this.$store.dispatch("enrollCourses");
				if (res.status) {
					this.snackbar.isActive = true;
					this.snackbar.text = res.message;
					this.getCurrentEnrollment();
				} else {
					this.snackbar.isActive = true;
					this.snackbar.text = res.message;
				}
			} catch (error) {
				console.log(error);
			}
		},
		enroll() {
			if (
				this.$store.state.selectedCourses.length <= 0 &&
				this.isEnrolling
			) {
				alert("You need to select courses to enroll");
				return;
			}
			if (this.isEnrolling) {
				this.saveEnrolled();
			}
			this.isEnrolling = !this.isEnrolling;
		},
		addAndDrop() {
			this.isAddingAndDropping = !this.isAddingAndDropping;
		},
		getColor(val) {
			if (val == 1) return "green accent-3";
			else if (val == 2) return "blue accent-4";
			else if (val == 3) return "red accent-2";
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
		},
		selectItem(v) {
			let totalRegisterable = 7;
			// let minRequired = this.totalUnits || 0;

			if (v.value) {
				if (
					this.totalUnitsSelected +
						v.item.curriculum_item.credit_unit >
					totalRegisterable
				) {
					v.value = false;
					this.selectedPendingCourses.splice(
						this.selectedPendingCourses.indexOf(v.item),
						-1
					);
					alert("You have exceeded the maximum registrable units");

					return;
				}
				if (
					this.totalUnitsSelected +
						v.item.curriculum_item.credit_unit <=
					totalRegisterable
				) {
					if (
						!(
							this.$store.state.selectedCourses.filter(
								el => el.id == v.item.curriculum_item.id
							).length > 0
						)
					) {
						this.$store.state.selectedCourses.push(
							v.item.curriculum_item
						);
					}
				}
			} else {
				if (
					this.$store.state.selectedCourses.filter(
						el => el.id == v.item.curriculum_item.id
					).length > 0
				) {
					this.$store.state.selectedCourses.splice(
						this.$store.state.selectedCourses.indexOf(
							v.item.curriculum_item
						),
						1
					);
				}
			}
		},
		async getCurrentEnrollment() {
			try {
				let data = await this.$store.dispatch(
					"getCurrentEnrollment",
					this.semester.id
				);
				this.currentEnrollment = data;
			} catch (error) {
				console.log(error);
			}
		},
		async getEnrollableItems() {
			try {
				let res = await this.$store.dispatch("getEnrollableItems");

				this.enrollableItems = res.data;
				this.pendingItems = res.pending;
			} catch (error) {
				console.log(error);
			}
		},
		async getEnrollmentHistory() {
			try {
				let data = await this.$store.dispatch("getStudentEnrollments");
				this.enrollments = data;
			} catch (error) {
				console.log(error);
			}
		}
		// async getCurricula() {
		// 	try {
		// 		let id = this.$store.loggedInUser.program.id;
		// 		this.curricula = await this.$store.dispatch("getCurricula", id);
		// 	} catch (error) {
		// 		console.log(error);
		// 	}
		// }
	},
	watch: {
		selectedCourses(v) {
			console.log(v);
		}
	},
	async mounted() {
		try {
			await this.$store.dispatch("getCurrentAcademicSession");
			this.getCurrentEnrollment();
			this.getEnrollableItems();
			this.getEnrollmentHistory();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
