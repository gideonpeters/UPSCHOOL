<template>
	<div class="mt-3">
		<div class="d-flex justify-space-between">
			<v-subheader class="pa-0 text-uppercase">{{
				status.name
			}}</v-subheader>
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

									<!-- <v-col cols="12">
										<v-text-field
											label="Email*"
											required
										></v-text-field>
									</v-col>
									<v-col cols="12">
										<v-text-field
											label="Password*"
											type="password"
											required
										></v-text-field>
									</v-col>
									<v-col cols="12" sm="6">
										<v-select
											:items="[
												'0-17',
												'18-29',
												'30-54',
												'54+'
											]"
											label="Age*"
											required
										></v-select>
									</v-col>
									<v-col cols="12" sm="6">
										<v-autocomplete
											:items="[
												'Skiing',
												'Ice hockey',
												'Soccer',
												'Basketball',
												'Hockey',
												'Reading',
												'Writing',
												'Coding',
												'Basejump'
											]"
											label="Interests"
											multiple
										></v-autocomplete>
									</v-col> -->
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
					<!-- <template v-slot:activator="{ on }">
						<v-btn color="primary" dark v-on="on"
							>Open Dialog</v-btn
						>
					</template> -->
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

									<!-- <v-col cols="12">
										<v-text-field
											label="Email*"
											required
										></v-text-field>
									</v-col>
									<v-col cols="12">
										<v-text-field
											label="Password*"
											type="password"
											required
										></v-text-field>
									</v-col>
									<v-col cols="12" sm="6">
										<v-select
											:items="[
												'0-17',
												'18-29',
												'30-54',
												'54+'
											]"
											label="Age*"
											required
										></v-select>
									</v-col>
									<v-col cols="12" sm="6">
										<v-autocomplete
											:items="[
												'Skiing',
												'Ice hockey',
												'Soccer',
												'Basketball',
												'Hockey',
												'Reading',
												'Writing',
												'Coding',
												'Basejump'
											]"
											label="Interests"
											multiple
										></v-autocomplete>
									</v-col> -->
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
		</v-data-table>
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
		}
	},
	data() {
		return {
			selectedCourse: null,
			credits: null,
			numberAdded: 1,
			dialog: false,
			dialog2: false,
			isCompulsory: false,
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
				{ text: "Completed", value: "completed" },
				{ text: "Actions", value: "actions" }
			],
			items: [
				{ title: "EDIT BLOCK", fn: () => (this.dialog = true) },
				{ title: "DELETE BLOCK", fn: () => (this.dialog2 = true) },
				{ title: "ADD COURSE", fn: () => {} }
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
			// .filter(
			// 	item => item.course_status_id == status.id
			// );
			// console.log(curriculumItem);
			return item;
			// console.log(
			// 	this.curriculumItem.filter(
			// 		item => item.course_status_id == status.id
			// 	)
			// );
		},
		courses() {
			return this.$store.state.courses.map(item => item.course_code);
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
		closeAdd() {
			(this.selectedCourse = null), (this.credits = null);
			return (this.dialog2 = false);
		},
		async save(add) {
			try {
				let body = {};
				let res = await this.$store.dispatch("addCourseToCurriculum");
				if (res.status) {
					this.closeAdd();
					if (add) {
						this.dialog2 = true;
					}
				}
			} catch (error) {
				console.log(error);
			}
		}
	},
	mounted() {}
};
</script>
