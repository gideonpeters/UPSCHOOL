<template>
	<v-app>
		<v-container fluid class="pa-0">
			<v-row wrap>
				<v-col cols="12" sm="12" md="12">
					<div class="d-flex align-baseline py-3">
						<div class="fs-2 font-weight-light">Welcome, {{ student.first_name }}!</div>
						<v-spacer></v-spacer>
						<div>{{ date.toDateString() }}</div>
					</div>
					<v-divider></v-divider>
				</v-col>
				<v-col cols="12" sm="12" md="8">
					<div class="d-flex flex-column">
						<div>
							<v-card class="pa-3 mb-5" flat>
								<custom-header title="FEATURED POST" ctaText="View more" route="student.news"></custom-header>
								<v-img
									:src="
										`http://127.0.0.1:8000${latestNews.image.url}`
									"
									class="white--text align-end"
									gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.8)"
									height="200px"
								>
									<v-card-title class="py-0" v-text="latestNews.title"></v-card-title>
									<v-card-title class="fs-4 py-0" v-html="latestNews.body" v-line-clamp:20="1"></v-card-title>
									<v-card-actions class="py-0">
										<v-spacer></v-spacer>

										<v-btn text color="white">READ MORE</v-btn>
									</v-card-actions>
								</v-img>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<custom-header title="TODAY'S SCHEDULE" ctaText="View full schedule" route="student.news"></custom-header>
								<div>
									<v-data-table :headers="headers" :items="schedule" hide-default-header hide-default-footer>
										<template v-slot:item.check="{ item }">
											<v-icon
												size="10"
												:color="
													item.id == 1
														? 'blue accent-2 '
														: 'grey'
												"
											>mdi-circle</v-icon>
											<!-- <v-simple-checkbox v-model="item.check" disabled> -->
											<!-- </v-simple-checkbox> -->
										</template>
										<template v-slot:item.name="{ item }">
											<div>
												{{
												item.course_id
												? `${
												getCourse(
												item.course_id
												).course_code
												}: ${
												getCourse(
												item.course_id
												).title
												}`
												: item.name
												}}
											</div>
											<!-- <v-icon size="10" :color="item.id == 1 ? 'blue accent-2 ' : 'grey'">mdi-circle</v-icon> -->
											<!-- <v-simple-checkbox v-model="item.check" disabled> -->
											<!-- </v-simple-checkbox> -->
										</template>
										<template v-slot:item.time="{ item }">
											<div class="d-flex fs-4 font-weight-bold grey--text">
												<div>{{ item.time }}</div>
											</div>
											<!-- <v-icon size="15" :color="item.id == 1 ? 'blue accent-2 ' : 'grey'">mdi-circle</v-icon> -->
											<!-- <v-simple-checkbox v-model="item.check" disabled> -->
											<!-- </v-simple-checkbox> -->
										</template>
										<template v-slot:item.venue="{ item }">
											<div class="d-flex fs-4 font-italic grey--text">
												<div class="mr-1">
													<v-icon size="15" color="grey">mdi-map-marker</v-icon>
												</div>
												<div>{{ item.venue }}</div>
											</div>
											<!-- <v-icon size="15" :color="item.id == 1 ? 'blue accent-2 ' : 'grey'">mdi-circle</v-icon> -->
											<!-- <v-simple-checkbox v-model="item.check" disabled> -->
											<!-- </v-simple-checkbox> -->
										</template>
									</v-data-table>
								</div>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="UPCOMING C.A." ctaText="View all" route="student.news"></custom-header>
										</v-col>
										<!-- <v-col cols="12" sm="3" v-for="i in 4" :key="i">
														<quiz-card  />
										</v-col>-->
										<v-col cols="12">
											<v-slide-group v-model="model" class center-active show-arrows>
												<v-slide-item
													v-for="n in 15"
													:key="n"
													v-slot:default="{
														active,
														toggle
													}"
												>
													<quiz-card class :input-value="active" @click="toggle" />
												</v-slide-item>
											</v-slide-group>
										</v-col>
									</v-row>
								</v-container>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="UPCOMING ASSIGNMENTS" ctaText="View all" route="student.news"></custom-header>
										</v-col>
										<v-col cols="12">
											<v-data-table :headers="asgnHeaders" :items="asgn" hide-default-footer>
												<template v-slot:item.check="{ item }">
													<v-icon
														size="15"
														:color="
															item.id == 1
																? 'blue accent-2 '
																: 'grey'
														"
													>mdi-circle</v-icon>
													<!-- <v-simple-checkbox v-model="item.check" disabled> -->
													<!-- </v-simple-checkbox> -->
												</template>
												<template v-slot:item.action="{}">
													<v-icon small class="mr-2 pointer">mdi-eye</v-icon>
													<v-icon small class="pointer">mdi-pencil</v-icon>
												</template>
											</v-data-table>
										</v-col>
									</v-row>
								</v-container>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="UPCOMING EXAMS" ctaText="View all" route="student.news"></custom-header>
										</v-col>
										<v-col cols="12">
											<v-slide-group v-model="model" class center-active show-arrows>
												<v-slide-item
													v-for="n in 15"
													:key="n"
													v-slot:default="{
														active,
														toggle
													}"
												>
													<quiz-card class :input-value="active" @click="toggle" />
												</v-slide-item>
											</v-slide-group>
										</v-col>
									</v-row>
								</v-container>
							</v-card>
						</div>
					</div>
				</v-col>
				<v-col cols="12" sm="8" md="4">
					<div class="d-flex flex-column">
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-row>
									<v-col cols="12">
										<custom-header title="ACADEMIC PROGRESS" ctaText="View" route="student.profile"></custom-header>
									</v-col>
									<v-col cols="4" class="px-5">
										<v-progress-circular
											:indeterminate="indeterminate"
											:rotate="rotate"
											:size="size"
											:value="value"
											:width="width"
											color="light-blue"
										>
											<v-icon size="25" color="light-blue">mdi-school-outline</v-icon>
										</v-progress-circular>
									</v-col>
									<v-col class="px-5">
										<div>
											<div class="d-flex flex-column">
												<div class="font-weight-bold fs-4">PROGRAM</div>
												<div class="fs-4">
													{{student.program.name}}
													({{student.program.degree.short_name}})
												</div>
											</div>
											<div class="d-flex flex-column mt-4">
												<div class="font-weight-bold fs-4">STATUS</div>
												<div class="fs-4">PROMOTED: {{student.level}} Level</div>
											</div>
										</div>
									</v-col>
								</v-row>
								<v-divider></v-divider>
								<v-row>
									<v-col cols="12">
										<custom-header title="CREDITS TO GRADUATE"></custom-header>
										<div class="fs-3">
											<div>
												You need a total of {{student.program.min_graduation_units}} units to
												graduate
											</div>
											<div class="d-flex mt-3">
												<div>Current credits achieved:</div>
												<v-spacer></v-spacer>
												<div class="font-weight-bold mr-5">{{student.credits_achieved}}</div>
											</div>
										</div>
									</v-col>
								</v-row>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="NEWS" ctaText="View more" route="student.news"></custom-header>
										</v-col>
										<v-col>
											<div class="d-flex flex-column">
												<div class="fs-3 text-uppercase font-weight-bold grey--text">{{ latestNews.title }}</div>
												<v-card
													v-html="latestNews.body"
													flat
													max-height="76"
													v-line-clamp:20="4"
													class="fs-4 d-flex text-wrap"
												></v-card>
												<div class="d-flex">
													<v-spacer></v-spacer>
													<div>
														<v-btn
															color="primary"
															text
															small
															@click="
																goToPage(
																	'student.news.details',
																	latestNews.id
																)
															"
														>read more</v-btn>
													</div>
												</div>
												<!-- <div class="primary--text fs-4 mt-4 pointer" >Read more</div> -->
											</div>
										</v-col>
									</v-row>
								</v-container>
								<!-- <v-subheader>NEWS</v-subheader> -->
							</v-card>
						</div>
						<div>
							<v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="EVENTS" ctaText="View more" route="student.news"></custom-header>
										</v-col>
										<v-col>
											<div class="d-flex flex-column">
												<div class="fs-3 text-uppercase font-weight-bold grey--text">{{ latestEvent.name }}</div>
												<v-card flat max-height="76" v-line-clamp:20="4" class="fs-4 d-flex text-wrap">
													{{
													latestEvent.description
													}}
												</v-card>
												<!-- <div class="primary--text fs-4 mt-4 pointer">ADD TO SCHEDULE</div> -->
											</div>
										</v-col>
									</v-row>
								</v-container>
							</v-card>
						</div>
						<div>
							<v-card class="pa-3" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<dashboard-calendar />
										</v-col>
									</v-row>
								</v-container>
							</v-card>
						</div>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import QuizCard from "./../../components/general/QuizCard";
import DashboardCalendar from "@/components/student/dashboard/Calendar";

export default {
	components: {
		QuizCard,
		DashboardCalendar
	},
	data() {
		return {
			date: new Date(Date.now()),
			model: null,
			now: null,
			indeterminate: false,
			rotate: 270,
			size: 100,
			// value: 80,
			width: 4,
			absolute: true,
			overlay: false,
			headers: [
				{ text: " ", value: "check" },
				{ text: "TIME", value: "time" },
				{
					text: "NAME",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "LOCATION", value: "venue" }
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
			]
			// schedule: [
			// 	{
			// 		id: 1,
			// 		name: "GST111: Communications in English Language",
			// 		time: "8:00 AM - 9:00 AM",
			// 		location: "Lecture Theatre 2"
			// 	},
			// 	{
			// 		id: 2,
			// 		name: "EIE517: applied Electronics",
			// 		time: "10:00 AM - 12:00 PM",
			// 		location: "EIE building"
			// 	},
			// 	{
			// 		id: 3,
			// 		name: "Vivify meeting",
			// 		time: "1:00 PM - 3:00 PM",
			// 		location: "CU Chapel"
			// 	}
			// ]
		};
	},
	computed: {
		latestNews() {
			return this.$store.state.news[0];
		},
		latestEvent() {
			return this.$store.state.events[0];
		},
		schedule() {
			return this.$store.state.loggedInUser.schedule;
		},
		student() {
			return this.$store.state.loggedInUser;
		},
		value() {
			// if (this.student) {
			let ans =
				(this.student.credits_achieved /
					this.student.program.min_graduation_units) *
				100;
			console.log(ans);

			return ans;
			// } else return 0;
		}
	},
	methods: {
		goToPage(name, id) {
			this.$router.push({ name: name, params: { id: id } });
		},
		getCourse(id) {
			return this.$store.getters.getCourseById(id);
		}
	},
	async mounted() {
		this.$store.dispatch("getNews");
	}
};
</script>

<style lang="scss" scoped>
.border-dashed {
	border-bottom: 1px dashed purple;
}
</style>
