/* eslint-disable */
<template>
	<v-app>
		<!-- <v-navigation-drawer
			v-model="drawer"
			app
			dark
			:mini-variant.sync="$vuetify.breakpoint.mdAndUp ? mini : false"
			:permanent="$vuetify.breakpoint.mdAndUp"
			hide-overlay
			color="#683587"
			class="drawer disable-dbl-tap-zoom"
		>
			<div style="display: flex;">
				<v-list>
					<v-list-item class="py-3 mx-3">
						<v-icon
							:ripple="false"
							size="20"
							@click.stop="mini = !mini"
						>
							$vuetify.icons.sidebar-menu
						</v-icon>
					</v-list-item>
					<v-list-item
						v-for="item in items"
						:key="item.title"
						:ripple="false"
						class="py-1 mx-3 my-4"
						exact
						:active-class="mini ? 'active-tab ' : ''"
						:to="{ name: item.route }"
					>
						<v-list-item-icon
							style="position: relative; z-index: 9999999999"
						>
							<v-icon size="20" style="z-index: 9999999999">
								{{ item.icon }}
							</v-icon>
						</v-list-item-icon>

						<v-list-item-content style="position: relative">
							{{ item.title }}
						</v-list-item-content>
					</v-list-item>
					<v-list-item
						style="position: absolute; bottom: 0px; left: 0px; right: 0px; display:flex; justify-content: center"
						class="py-1"
						:class="mini ? '' : 'f '"
						exact
						:to="{ name: 'main.help' }"
					>
						<v-list-item-icon style="position: relative">
							<v-icon size="20">
								$vuetify.icons.sidebar-email
							</v-icon>
						</v-list-item-icon>

						<v-list-item-content style="position: relative">
							Send us an email
						</v-list-item-content>
					</v-list-item>
				</v-list>
			</div>
		</v-navigation-drawer>-->

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
						<v-img src="https://randomuser.me/api/portraits/women/80.jpg"></v-img>
					</v-list-item-avatar>

					<v-list-item-title>
						<div>Bethel Ofuyatan</div>
						<div class="fs-4 my-3">Student #: 15CJ02876</div>
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
						:to="{name: dash.route}"
						v-for="dash in dashes"
						:key="dash.icon"
						link
					>
						<v-list-item-icon>
							<v-icon>{{ dash.icon }}</v-icon>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title class="text-uppercase">{{ dash.title }}</v-list-item-title>
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
						:to="{name: item.route}"
						v-for="item in items"
						:key="item.title"
						link
					>
						<v-list-item-icon>
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title class="text-uppercase">{{ item.title }}</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-footer absolute>
					<!-- <v-spacer></v-spacer> -->
					<div
						class="py-2 pointer"
						v-if="!mini"
						@click="goToPage('main.login'), $store.commit('openSnackbar', 'Visit again!')"
					>LOGOUT</div>
				</v-footer>
			</v-navigation-drawer>
			<!-- <v-card :ripple="false" color="grey lighten-4" flat height="100%" tile> -->
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
					@click=" $vuetify.breakpoint.mdAndUp ? mini = !mini : drawer = !drawer"
				>mdi-menu</v-icon>

				<v-spacer />

				<v-menu offset-y :close-on-content-click="closeOnContentClick">
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
											<v-icon>{{item.icon}}</v-icon>
										</div>
										<div>{{item.title}}</div>
									</div>
								</v-col>
							</v-row>
						</v-container>
						<!-- <v-list>
							<v-list-item">
								<v-list-item-title>{{ item.title }}</v-list-item-title>
							</v-list-item>
						</v-list>-->
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
							<v-list-item-title>{{ item.title }}</v-list-item-title>
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
		<!-- </v-card> -->

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
					title: "Manage Courses",
					icon: "mdi-book"
				},
				{
					route: "student.courses.assignments",
					title: "My Assignments",
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

			if (this.keyStat == 3) result = courseItems;
			else if (this.keyStat == 4) result = resultItems;
			else if (this.keyStat == 5) result = financialItems;
			else if (!this.keyStat) result = generalItems;

			return result;
		}
		// mini: {
		// 	get() {
		// 		return (
		// 			this.$vuetify.breakpoint.mdOnly || this.overwriteBreakpoint
		// 		);
		// 	},
		// 	set(value) {
		// 		this.overwriteBreakpoint = value;
		// 	}
		// }
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
