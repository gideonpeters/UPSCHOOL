<template>
	<div>
		<v-container fluid class="pa-0">
			<v-row>
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
									<div class="d-flex flex-lg-row flex-column justify-space-between align-center">
										<v-subheader class="ml-3 font-weight-bold">
											{{
											academicSession.title +
											" | " +
											semester.name
											}}
										</v-subheader>
										<div class="d-flex flex-lg-row flex-column align-center">
											<div>
												<v-subheader class="fs-5 font-weight-bold">
													MAX REGISTERABLE:
													28
												</v-subheader>
											</div>
											<v-btn
												class="mx-2"
												color="primary"
												v-if="
													settings.canEnroll &&
														isStaff && !currentEnrollment.approval_status
												"
												outlined
												@click="approveEnrollment"
											>
												{{
												isStaff
												? "APPROVE"
												: ''
												}}
											</v-btn>
											<v-btn
												class="mx-2"
												color="primary"
												v-if="
													settings.canEnroll && isStudent &&
														!isAddingAndDropping && !currentEnrollment
												"
												outlined
												@click="enroll"
											>
												{{
												isEnrolling
												? "DONE"
												: "ENROLL COURSES"
												}}
											</v-btn>
											<v-btn
												color="primary"
												v-if="
													settings.canAddAndDrop &&
														!isEnrolling
												"
												outlined
												@click="addAndDrop"
											>
												{{
												isAddingAndDropping
												? "DONE"
												: "ADD/DROP"
												}}
											</v-btn>
										</div>
									</div>

									<div v-if="isEnrolling">
										<v-card-text>
											<div class="d-flex justify-space-between">
												<v-subheader>
													APPROVAL STATUS:
													{{
													currentEnrollment
													? currentEnrollment.approval_status
													: "Unapproved"
													}}
												</v-subheader>
												<div class="fs-2 font-italic font-weight-light">
													{{ totalUnitsSelected }}
													units selected
												</div>
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
													:isLoadingCurrent="isLoadingCurrent"
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
											></v-data-table>-->
										</v-card-text>
									</div>
									<div v-if="
											!isEnrolling && !isAddingAndDropping
										">
										<v-card-text v-if="currentEnrollment">
											<div class="d-flex justify-space-between">
												<v-subheader>
													APPROVAL STATUS:
													{{
													currentEnrollment.approval_status
													? "Approved"
													: "Pending"
													}}
												</v-subheader>
												<div class="d-flex align-center" v-if="currentEnrollment.curriculum_items">
													<v-subheader class="pa-0 fs-5 font-weight-bold">
														TOTAL UNITS REGISTERED:
														{{
														currentEnrollment.curriculum_items.reduce(
														(acc, val) => {
														acc +
														val.credit_unit
														},
														0
														)
														}}
													</v-subheader>
												</div>
											</div>
											<v-card>
												<v-data-table
													:headers="enrollmentHeaders"
													:items="
													currentEnrollment.curriculum_items
												"
													hide-default-footer
												></v-data-table>
											</v-card>
										</v-card-text>
										<v-card-text v-if="!currentEnrollment" class="text-center py-5">
											<h2>
												You are yet to enroll for this
												semester
											</h2>
										</v-card-text>
									</div>
									<v-card-text v-if="isAddingAndDropping" class="text-center py-5">
										<v-card>
											<v-data-table
												:headers="addAndDropHeaders"
												:items="
													selectedAfterAdding
												"
												hide-default-footer
											>
												<template v-slot:item.actions="{item
														
													}">
													<v-btn icon color="grey darken-3" @click="dropCourse(item)">
														<v-icon>mdi-arrow-down</v-icon>
													</v-btn>
												</template>
											</v-data-table>
										</v-card>
									</v-card-text>
									<div v-if="isAddingAndDropping">
										<v-card-text>
											<div class="d-flex justify-space-between">
												<v-subheader>
													PENDING
													COURSES
												</v-subheader>
												<div class="d-flex align-center">
													<v-subheader class="pa-0 fs-5 font-weight-bold">
														TOTAL UNITS PENDING:
														{{ pendingUnits }}
													</v-subheader>
													<v-btn color="success" icon @click="
															editPendingCourses
														">
														<v-icon size="18" color="grey">mdi-pencil</v-icon>
													</v-btn>
												</div>
											</div>

											<v-data-table
												:headers="pendingHeaders"
												:loading="isLoadingPending"
												loading-text="Loading... Please wait"
												:items="pendingAddableItems"
												@item-selected="selectItem"
												class="elevation-1"
												:show-select="
													isEnrolling
												"
												hide-default-footer
											>
												<template v-slot:header.data-table-select>
													<div></div>
												</template>
												<template v-slot:item.status="{
														item
													}">
													<v-chip small>
														<div
															class="white--text px-3 fs-5 d-flex justify-center text-center text-uppercase"
														>{{ item.status }}</div>
													</v-chip>
												</template>
												<template v-slot:item.actions="{item
														
													}">
													<v-btn icon color="grey darken-3" @click="addCourse(item)">
														<v-icon>mdi-arrow-up</v-icon>
													</v-btn>
												</template>
											</v-data-table>
										</v-card-text>
									</div>
									<div v-if="!isAddingAndDropping">
										<v-card-text>
											<div class="d-flex justify-space-between">
												<v-subheader>
													PENDING
													COURSES
												</v-subheader>
												<div class="d-flex align-center">
													<v-subheader class="pa-0 fs-5 font-weight-bold">
														TOTAL UNITS PENDING:
														{{ pendingUnits }}
													</v-subheader>
													<v-btn color="success" icon @click="
															editPendingCourses
														">
														<v-icon size="18" color="grey">mdi-pencil</v-icon>
													</v-btn>
												</div>
											</div>

											<v-data-table
												:headers="pendingHeaders"
												:items="pendingItems"
												@item-selected="selectItem"
												class="elevation-1"
												:loading="isLoadingPending"
												loading-text="Loading... Please wait"
												:show-select="
													isEnrolling
												"
												hide-default-footer
											>
												<template v-slot:header.data-table-select>
													<div></div>
												</template>
												<template v-slot:item.status="{
														item
													}">
													<v-chip small>
														<div
															class="white--text px-3 fs-5 d-flex justify-center text-center text-uppercase"
														>{{ item.status }}</div>
													</v-chip>
												</template>
											</v-data-table>
										</v-card-text>
									</div>
								</v-card>
							</v-tab-item>
							<v-tab-item>
								<v-container>
									<v-card v-for="items in enrollments" :key="items.id">
										<v-card-text>
											<div class="text-bold">{{ items.semester.name }}</div>
											<v-data-table
												:headers="enrollmentHeaders"
												:items="items.curriculum_items"
												hide-default-footer
											></v-data-table>
										</v-card-text>
									</v-card>
								</v-container>
							</v-tab-item>
						</v-tabs>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
		<div>
			<v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
				{{ snackbar.text }}
				<v-btn color="blue" text @click="snackbar.isActive - false">Close</v-btn>
			</v-snackbar>
		</div>
	</div>
</template>

<script>
import CurriculumTable from "@/components/general/CurriculumItem";

export default {
	props: {
		isStaff: {
			type: Boolean,
			default: false
		},
		isStudent: {
			type: Boolean,
			default: false
		},
		isAdmin: {
			type: Boolean,
			default: false
		}
	},
	components: {
		CurriculumTable
	},
	data() {
		return {
			tab: null,
			snackbar: {
				isActive: false,
				text: "",
				timeout: 3000
			},
			// isStudent: false,
			selectedCourses: [],
			isLoadingPending: true,
			isLoadingCurrent: true,
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
			asgn: [],
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
			],
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
			addAndDropHeaders: [
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
				},
				{ text: "ACTIONS", value: "actions" }
			],
			enrollments: [],
			pendingItems: [],
			pendingAddableItems: [],
			selectedAfterAdding: [],
			currentEnrollment: {}
		};
	},
	computed: {
		academicSession() {
			return this.$store.state.currentAcademicSession.session || {};
		},
		semester() {
			return this.$store.state.currentAcademicSession.semester || {};
		},
		settings() {
			return this.$store.state.settings || {};
		},
		level() {
			return this.$store.state.loggedInUser.level;
		},
		pendingHeaders() {
			let res;
			if (!this.isAddingAndDropping) {
				res = [
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
					{
						text: "CREDIT UNIT",
						value: "curriculum_item.credit_unit"
					},
					{
						text: "COURSE STATUS",
						value:
							"curriculum_item.curriculum_block.status.short_name"
					},
					{ text: "STATUS", value: "status" },
					{
						text: " SEMESTER",
						value:
							"curriculum_item.curriculumable.semester_type.short_title"
					}
				];
			} else {
				res = [
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
					{
						text: "CREDIT UNIT",
						value: "curriculum_item.credit_unit"
					},
					{
						text: "COURSE STATUS",
						value:
							"curriculum_item.curriculum_block.status.short_name"
					},
					{ text: "STATUS", value: "status" },
					{
						text: " SEMESTER",
						value:
							"curriculum_item.curriculumable.semester_type.short_title"
					},
					{ text: "ACTIONS", value: "actions" }
				];
			}
			return res;
		},
		pendingList() {
			let res;
			this.isAddingAndDropping
				? (res = this.pendingAddableItems)
				: (res = this.pendingItems);

			return res;
		},
		totalUnitsSelected() {
			return this.$store.state.selectedCourses.reduce((acc, val) => {
				return acc + val.credit_unit;
			}, 0);
		},
		pendingUnits() {
			return this.pendingItems.reduce((acc, val) => {
				return acc + val.curriculum_item.credit_unit;
			}, 0);
		},
		pendingItemsSelected() {
			return this.selectedPendingCourses.reduce((acc, val) => {
				return acc + val.credit_unit;
			}, 0);
		}
	},
	methods: {
		addCourse(item) {
			this.selectedAfterAdding = [
				...this.selectedAfterAdding,
				item.curriculum_item
			];
			this.pendingAddableItems.splice(
				this.pendingAddableItems.indexOf(item),
				1
			);
		},
		dropCourse(item) {
			let droppedItem = this.pendingItems.find(
				it => it.curriculum_item.id == item.id
			);
			if (droppedItem) {
				this.pendingAddableItems = [
					...this.pendingAddableItems,
					droppedItem
				];
				this.selectedAfterAdding.splice(
					this.selectedAfterAdding.indexOf(item),
					1
				);
			} else {
				let res = [item].map(it => ({
					curriculum_item_id: it.id,
					curriculum_item: item,
					status: "Dropped"
				}));
				this.selectedAfterAdding.splice(
					this.selectedAfterAdding.indexOf(item),
					1
				);

				this.pendingAddableItems = [
					...this.pendingAddableItems,
					res[0]
				];
			}
		},
		async saveEnrolled() {
			// console.log(this.$store.state.selectedCourses);
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
				throw error;
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
		async addAndDrop() {
			try {
				this.isAddingAndDropping = !this.isAddingAndDropping;
				if (this.isAddingAndDropping) {
					this.pendingAddableItems = [...this.pendingItems];
					this.selectedAfterAdding = [
						...this.currentEnrollment.curriculum_items
					];
				} else {
					let ids = this.selectedAfterAdding.map(it => it.id);
					// console.log(ids);
					let res = await this.$store.dispatch("addAndDrop", ids);
					if (res.status) {
						this.getCurrentEnrollment();
						this.getEnrollableItems();
						this.getEnrollmentHistory();
						(this.snackbar.text = res.message),
							(this.snackbar.isActive = true);
					} else {
						(this.snackbar.text = res.message),
							(this.snackbar.isActive = true);
					}
					this.pendingAddableItems = [];
					this.selectedAfterAdding = [];
				}
			} catch (error) {
				throw error;
			}
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
				let id = this.$route.params.id;
				if (!id) {
					id = this.$store.state.loggedInUser.matric_number;
				}

				let data = await this.$store.dispatch(
					"getCurrentEnrollment",
					id
				);
				this.currentEnrollment = data || {};
			} catch (error) {
				throw error;
			}
		},
		async getEnrollableItems() {
			try {
				let id = this.$route.params.id;
				if (!id) {
					id = this.$store.state.loggedInUser.matric_number;
				}
				let res = await this.$store.dispatch("getEnrollableItems", id);

				this.enrollableItems = res.data;
				this.pendingItems = res.pending;
			} catch (error) {
				throw error;
			}
		},
		async getEnrollmentHistory() {
			try {
				let id = this.$route.params.id;
				if (!id) {
					id = this.$store.state.loggedInUser.matric_number;
				}
				let data = await this.$store.dispatch(
					"getStudentEnrollments",
					id
				);
				this.enrollments = data;
			} catch (error) {
				throw error;
			}
		},
		async approveEnrollment() {
			try {
				let id;
				if (this.currentEnrollment) {
					id = this.currentEnrollment.id;
				}
				let res = await this.$store.dispatch("approveEnrollment", id);

				this.snackbar.text = res.message;
				this.snackbar.isActive = true;
				if (res.status) {
					this.getCurrentEnrollment();
				}
			} catch (error) {
				throw error;
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
		selectedCourses() {
			// console.log(v);
		}
	},
	async mounted() {
		try {
			await this.$store.dispatch("getCurrentAcademicSession");
			this.getCurrentEnrollment();
			this.getEnrollableItems();
			this.getEnrollmentHistory();
		} catch (error) {
			throw error;
		}
	}
};
</script>