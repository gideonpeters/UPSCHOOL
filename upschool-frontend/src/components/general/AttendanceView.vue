<template>
	<v-app>
		<div class="my-5">
			<v-icon size="20" class="mr-2" @click="$router.go(-1)">mdi-arrow-left</v-icon>
			Events & Attendance / {{student.first_name}} {{student.middle_name}} {{student.last_name}}
		</div>

		<v-row>
			<v-col cols="12" md="4">
				<div class="d-flex flex-column justify-center">
					<student-card :student="student" />
					<div class="d-flex flex-column justify-center" v-if="!isStudent">
						<v-btn color="success" outlined depressed class="mb-2">Create Clearance</v-btn>
						<v-btn color="success" depressed>Generate Report</v-btn>
					</div>
				</div>
			</v-col>
			<v-col cols="12" md="8">
				<v-card flat class="pa-3">
					<v-tabs v-model="tab" background-color="transparent">
						<v-tab v-for="(item, idx) in items" :key="idx">{{ item.tab }}</v-tab>
					</v-tabs>

					<v-tabs-items v-model="tab">
						<v-tab-item v-for="(item, indx) in items" :key="indx">
							<v-row>
								<v-col cols="12" md="12">
									<div v-if="indx == 0">
										<v-expansion-panels multiple>
											<v-expansion-panel v-for="(schoolEvent, i) in studentEvents" :key="i">
												<v-expansion-panel-header class="text-uppercase">{{schoolEvent.title}}</v-expansion-panel-header>
												<v-expansion-panel-content>
													<div class="d-flex align-start h-100 mb-4" v-for="i in 3" :key="i">
														<div class="d-flex flex-column align-center mr-4 h-100">
															<div>
																<v-icon color="info" size="20">mdi-circle-slice-8</v-icon>
															</div>
															<div class="d-flex circle-line h-100 my-1 mr-4"></div>
														</div>

														<div>
															<!-- <div>{{ eventDate.date.toUTCString() }}</div> -->
															<div class="fs-3">{{schoolEvent.event.venue}}</div>
															<div class="fs-4">{{schoolEvent.event.start_time}}</div>
														</div>

														<div class="ml-auto">
															<v-icon color="grey" size="18" class="mx-3">mdi-flag</v-icon>
															<v-icon color="grey" size="18" v-if="!isStudent">mdi-pencil</v-icon>
														</div>
													</div>
												</v-expansion-panel-content>
											</v-expansion-panel>
										</v-expansion-panels>

										<div>
											<v-card class="pa-3 mt-4">
												<v-subheader>Quick Stats [Defaults]</v-subheader>

												<div class="px-4">
													<div
														class="d-flex justify-space-between fs-4 pb-4"
														v-for="event in studentEvents"
														:key="event.id"
													>
														<div>Number of {{event.title}} defaults</div>
														<div class="d-flex align-center">
															15
															<!-- {{ event.total_attendance - eventDates(event.id).length }} -->
															<v-icon color="grey" size="15" class="pl-3">mdi-eye</v-icon>
														</div>
													</div>
												</div>
											</v-card>
										</div>
									</div>
									<div v-if="indx == 1">
										<v-card flat>
											<v-subheader>ALPHA SEMESTER</v-subheader>
											<v-card-text>
												<v-data-table
													:headers="courseAttendanceHeaders"
													:items="courseAttendance"
													:items-per-page="10"
													@click:row="goToPage"
													hide-default-footer
												>
													<template
														v-slot:item.percentage="{ item }"
													>{{((item.scored_attendance / item.total_attendance ) * 100).toFixed(2)}}</template>
													<template v-slot:footer>
														<div class="d-flex">
															<v-spacer></v-spacer>
															<h2 class="mt-5 grey--text">AGGREGATE ATTENDANCE: {{ aggregateAttendanceScore }}</h2>
														</div>
													</template>
												</v-data-table>
											</v-card-text>
										</v-card>
									</div>
								</v-col>
							</v-row>
							<v-row v-if="indx == 2 && !isStudent">
								<v-col>
									<div class="d-flex justify-center">Settings currently under construction</div>
								</v-col>
							</v-row>
						</v-tab-item>
					</v-tabs-items>
				</v-card>
			</v-col>
		</v-row>
	</v-app>
</template>

<script>
import StudentCard from "@/components/general/StudentCard";
export default {
	props: {
		isStudent: {
			type: Boolean,
			default: false
		},
		staff: {
			type: Boolean,
			default: false
		}
	},
	components: {
		StudentCard
	},
	data: () => ({
		tab: null,
		events: [
			{ id: 1, name: "FRIDAY CHOP" },
			{ id: 2, name: "TUESDAY SERVICE" },
			{ id: 3, name: "SUNDAY SERVICE" }
		],
		studentEvents: [],
		text:
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
		courseAttendanceHeaders: [
			{
				text: "COURSE CODE",
				align: "start",
				sortable: false,
				value: "name"
			},
			{ text: "COURSE TITLE", value: "course_title" },
			{ text: "CREDIT UNIT", value: "credit_unit" },
			{ text: "TOTAL ATTENDANCE", value: "total_attendance" },
			{ text: "SCORED ATTENDANCE", value: "scored_attendance" },
			{ text: "PERCENTAGE ATTENDANCE(%)", value: "percentage" }
		],
		courseAttendance: [
			{
				id: 1,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "CST111",
				course_title:
					"Use of Library, Study Skills and Information Communication Technology I",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 4.0
			},
			{
				id: 2,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "GEC117",
				course_title: "Technical Drawing",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 4.3
			},
			{
				id: 3,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "MAT111",
				course_title: "Mathematics I: Algebra",
				credit_unit: 3.0,
				total_attendance: "17",
				scored_attendance: 6.0
			},
			{
				id: 4,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "MAT112",
				course_title: "Mathematics II: Trigonometry and Geometry",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 4.3
			},
			{
				id: 5,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "PHY111",
				course_title: "Mechanics and Properties of Matter",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 3.9
			},
			{
				id: 6,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "PHY112",
				course_title: "Heat, Sound and Optics",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 0.0
			},
			{
				id: 7,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "PHY119",
				course_title: "Physics Practicals IA",
				credit_unit: 1.0,
				total_attendance: "17",
				scored_attendance: 0
			},
			{
				id: 8,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "CHM111",
				course_title: "General Physical Chemistry",
				credit_unit: 3.0,
				total_attendance: "17",
				scored_attendance: 6.5
			},
			{
				id: 9,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "CHM119",
				course_title: "General Chemistry Practical I",
				credit_unit: 1.0,
				total_attendance: "17",
				scored_attendance: 4.9
			},
			{
				id: 10,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "EDS111",
				course_title: "Entrepreneurial DevelopmentStudies I",
				credit_unit: 1.0,
				total_attendance: "17",
				scored_attendance: 7
			},
			{
				id: 11,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "TMC111",
				course_title: "Total Man Concept I",
				credit_unit: 1.0,
				total_attendance: "17",
				scored_attendance: 7
			},
			{
				id: 12,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "TMC112",
				course_title: "Total Man Concept - Sports",
				credit_unit: 0.0,
				total_attendance: "17",
				scored_attendance: 7
			},
			{
				id: 13,
				semester: {
					id: 1,
					name: "Alpha",
					session: { id: 1, name: "2019/2020 Session" }
				},
				name: "GST111",
				course_title: "Communication in English",
				credit_unit: 2.0,
				total_attendance: "17",
				scored_attendance: 7
			}
		]
		// student: {}
	}),
	computed: {
		items() {
			let ans;
			if (!this.isStudent)
				ans = [
					{ tab: "School Events", content: "Tab 1 Content" },
					{ tab: "Course Attendance", content: "Tab 2 Content" },
					{ tab: "Settings", content: "Tab 3 Content" }
				];
			else {
				ans = [
					{ tab: "School Events", content: "Tab 1 Content" },
					{ tab: "Course Attendance", content: "Tab 2 Content" }
				];
			}

			return ans;
		},
		// studentEvents() {
		// 	let id = this.studentInfo.matric_number;
		// 	return this.$store.getters.getStudentEvent(id);
		// },
		aggregateAttendanceScore() {
			return Number(
				(this.courseAttendance.reduce((acc, val) => {
					return acc + val.scored_attendance / val.total_attendance;
				}, 0) /
					this.courseAttendance.length) *
					100
			).toFixed(2);
		},
		student() {
			let id = this.$route.params.id;
			if (!id) {
				return this.$store.state.loggedInUser;
			}
			return this.$store.getters.getStudent(id);
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;
			if (!id) {
				id = this.$store.state.loggedInUser.id;
			}
			this.studentEvents = await this.$store.dispatch(
				"getUserEvents",
				id
			);
			// console.log(this.studentEvents);
		} catch (error) {
			console.log(error);
		}
	},
	methods: {
		dothis() {
			// console.log(this.allevents);
		},
		goToPage(v) {
			return this.$router.push({
				name: "parent.courses-view",
				params: { id: v.id }
			});
		},
		eventDates(id) {
			return this.studentEvents.filter(events => events.event.id == id);
		}
	}
};
</script>

<style lang="scss" scoped>
.circle-line {
	background: rgb(71, 71, 245);
	width: 1px;
	height: auto;
	margin-right: 9.5px;
	margin-left: 9.5px;
}
.circle {
	height: 20px;
	width: 20px;
	border-radius: 50%;
	background-color: white;
	border: 1px solid rgb(71, 71, 245);

	.circle-inner {
		height: 10px;
		width: 10px;
		border-radius: 50%;
		background-color: rgb(71, 71, 245);
	}
}
</style>
