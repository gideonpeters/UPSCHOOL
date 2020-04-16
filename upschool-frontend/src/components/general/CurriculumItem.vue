<template>
	<div class="mt-3">
		<div class="d-flex justify-space-between">
			<div>
				<v-subheader class="pa-0 mb-0 text-uppercase"
					>{{ status.name }}
				</v-subheader>
				<div
					class="fs-5 t-primary mb-3"
					v-if="
						curriculumItem.curriculum_items &&
							curriculumItem.curriculum_items.length > 0
					"
				>
					Students must register at least
					{{
						curriculumItem.max_required_units
							? curriculumItem.max_required_units
							: "All " + totalUnits
					}}
					units
				</div>
			</div>
			<v-menu bottom left>
				<template v-slot:activator="{ on }">
					<v-btn icon v-on="on">
						<v-icon>mdi-dots-vertical</v-icon>
					</v-btn>
				</template>

				<v-list>
					<v-list-item
						v-for="(item, i) in items"
						:key="i"
						@click="item.fn"
					>
						<div class="font-weight-light">{{ item.title }}</div>
					</v-list-item>
				</v-list>
			</v-menu>
		</div>
		<div>
			<v-row justify="center">
				<v-dialog v-model="dialog" persistent max-width="600px">
					<!-- <template v-slot:activator="{ on }">
						<v-btn color="primary" dark v-on="on"
							>Open Dialog</v-btn
						>
					</template> -->
					<v-card>
						<v-card-title>
							<span class="headline">EDIT CURRICULUM BLOCK</span>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12">
										<v-text-field
											outlined
											disabled
											label="Program"
											:value="currentItem.program.name"
											required
										></v-text-field>
									</v-col>
									<v-col cols="12">
										<v-text-field
											outlined
											disabled
											label="Course Status"
											:value="status.name"
											required
										></v-text-field>
									</v-col>
									<v-col>
										<v-checkbox
											label="All courses are compulsory"
											v-model="isCompulsory"
										>
										</v-checkbox>
									</v-col>
									<v-col cols="12">
										<v-text-field
											v-if="!isCompulsory"
											outlined
											label="Number of units required"
											required
										></v-text-field>
									</v-col>
								</v-row>
							</v-container>
							<!-- <small>*indicates required field</small> -->
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn
								color="blue darken-1"
								text
								@click="dialog = false"
								>Close</v-btn
							>
							<v-btn
								color="blue darken-1"
								text
								@click="dialog = false"
								>Save</v-btn
							>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-row>
		</div>
		<div>
			<v-row justify="center">
				<v-dialog v-model="dialog2" persistent max-width="600px">
					<v-card>
						<v-card-title>
							<span class="headline"
								>ADD COURSE TO CURRICULUM</span
							>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12">
										<v-text-field
											outlined
											disabled
											label="Program"
											:value="
												`${currentItem.program.name} (${currentItem.level} Level)`
											"
											required
										></v-text-field>
									</v-col>
									<v-col cols="6">
										<v-text-field
											outlined
											disabled
											label="Course Status"
											:value="status.name"
											required
										></v-text-field>
									</v-col>
									<v-col cols="6">
										<v-text-field
											disabled
											v-if="!isCompulsory"
											outlined
											label="Number of units required"
											required
										></v-text-field>
									</v-col>
								</v-row>
								<v-row align="center">
									<v-col cols="4" sm="4">
										<v-autocomplete
											outlined
											item-text="course_code"
											item-value="id"
											:items="courses"
											v-model="selectedCourse"
											label="Course"
										></v-autocomplete>
									</v-col>
									<v-col cols="4">
										<v-text-field
											outlined
											label="Number of credit unit(s)"
											required
											v-model="credits"
										></v-text-field>
									</v-col>
								</v-row>
							</v-container>
							<!-- <small>*indicates required field</small> -->
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue darken-1" text @click="closeAdd"
								>Close</v-btn
							>
							<v-btn
								color="blue darken-1"
								text
								:disabled="
									!(
										!!selectedCourse &&
										(credits >= 0) & !!credits
									)
								"
								@click="save"
								>Save</v-btn
							><v-btn
								color="blue darken-1"
								:disabled="
									!(
										!!selectedCourse &&
										(credits >= 0) & !!credits
									)
								"
								text
								@click="save(true)"
								>Save & Add Another</v-btn
							>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-row>
		</div>
		<v-data-table
			:headers="headers"
			:show-select="isEnrolling"
			@toggle-select-all="selectItem('toggle')"
			@item-selected="selectItem"
			:items="curriculumItem.curriculum_items"
			class="elevation-1"
		>
			<template v-slot:item.completed="{ item }">
				<v-simple-checkbox
					:value="item.completed"
					disabled
				></v-simple-checkbox>
			</template>
			<template v-slot:no-data="{}">
				<div>No data to display</div>
			</template>
			<template v-slot:item.prerequisites="{ item }">
				<!-- <div v-if="item.curriculumable.prerequisites.length > 0"> -->
				<div
					class="py-1"
					v-for="(subItem, i) in item.curriculumable.prerequisites"
					:key="i"
				>
					<v-chip>{{ subItem.course_code }}</v-chip>
				</div>
				<!-- </div> -->
			</template>
			<template v-slot:item.semester="{ item }">
				<div class="py-1">{{ item }}</div>
			</template>
			<template v-slot:item.actions="{ item }">
				<v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
				<v-icon small @click="openEdit(item)">mdi-pencil</v-icon>
			</template>
		</v-data-table>
		<div>
			<v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
				{{ snackbar.text }}
				<v-btn color="blue" text @click="snackbar.isActive = false"
					>Close</v-btn
				>
			</v-snackbar>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		curriculumItem: {
			type: Object
		},
		level: {
			type: String
		},
		status: {
			type: Object
		},
		isEnrolling: {
			type: Boolean,
			default: false
		}
		// selectedCourses: {
		// 	type: Array
		// }
	},
	data() {
		return {
			selectedCourse: null,
			// selectedCourses: [],
			credits: null,
			numberAdded: 1,
			dialog: false,
			dialog2: false,
			dialog3: false,
			isCompulsory: false,
			snackbar: {
				isActive: false,
				timeout: 3000,
				text: ""
			},
			headers: [
				{
					text: "Course Code",
					align: "start",
					sortable: false,
					value: "curriculumable.course_code"
				},
				{ text: "Course Title", value: "curriculumable.title" },
				{ text: "Credit Unit(s)", value: "credit_unit" },
				{
					text: "Semester",
					value: "curriculumable.semester_type.short_title"
				},
				{
					text: "Prerequisites",
					value: "curriculumable.prerequisites"
				},
				{ text: "Completed", value: "completed", align: "center" },
				{ text: "Actions", value: "actions" }
			],
			items: [
				{ title: "EDIT BLOCK", fn: () => (this.dialog = true) },
				{ title: "ADD COURSE", fn: () => (this.dialog2 = true) },
				{ title: "DELETE BLOCK", fn: () => {} }
				// { title: "Click Me 2" }
			]
		};
	},
	computed: {
		courseStatuses() {
			return this.$store.state.course_statuses;
		},
		currentItem() {
			let item = this.curriculumItem;

			return item;
		},
		courses() {
			return this.$store.state.courses;
		},
		selectedCourses: {
			get: function() {
				return this.$store.state.selectedCourses;
			}
		},

		totalUnits() {
			return Number(
				this.curriculumItem.curriculum_items.reduce((acc, val) => {
					return acc + val.credit_unit;
				}, 0)
			);
			// return 5;
		}
	},
	methods: {
		getCourseById(id) {
			return this.$store.getters.getCourseById(id);
		},
		getSemesterById(id) {
			return this.$store.getters.getSemesterById(id);
		},
		curriculumType(typeId) {
			return this.$store.state.curriculum_types.find(
				item => item.id == typeId
			);
		},
		isCompleted() {
			return true;
		},
		selectItem(v) {
			if (v.value) {
				this.$store.state.selectedCourses.push(v.item);
			} else {
				this.$store.state.selectedCourses.splice(
					this.$store.state.selectedCourses.indexOf(v.item),
					1
				);
			}
			console.log(v);
		},
		closeAdd() {
			this.selectedCourse = null;
			this.credits = null;
			return (this.dialog2 = false);
		},
		editItem() {},
		deleteItem() {},
		async save(add) {
			try {
				let payload = {
					blockId: this.curriculumItem.id,
					body: {
						course_id: this.selectedCourse,
						credit_unit: this.credits
					}
				};
				let res = await this.$store.dispatch(
					"addCourseToCurriculum",
					payload
				);
				if (res.status) {
					this.snackbar.isActive = true;
					this.snackbar.text = res.message;
					this.closeAdd();
					this.$emit("updateItem");
					if (add == true) {
						this.dialog2 = true;
					}
				} else {
					this.snackbar.isActive = true;
					this.snackbar.text = "Something went wrong, try again!";
				}
			} catch (error) {
				console.log(error);
			}
		}
	},
	watch: {
		selectedCourses(v) {
			console.log(v);
		}
	},
	mounted() {}
};
</script>
