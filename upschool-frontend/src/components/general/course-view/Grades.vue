<template>
	<v-card flat class="pa-3" min-height="500">
		<v-row v-if="!showGradeList">
			<v-col cols="3">
				<metric-card title="Number of GradeLists" :value="gradelist.length" />
			</v-col>
			<v-col cols="9">
				<!-- <metric-card title="Number of GradeLists" :value="gradelist.length" /> -->
			</v-col>
			<v-col cols="8">
				<v-card flat class="pa-3">
					<div class="d-flex justify-space-between align-center">
						<v-subheader class="pa-0">GRADE LISTS</v-subheader>
						<v-spacer></v-spacer>
						<v-row justify="end">
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

					<v-card class="pa-3 mt-4">
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
								<v-simple-checkbox disabled :value="!!item.visible" />
							</template>
						</v-data-table>
					</v-card>
				</v-card>
			</v-col>
			<v-col cols="4">
				<v-card class="pa-3 mt-4">
					<small class="fs-6">Click to view your submission</small>
					<v-subheader class="pa-0">GENERAL SCHOOL ASSESSMENTS</v-subheader>

					<div
						class="d-flex fs-4 mb-3 align-center"
						v-for="assessment in schoolAssessments"
						:key="assessment.id"
					>
						<div class="pr-4">
							<v-btn icon color="info lighten-3" @click="viewAssessment(assessment.id)">
								<v-icon
									size="15"
									:color="assessment.course_id ? 'info lighten-3': 'primary lighten-3'"
								>mdi-eye</v-icon>
							</v-btn>
						</div>
						<div>{{assessment.name}} ({{assessment.total_score}} Marks)</div>
						<v-spacer></v-spacer>
						<div>
							<v-btn
								color="primary"
								small
								text
								:disabled="!assessment.visible"
								@click="openSubmitAssessment(assessment)"
							>submit</v-btn>
						</div>
					</div>
				</v-card>
				<v-row justify="center" class="pa-3">
					<v-dialog v-model="dialogAssessment" persistent max-width="600px">
						<template v-slot:activator="{on}">
							<v-btn
								v-if="courseSchoolAssessments.length ==  0"
								color="primary"
								v-on="on"
								block
								depressed
							>Create School Submission for course</v-btn>
						</template>
						<v-card>
							<v-card-title>
								<span class="headline">CREATE COURSE SCHOOL ASSESSMENT</span>
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
												label="Name of Assessment"
												v-model="
																				assessmentName
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
																				totalAssessmentScore
																			"
											></v-text-field>
										</v-col>
										<v-col cols="6">
											<v-text-field
												outlined
												label="Percentage in final result"
												required
												v-model="
																				totalAssessmentPercentage
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
																	closeSchoolAssessment
																"
								>Close</v-btn>
								<v-btn
									color="blue darken-1"
									text
									:disabled="
																	!(
																		assessmentName &&
																		totalAssessmentPercentage && totalAssessmentScore
																	)
																"
									@click="createNewCourseAssessment"
								>Save</v-btn>
							</v-card-actions>
						</v-card>
					</v-dialog>
				</v-row>
			</v-col>
		</v-row>

		<v-row v-else>
			<v-col>
				<h1>item</h1>
			</v-col>
		</v-row>
		<v-dialog v-model="dialogSubmitAssessment" persistent max-width="600px">
			<v-card>
				<v-card-title>
					<span class="headline">Submit Assessment Score</span>
				</v-card-title>
				<v-card-text>
					<v-container>
						<v-row>
							<v-col cols="12">
								<div class="fs-3">{{selectedAssessment.name}} ({{selectedAssessment.total_score}} Marks)</div>
							</v-col>
							<v-col cols="12" sm="12">
								<v-autocomplete
									v-model="selectedGrades"
									item-text="name"
									return-object
									chips
									:items="gradelist"
									label="Select Grade(s) you want to submit"
									multiple
								></v-autocomplete>
							</v-col>
							<v-col cols="12" sm="6" v-if="selectedGrades.length > 1">
								<v-autocomplete v-model="selectedGradeAction" :items="gradeActions" label="Math Operation"></v-autocomplete>
							</v-col>
						</v-row>
					</v-container>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="closeAssessment">Cancel</v-btn>
					<v-btn color="blue darken-1" text @click="submitAssessment">Proceed</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-card>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import Axios from "axios";

export default {
	components: {
		MetricCard
	},
	props: {
		isStaff: {
			type: Boolean,
			default: false
		},
		isAdmin: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			course: {},
			gradelist: [],
			totalScore: null,
			listName: null,
			dialog2: null,
			showGradeList: false,
			dialogSubmitAssessment: null,
			dialogAssessment: null,
			selectedAssessment: {},
			selectedGradeAction: "",
			selectedGrades: [],
			courseSchoolAssessments: [],
			assessmentName: "",
			totalAssessmentScore: "",
			totalAssessmentPercentage: "",
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
			gradeActions: ["SUM", "AVERAGE", "MAX", "MIN"]
			// schoolAssessments: []
		};
	},
	computed: {
		schoolAssessments() {
			return this.$store.state.schoolAssessments;
		}
	},
	methods: {
		viewAssessment() {
			this.$router.push({ name: "parent.courses.view.assessments" });
		},
		openSubmitAssessment(item) {
			this.selectedAssessment = item;
			this.dialogSubmitAssessment = true;
		},
		async createNewCourseAssessment() {
			try {
				if (
					!this.course.id ||
					!this.totalAssessmentScore ||
					!this.totalAssessmentPercentage ||
					!this.assessmentName
				) {
					return this.$store.commit(
						"openSnackbar",
						"Make sure you filled all fields"
					);
				}

				let body = {
					course_id: this.course.id,
					name: this.assessmentName,
					percentage: this.totalAssessmentPercentage,
					total_score: this.totalAssessmentScore
				};

				let res = await Axios.post("school-assessment-course", body);

				this.$store.commit("openSnackbar", res.data.message);
				this.assessmentName = "";
				this.totalAssessmentScore = "";
				this.totalAssessmentPercentage = "";
				this.dialogAssessment = false;
				this.getSchoolAssessments();
			} catch (error) {
				console.log(error);
			}
		},
		submitAssessment() {
			if (this.selectedGrades.length == 0) {
				return this.$store.commit(
					"openSnackbar",
					"You did not select a grade item"
				);
			}

			if (this.selectedGrades.length > 1 && !this.selectedGradeAction) {
				return this.$store.commit(
					"openSnackbar",
					"You have to select a math operation for two or more gradelist submission"
				);
			}
			let ids = this.selectedGrades.map(item => item.id);

			let body = {
				ids: JSON.stringify(ids),
				school_assessment_id: this.selectedAssessment.id,
				action: this.selectedGradeAction
			};

			this.$store.dispatch("uploadSchoolAssessment", body);
			this.dialogSubmitAssessment = false;
		},
		closeAssessment() {
			this.dialogSubmitAssessment = false;
			this.selectedAssessment = {};
			this.selectedGradeAction = "";
			this.selectedGrades = [];
		},
		closeSchoolAssessment() {
			this.dialogAssessment = false;
			this.assessmentName = "";
			this.totalAssessmentScore = "";
			this.totalAssessmentPercentage = "";
		},
		openItem(v) {
			// console.log(v);
			if (this.isAdmin) {
				this.$router.push({
					name: "parent.courses.view.grades.view",
					params: { grade_id: v.id }
				});
			} else if (this.isStaff) {
				this.$router.push({
					name: "staff.courses.view.grades.view",
					params: { grade_id: v.id }
				});
			}
		},
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
					if (add == true) this.dialog2 = true;
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
		},
		async getSchoolAssessments() {
			let id = this.$route.params.id;

			await this.$store.dispatch("getSchoolAssessments", id);
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);

			this.getGradelists();

			if (this.schoolAssessments.length == 0) {
				this.getSchoolAssessments();
			}
		} catch (error) {
			console.log(error);
		}
	}
};
</script>