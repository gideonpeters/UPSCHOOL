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
						<v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
					</v-list-item-avatar>

					<v-list-item-title>
						<div>Igebu Anesi</div>
						<div class="fs-4 mt-3">Staff #: 11CU02876</div>
						<div class="fs-4 my-3">Senior Lecturer</div>
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
								{{
								dash.title
								}}
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
								{{
								item.title
								}}
							</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-footer absolute>
					<div class="py-2 pointer" v-if="!mini" @click="goToPage('main.login')">LOGOUT</div>
				</v-footer>
			</v-navigation-drawer>
			<v-app-bar app class="primary disable-dbl-tap-zoom">
				<!-- <v-toolbar-title>
					<div class="nav-title text-truncate">
						<i
							v-if="$vuetify.breakpoint.xs"
							class="mdi mdi-menu mr-5"
							@click="(mini = !mini), (drawer = true)"
						/>
						{{ navTitle }}
					</div>
				</v-toolbar-title>-->
				<v-icon
					color="white"
					@click="
						$vuetify.breakpoint.mdAndUp
							? (mini = !mini)
							: (drawer = !drawer)
					"
				>mdi-menu</v-icon>

				<v-spacer />

				<v-menu offset-y close-on-content-click>
					<template v-slot:activator="{ on }">
						<v-btn depressed color="primary" dark v-on="on" v-if="keyStat">
							<v-icon color="white" class="pointer">mdi-apps</v-icon>
						</v-btn>
					</template>

					<v-card class="pa-4 primary-box-shadow" min-width="150px" max-height="350px" flat>
						<v-container>
							<v-row>
								<v-col cols="4" v-for="(item, index) in apps" :key="index">
									<div class="d-flex flex-column align-center" @click="goToPage(item.route)">
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
								{{
								item.title
								}}
							</v-list-item-title>
						</v-list-item>
					</v-list>
				</v-menu>

				<v-menu transition="slide-y-transition" bottom color="primary">
					<template v-slot:activator="{ on }">
						<v-btn dark icon color="grey" v-on="on">
							<!-- <v-btn icon> -->
							<v-icon color="white">mdi-message-outline</v-icon>
							<!-- </v-btn> -->
						</v-btn>
					</template>
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
				</v-menu>
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
			drawer: this.$vuetify.breakpoint.mdAndUp ? true : false,
			mini: this.$vuetify.breakpoint.mdAndDown ? false : true,
			dashes: [
				{
					route: "staff.dashboard",
					title: "Dashboard",
					icon: "mdi-view-dashboard-outline"
				},
				{
					route: "staff.profile",
					title: "Profile",
					icon: "mdi-account-outline"
				},
				{
					route: "staff.inbox",
					title: "Inbox",
					icon: "mdi-email-outline"
				},
				{
					route: "staff.news",
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
					route: "staff.courses",
					title: "Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "staff.finances",
					title: "Financials",
					icon: "mdi-finance"
				},
				{
					route: "staff.calendar",
					title: "Planner",
					icon: "mdi-clock-outline"
				},
				{
					route: "staff.result",
					title: "Results & Grading",
					icon: "mdi-school"
				},
				{
					route: "staff.attendance",
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

			return title;
		},
		items() {
			let result;
			let courseItems = [
				{
					route: "staff.courses",
					title: "Browse Courses",
					icon: "mdi-magnify"
				},
				{
					route: "staff.courses.plan",
					title: "My Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "staff.courses.register",
					title: "Manage Enrollments",
					icon: "mdi-book"
				},
				{
					route: "staff.courses.assignments",
					title: "Submissions",
					icon: "mdi-clipboard-text"
				},
				{
					route: "staff.courses.grading",
					title: "C.A's",
					icon: "mdi-poll-box"
				},
				{
					route: "staff.calendar",
					title: "Timetable",
					icon: "mdi-clock-outline"
				}
			];
			let generalItems = [
				{
					route: "staff.courses",
					title: "Courses",
					icon: "mdi-bookshelf"
				},
				{
					route: "staff.finances",
					title: "Financials",
					icon: "mdi-finance"
				},
				{
					route: "staff.calendar",
					title: "Planner",
					icon: "mdi-clock-outline"
				},
				{
					route: "staff.result",
					title: "Results & Grading",
					icon: "mdi-school-outline"
				},
				{
					route: "staff.attendance",
					title: "Attendance",
					icon: "mdi-presentation"
				},
				// {
				// 	route: "staff.residence",
				// 	title: "Residency",
				// 	icon: "mdi-home-outline"
				// },
				{
					route: "staff.settings",
					title: "Settings",
					icon: "mdi-settings-outline"
				},
				{
					route: "staff.help",
					title: "Help",
					icon: "mdi-help-circle-outline"
				}
			];

			let resultItems = [
				{
					route: "staff.results",
					title: "Result Analyzer",
					icon: "mdi-progress-clock"
				},
				{
					route: "staff.results.breakdown",
					title: "Result Breakdown",
					icon: "mdi-chart-arc"
				},
				{
					route: "staff.results.calculator",
					title: "Bull's Eye",
					icon: "mdi-bullseye-arrow"
				}
			];

			if (this.keyStat == 3) result = courseItems;
			else if (this.keyStat == 4) result = resultItems;
			else if (!this.keyStat) result = generalItems;

			return result;
		}
	},
	methods: {
		goToPage(routeName) {
			this.$router.push({ name: routeName });
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

.v-list .v-list-item--active {
	color: #683587;
}

.theme--dark.v-list-item--active:hover::before,
.theme--dark.v-list-item--active::before {
	opacity: 1;
	color: #683587;
	background-color: white;
}
</style>
