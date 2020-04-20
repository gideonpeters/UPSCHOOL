<template>
	<v-card flat class="pa-3" min-height="500">
		<v-row v-if="!showGradeList">
			<v-col cols="12">
				<metric-card title="Number of GradeLists" :value="gradelist.length" />
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
								<v-checkbox disabled :value="!!item.visible" />
							</template>
						</v-data-table>
					</v-card>
				</v-card>
			</v-col>
			<v-col cols="4">
				<v-card class="pa-3 mt-4">
					<v-subheader class="pa-0">ONGOING SCHOOL SUBMISSIONS</v-subheader>

					<div class="d-flex fs-4 mb-3 align-center">
						<div class="pr-4">
							<v-icon size="15" color="info lighten-3">mdi-circle-slice-8</v-icon>
						</div>
						<div>TEST 1</div>
						<v-spacer></v-spacer>
						<div>
							<v-btn color="primary" small text>submit</v-btn>
						</div>
					</div>
				</v-card>
			</v-col>
		</v-row>
		<v-row v-else>
			<v-col>
				<h1>item</h1>
			</v-col>
		</v-row>
	</v-card>
</template>

<script>
import MetricCard from "@/components/parent/Metric";

export default {
	components: {
		MetricCard
	},
	data() {
		return {
			course: {},
			gradelist: [],
			totalScore: null,
			listName: null,
			dialog2: null,
			showGradeList: false,
			gradelistHeaders: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Total Score", value: "total_score" },
				{ text: "Visible", value: "visible" }
			]
		};
	},
	methods: {
		openItem(v) {
			// console.log(v);
			this.$router.push({
				name: "staff.courses.view.grades.view",
				params: { grade_id: v.id }
			});
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
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);

			this.getGradelists();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>