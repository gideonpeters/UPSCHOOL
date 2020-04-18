<template>
	<div>
		<div class="d-flex align-center">
			<v-btn flat icon color="black" @click="$router.go(-1)">
				<v-icon>mdi-arrow-left</v-icon>
			</v-btn>
			<div v-if="course">
				<h3>{{ course.course_code }}: {{ course.title }}</h3>
			</div>
			<v-spacer></v-spacer>
			<!-- <div>
				<div class="text-center" v-if="!isStudent">
					<v-menu offset-y>
						<template v-slot:activator="{ on }">
							<v-btn outlined color="green accent-4" class="fs-5" v-on="on">ENROLL</v-btn>
						</template>
						<v-list>
							<v-list-item v-for="(item, index) in enrollActions" :key="index" @click="alert(item)">
								<v-list-item-title>{{ item.title }}</v-list-item-title>
							</v-list-item>
						</v-list>
					</v-menu>
				</div>
			</div>-->
		</div>

		<div>
			<v-card flat class="pa-3 mt-5">
				<v-tabs v-model="tab" background-color="transparent">
					<v-tab v-for="item in items" :key="item.id">
						{{
						item.tab
						}}
					</v-tab>
				</v-tabs>

				<v-tabs-items v-model="tab">
					<v-tab-item v-for="(item, ix) in items" :key="ix">
						<v-card flat class="pa-3" v-if="ix == 0" min-height="500">
							<v-card-text>
								<div class="my-4 subtitle-1">Description</div>

								<div>{{ course.description }}</div>
								<v-row align="center" class="mx-0 mt-5">
									<div>CLASSES:</div>
									<!-- <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating> -->

									<div class="grey--text ml-4 d-flex align-center" v-for="i in 2" :key="i">
										Mondays 8:00AM -10PM
										<v-icon size="15" class="px-2">mdi-close-circle</v-icon>

										<v-icon size="15">mdi-pencil</v-icon>
									</div>
									<v-spacer></v-spacer>
									<v-btn color="primary" outlined>ADD CLASS</v-btn>
								</v-row>
							</v-card-text>

							<v-divider class="mx-4"></v-divider>
							<v-row align="center">
								<v-card-title>Prerequisites</v-card-title>
								<v-spacer></v-spacer>
								<v-btn color="success" text>ADD PREREQUISITE</v-btn>
							</v-row>

							<v-card-text>
								<v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
									<v-chip
										v-for="prerequisite in course.prerequisites"
										:key="prerequisite.id"
									>{{ prerequisite.course_code }}</v-chip>
								</v-chip-group>
							</v-card-text>

							<v-card-text>
								<v-row>
									<div class="mb-4 subtitle-1">Facilitators</div>
									<v-spacer></v-spacer>

									<v-btn color="success" text>ADD FACILITATOR</v-btn>
								</v-row>

								<div
									v-for="facilitator in course.facilitators"
									:key="facilitator.id"
								>{{ facilitator.user.name }}</div>
							</v-card-text>

							<v-card-actions>
								<div class="d-flex flex-lg-row flex-column">
									<div v-if="isStudent">
										<v-btn color="deep-purple lighten-2" text @click="reserve">Enrolled as Student</v-btn>
									</div>
									<div>
										<v-btn color="deep-purple lighten-2" text @click="reserve">Enroll as Staff/Facilitator</v-btn>
									</div>
								</div>
							</v-card-actions>
						</v-card>
						<v-card flat class="pa-3" v-if="ix == 1" min-height="500">
							<v-btn color="primary" depressed text v-if="!isStudent">Add Section</v-btn>

							<div class="mt-5 border-dashed pb-5" v-for="section in courseSections" :key="section.id">
								<div class="d-flex justify-space-between align-center">
									<h3>{{ section.title }}</h3>
									<div class="text-center" v-if="!isStudent">
										<v-menu offset-y>
											<template v-slot:activator="{ on }">
												<v-btn v-on="on" depressed icon>
													<v-icon color="grey">mdi-dots-vertical</v-icon>
												</v-btn>
											</template>
											<v-list>
												<v-list-item
													v-for="(item,
													index) in sectionActions"
													:key="index"
													@click="alert(item)"
												>
													<v-list-item-title>
														{{
														item.title
														}}
													</v-list-item-title>
												</v-list-item>
											</v-list>
										</v-menu>
									</div>
								</div>
								<div
									class="fs-3 mt-3 align-center d-flex pointer"
									v-for="(subsection,
									idx) in section.subsections"
									:key="idx"
								>
									<section-item :subsection="subsection" />
								</div>
								<div class="d-flex mt-4 align-baseline">
									<div class="fs-5 font-weight-light">Updated 5 mins ago</div>
									<div class="px-2"></div>
									<div class="fs-5 font-weight-light">Uploaded 5 mins ago</div>
								</div>
							</div>
						</v-card>
						<v-card flat class="pa-3" v-if="ix == 2" min-height="500">
							<v-data-table
								:headers="headers"
								:items="course.participants"
								:items-per-page="10"
								hide-default-footer
							>
								<template v-slot:item.action="{}">
									<v-btn depressed tile>Action</v-btn>
								</template>
								<template v-slot:item.name="{ item }">
									{{
									`${item.first_name} ${item.middle_name} ${item.last_name}`
									}}
								</template>
							</v-data-table>
						</v-card>
						<v-card flat class="pa-3" v-if="ix == 3" min-height="500">
							<div class="fs-3">Currently under construction</div>
						</v-card>
						<v-card flat class="pa-3" v-if="ix == 4" min-height="500">
							<v-row>
								<v-col cols="12">
									<metric-card title="Number of GradeLists" :value="gradelist.length" />
								</v-col>
								<v-col cols="8">
									<v-card flat class="pa-3">
										<div class="d-flex justify-space-between align-center">
											<v-subheader class="pa-0">GRADE LISTS</v-subheader>
											<v-spacer></v-spacer>
											<v-row justify="center">
												<v-dialog v-model="dialog2" persistent max-width="600px">
													<template v-slot:activator="{
															on
														}">
														<v-btn color="primary" dark depressed v-on="on">
															CREATE GRADE
															LIST
														</v-btn>
													</template>
													<v-card>
														<v-card-title>
															<span class="headline">
																CREATE GRADE
																LIST
															</span>
														</v-card-title>
														<v-card-text>
															<v-container>
																<v-row>
																	<v-col cols="12">
																		<v-text-field
																			outlined
																			disabled
																			label="Course"
																			:value="
																				`${course.course_code}: ${course.title}`
																			"
																			required
																		></v-text-field>
																	</v-col>
																	<v-col cols="6">
																		<v-text-field
																			outlined
																			label="Name of Grading"
																			v-model="
																				listName
																			"
																			required
																		></v-text-field>
																	</v-col>

																	<v-col cols="6">
																		<v-text-field
																			outlined
																			label="Total Score"
																			required
																			v-model="
																				totalScore
																			"
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
																@click="
																	closeAdd
																"
															>Close</v-btn>
															<v-btn
																color="blue darken-1"
																text
																:disabled="
																	!(
																		listName &&
																		totalScore
																	)
																"
																@click="save"
															>Save</v-btn>
															<v-btn
																color="blue darken-1"
																:disabled="
																	!(
																		listName &&
																		totalScore
																	)
																"
																text
																@click="
																	save(true)
																"
															>
																Save & Add
																Another
															</v-btn>
														</v-card-actions>
													</v-card>
												</v-dialog>
											</v-row>
										</div>

										<div class="fs-5 font-italic">
											<v-icon size="10" class="mr-1" color="blue">mdi-information</v-icon>Click table item to view
										</div>

										<v-data-table
											:headers="gradelistHeaders"
											:items="gradelist"
											@click:row="openItem"
											:items-per-page="5"
										>
											<template v-slot:item.visible="{ item }">
												<v-checkbox disabled :value="!!item.visible" />
											</template>
										</v-data-table>
									</v-card>
								</v-col>
								<v-col cols="4"></v-col>
							</v-row>
						</v-card>

						<v-card flat class="pa-3" v-if="ix == 5" min-height="500">
							<div class="fs-3">Currently under construction</div>
						</v-card>
					</v-tab-item>
				</v-tabs-items>
			</v-card>
		</div>
	</div>
</template>

<script>
import SectionItem from "@/components/general/SectionItem";
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		SectionItem,
		MetricCard
	},
	props: {
		isStudent: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			tab: null,
			isHovered: false,
			selection: null,
			dialog2: null,
			course: {},
			items: [
				{ id: 1, tab: "OVERVIEW" },
				{ id: 2, tab: "COURSE MATERIAL" }
			],
			headers: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Matriculation Number", value: "matric_number" },
				{ text: "Registration Number", value: "reg_number" },
				{ text: "Program", value: "program.name" },
				{ text: "Grade/Level", value: "level" },
				// { text: "Residence", value: "residence" },
				{ text: "Actions", value: "action", sortable: false }
			],
			gradelistHeaders: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Total Score", value: "total_score" },
				{ text: "Visible", value: "visible" }
			],
			gradelist: [],
			totalScore: null,
			listName: null,
			sectionActions: [
				{ id: 1, title: "Add Document" },
				{ id: 2, title: "Add Submission" },
				{ id: 3, title: "Edit Section" },
				{ id: 4, title: "Delete Section" }
			],
			enrollActions: [
				{ id: 1, title: "Student Enrollment" },
				{ id: 2, title: "Staff Enrollment" }
			],
			courseSections: []
		};
	},
	computed: {
		// course() {
		// 	let id = this.$route.params.id;
		// 	return this.$store.getters.getCourseById(id);
		// }
	},
	methods: {
		reserve() {},
		openItem() {},
		closeAdd() {
			this.listName = null;
			this.totalScore = null;
			this.dialog2 = null;
		},
		async save(add) {
			try {
				if (!this.totalScore || !this.listName) return;
				let id = this.$route.params.id;

				let body = {
					course_id: id,
					total_score: this.totalScore,
					name: this.listName
				};
				let res = await this.$store.dispatch(
					"saveCourseGradelist",
					body
				);
				if (res.status) {
					this.getGradelists();
					this.closeAdd();
					if (add) this.dialog2 = true;
				}
			} catch (error) {
				console.log(error);
			}
		},
		async getGradelists() {
			try {
				let id = this.$route.params.id;

				let res = await this.$store.dispatch("getCourseGradelist", id);
				this.gradelist = res.data;
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			if (!this.isStudent) {
				this.items.push(
					{ id: 3, tab: "PARTICIPANTS" },
					{ id: 4, tab: "SUBMISSIONS" },
					{ id: 5, tab: "GRADES" },
					{ id: 6, tab: "SETTINGS" }
				);
			}
			let id = this.$route.params.id;
			this.courseSections = await this.$store.dispatch(
				"getCourseSection",
				id
			);
			this.getGradelists();
			this.course = await this.$store.dispatch("getCourseById", id);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>

<style lang="scss" scoped>
.border-dashed {
	border-bottom: 1px dashed grey;
}
</style>
