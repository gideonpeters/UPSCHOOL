/* eslint-disable */
<template>
	<v-app>
		<v-card flat>
			<v-navigation-drawer
				app
				v-model="drawer"
				:mini-variant.sync="mini"
				:permanent="$vuetify.breakpoint.mdAndUp ? mini : false"
				:temporary="$vuetify.breakpoint.smAndDown ? true : false"
			>
				<v-list-item class="px-2 py-4">
					<v-list-item-avatar>
						<v-img
							src="https://randomuser.me/api/portraits/women/80.jpg"
						></v-img>
					</v-list-item-avatar>

					<v-list-item-title>
						<div>{{ user.user ? user.user.name : "" }}</div>
						<div class="fs-4 my-3">
							Student #: {{ user.matric_number }}
						</div>
						<div class="fs-4">Covenant University</div>
					</v-list-item-title>

					<v-btn icon @click.stop="mini = !mini">
						<v-icon>mdi-chevron-left</v-icon>
					</v-btn>
				</v-list-item>

				<v-divider></v-divider>

				<v-subheader v-if="!mini">
					<div class="fs-5">GENERAL</div>
				</v-subheader>

				<v-list dense>
					<v-list-item
						exact
						active-class=" active-tab"
						:to="{ name: dash.route }"
						v-for="dash in dashes"
						:key="dash.icon"
						link
					>
						<v-list-item-icon>
							<v-icon>{{ dash.icon }}</v-icon>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title class="text-uppercase">
								{{ dash.title }}
							</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-subheader v-if="!mini">
					<div class="fs-5">{{ keyTitle }}</div>
				</v-subheader>

				<v-list dense>
					<v-list-item
						exact
						active-class=" active-tab"
						:to="{ name: item.route }"
						v-for="item in items"
						:key="item.title"
						link
					>
						<v-list-item-icon>
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title class="text-uppercase">
								{{ item.title }}
							</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-footer absolute>
					<div
						class="py-2 pointer"
						v-if="!mini"
						@click="
							goToPage('main.login'),
								$store.commit('openSnackbar', 'Visit again!')
						"
					>
						LOGOUT
					</div>
				</v-footer>
			</v-navigation-drawer>
			<!-- <v-card :ripple="false" color="grey lighten-4" flat height="100%" tile> -->
			<v-app-bar app class="primary disable-dbl-tap-zoom">
				<v-icon
					color="white"
					@click="
						$vuetify.breakpoint.mdAndUp
							? (mini = !mini)
							: (drawer = !drawer)
					"
					>mdi-menu</v-icon
				>

				<v-spacer />

				<v-menu offset-y :close-on-content-click="closeOnContentClick">
					<template v-slot:activator="{ on }">
						<v-btn
							depressed
							color="primary"
							dark
							v-on="on"
							v-if="keyStat"
						>
							<v-icon color="white" class="pointer"
								>mdi-apps</v-icon
							>
						</v-btn>
					</template>

					<v-card
						class="pa-4 primary-box-shadow"
						min-width="150px"
						max-height="350px"
						flat
					>
						<v-container>
							<v-row>
								<v-col
									cols="4"
									v-for="(item, index) in apps"
									:key="index"
								>
									<div
										class="d-flex flex-column align-center"
										@click="goToPage(item.route)"
									>
										<div>
											<v-icon>{{ item.icon }}</v-icon>
										</div>
										<div>{{ item.title }}</div>
									</div>
								</v-col>
							</v-row>
						</v-container>
					</v-card>
				</v-menu>

				<v-menu transition="slide-y-transition" bottom>
					<template v-slot:activator="{ on }">
						<v-btn dark icon color="grey" v-on="on">
							<!-- <v-btn icon> -->
							<v-icon color="white">mdi-bell-outline</v-icon>
							<!-- </v-btn> -->
						</v-btn>
					</template>
					<v-list>
						<v-list-item v-for="(item, i) in itemsx" :key="i">
							<v-list-item-title>
								{{ item.title }}
							</v-list-item-title>
						</v-list-item>
					</v-list>
				</v-menu>

				<!-- <v-menu transition="slide-y-transition" bottom color="primary">
					<template v-slot:activator="{ on }">
				<v-btn dark icon color="grey" v-on="on">-->
				<v-btn icon @click="goToPage('student.inbox')" color="grey">
					<v-icon color="white">mdi-message-outline</v-icon>
				</v-btn>
				<!-- </v-btn> -->
				<!-- </template>
					<v-list style="max-height: 200px; z-index: 99999">
						<div class="t-primary pa-3">View All notifications</div>
						<v-list-item v-for="(item, i) in itemsx" :key="i">
							<v-card color="white" flat class="pa-3" style="width:400px; z-index: 99999999999999999">
								<v-layout align-start>
									<v-flex xs2>
										<v-icon>mdi-bell-outline</v-icon>
									</v-flex>
									<v-flex>
										<div class="d-flex flex-column">
											<div>{{ item.title }}</div>
											<div>
												The DSA has requested all
												studetns to be seated in the
												chapel by 8pm
											</div>
										</div>
									</v-flex>
								</v-layout>
							</v-card>
						</v-list-item>
					</v-list>
				</v-menu>-->
			</v-app-bar>
		</v-card>

		<v-content>
			<v-container>
				<router-view />
			</v-container>
		</v-content>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			closeOnContentClick: true,
			drawer: this.$vuetify.breakpoint.mdAndUp ? true : false,
			mini: this.$vuetify.breakpoint.mdAndDown ? false : true,
			dashes: [
				{
					route: "student.dashboard",
					title: "Dashboard",
					icon: "mdi-view-dashboard-outline"
				},
				{
					route: "student.profile",
					title: "Profile",
					icon: "mdi-account-outline"
				},
				{
					route: "student.inbox",
					title: "Inbox",
					icon: "mdi-email-outline"
				},
				{
					route: "student.news",
					title: "News & Events",
					icon: "mdi-newspaper"
				}
			],
			overwriteBreakpoint: true,
			bars: [
				{ class: "" },
				{ class: "", dark: true },
				{ class: "primary", dark: true },
				{ class: "elevation-0" }
			],
			itemsx: [
				{ title: "Click Me" },
				{ title: "Click Me" },
				{ title: "Click Me" },
				{ title: "Click Me 2" }
			],
			apps: [
				{
					route: "student.course-reg",
					title: "Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "student.payments",
					title: "Financials",
					icon: "mdi-finance"
				},
				{
					route: "student.calendar",
					title: "Planner",
					icon: "mdi-clock-outline"
				},
				{
					route: "student.results",
					title: "Results & Grading",
					icon: "mdi-school"
				},
				{
					route: "student.attendance",
					title: "Attendance",
					icon: "mdi-presentation"
				}
			]
		};
	},
	computed: {
		navTitle() {
			let metaTitle = this.$route.meta.title;
			let title = metaTitle ? metaTitle : "Dashboard";
			return title;
		},
		keyStat() {
			return this.$route.meta.key;
		},
		keyTitle() {
			let title;
			if (!this.keyStat) title = "APPS";
			else if (this.keyStat == 3) title = "COURSES";
			else if (this.keyStat == 4) title = "RESULTS & GRADING";
			else if (this.keyStat == 5) title = "FINANCIALS";
			else if (this.keyStat == 6) title = "PLANNER";

			return title;
		},
		items() {
			let result;
			let courseItems = [
				{
					route: "student.course-reg",
					title: "Browse Courses",
					icon: "mdi-magnify"
				},
				{
					route: "student.courses.plan",
					title: "My Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "student.courses.register",
					title: "Enrollments",
					icon: "mdi-book"
				},
				{
					route: "student.courses.assignments",
					title: "Assignments",
					icon: "mdi-clipboard-text"
				},
				{
					route: "student.courses.grading",
					title: "C.A's",
					icon: "mdi-poll-box"
				},
				{
					route: "student.calendar",
					title: "Timetable",
					icon: "mdi-clock-outline"
				}
			];
			let generalItems = [
				{
					route: "student.course-reg",
					title: "Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "student.payments",
					title: "Financials",
					icon: "mdi-finance"
				},
				{
					route: "student.calendar",
					title: "Planner",
					icon: "mdi-clock-outline"
				},
				{
					route: "student.results",
					title: "Results & Grading",
					icon: "mdi-school-outline"
				},
				{
					route: "student.attendance",
					title: "Attendance",
					icon: "mdi-presentation"
				},
				{
					route: "student.residence",
					title: "Residency",
					icon: "mdi-home-outline"
				},
				{
					route: "student.settings",
					title: "Settings",
					icon: "mdi-settings-outline"
				},
				{
					route: "student.help",
					title: "Help",
					icon: "mdi-help-circle-outline"
				}
			];

			let resultItems = [
				{
					route: "student.results",
					title: "Result Analyzer",
					icon: "mdi-progress-clock"
				},
				// {
				// 	route: "student.results.transcript",
				// 	title: "View Transcript",
				// 	icon: "mdi-cloud-download"
				// },\
				{
					route: "student.results.breakdown",
					title: "Result Breakdown",
					icon: "mdi-chart-arc"
				},
				{
					route: "student.results.calculator",
					title: "Bull's Eye",
					icon: "mdi-bullseye-arrow"
				}
			];

			let financialItems = [
				{
					route: "student.payments",
					title: "FEES",
					icon: "mdi-cash"
				},
				{
					route: "student.payments.history",
					title: "PAYMENT HISTORY",
					icon: "mdi-history"
				}
			];

			let plannerItems = [
				{
					route: "student.calendar",
					title: "CALENDAR",
					icon: "mdi-calendar"
				},
				{
					route: "student.schedule",
					title: "Schedule",
					icon: "mdi-watch"
				},
				{
					route: "student.school-calendar",
					title: "School Calendar",
					icon: "mdi-clock-outline"
				}
			];

			if (this.keyStat == 3) result = courseItems;
			else if (this.keyStat == 4) result = resultItems;
			else if (this.keyStat == 5) result = financialItems;
			else if (this.keyStat == 6) result = plannerItems;
			else if (!this.keyStat) result = generalItems;

			return result;
		},
		user() {
			return this.$store.state.loggedInUser;
		}
	},
	methods: {
		goToPage(routeName) {
			this.$router.push({ name: routeName });
		}
	},
	async created() {
		try {
			this.$store.dispatch("getUser");
			this.$store.dispatch("getNews");
		} catch (err) {
			console.log(err);
		}
	}
};
</script>

<style lang="scss" scoped>
.nav-title {
	font-size: 25px;
	font-weight: bold;
}

.nav-item {
	// font-size: 40px;
	// color: rgba(232, 230, 227, 0.54) !important;
	display: flex;
	justify-content: center;
	text-align: center;
}

.f {
	width: 100%;
	background: #d09cf1;
}

.ff {
	background: pink;
}

.active-tab {
	color: #683587;
}

.drawer {
	height: 100vh;
}

.v-list-item--link:before {
	border-radius: 5px;
}

.v-list .v-list-item--active {
	color: #683587;
}

.theme--dark.v-list-item--active:hover::before,
.theme--dark.v-list-item--active::before {
	opacity: 1;
	border-radius: 5px;
	color: #683587;
	background-color: white;
}
</style>
