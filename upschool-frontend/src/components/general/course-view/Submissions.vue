<template>
	<v-card flat class="pa-3" min-height="500">
		<v-container>
			<v-row align="center">
				<v-col cols="12" md="3">
					<metric-card title="Number of Submission Lists" :value="submissionList.length" />
				</v-col>
				<v-col cols="12">
					<v-card flat class>
						<div class="d-flex justify-space-between align-center">
							<v-subheader class="pa-0">SUBMISSION LISTS</v-subheader>
							<v-spacer></v-spacer>
							<v-btn color="primary" depressed>CREATE SUBMISSION</v-btn>
						</div>

						<v-card class="pa-3 mt-4">
							<div class="fs-5 font-italic">
								<v-icon size="10" class="mr-1" color="blue">mdi-information</v-icon>Click table item to view
							</div>
							<v-data-table
								:headers="submissionListHeaders"
								:items="submissionList"
								@click:row="openItem"
								:items-per-page="5"
							>
								<template v-slot:item.open_date="{ item }">
									{{`${moment(
									item.open_date
									).format("dddd, MMMM Do YYYY, h:mm a")} (${moment(
									item.open_date
									).fromNow()})`}}
								</template>
								<template v-slot:item.due_date="{ item }">
									{{`${moment(
									item.due_date
									).format("dddd, MMMM Do YYYY, h:mm a")} (${moment(
									item.due_date
									).fromNow()})`}}
								</template>
							</v-data-table>
						</v-card>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
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
			submissionList: [],
			submissionListHeaders: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "subsection.name"
				},
				{ text: "Total Score", value: "total_score" },
				{ text: "Opens in", value: "open_date" },
				{ text: "Closes in", value: "due_date" }
				// { text: "Visible", value: "visible" }
			]
			// submissionList: []
		};
	},

	methods: {
		viewAssessment() {
			this.$router.push({
				name: "parent.courses.view.submissions.details"
			});
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
				this.getCourseSubmissionLists();
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
		openItem(v) {
			// console.log(v);
			if (this.isAdmin) {
				this.$router.push({
					name: "parent.courses.view.submissions.details",
					params: { submission_id: v.id }
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
					this.closeAdd();
					if (add == true) this.dialog2 = true;
				}
			} catch (error) {
				console.log(error);
			}
		},
		async getCourseSubmissionLists() {
			let id = this.$route.params.id;

			let res = await Axios.get(`submission-list?course_id=${id}`);
			console.log(res.data);
			// this.$store.commit("openSnackbar", res.data.message);
			this.submissionList = res.data.data;
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);

			if (this.submissionList.length == 0) {
				this.getCourseSubmissionLists();
			}
		} catch (error) {
			console.log(error);
		}
	}
};
</script>