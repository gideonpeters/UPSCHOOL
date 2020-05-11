<template>
	<v-app style="background-color:; color: white">
		<v-card tile flat color="primary" class="d-flex flex-column" height="100%">
			<v-spacer></v-spacer>
			<v-container>
				<v-row>
					<v-col cols="12" md="12">
						<div class="d-flex align-center justify-space-between">
							<div class="fs-2 d-flex white--text">Where do you want to start?</div>
							<v-avatar color="white darken-1" class="elevation-5" size="100">
								<div class="d-flex fs-1 black--text">A</div>
							</v-avatar>
						</div>
						<v-divider class="my-5 white"></v-divider>
					</v-col>
					<v-col cols="6" md="3" v-for="(app,i) in apps" :key="i">
						<v-card
							class="white black--text pa-3 pointer"
							:class="selectedApp == app ? 'success lighten-5': 'white'"
							height="120"
							@click="selectItem(app)"
						>
							<div class="d-flex align-center">
								<div class>{{app.name}}</div>
								<v-spacer></v-spacer>
								<v-avatar :color="selectedApp == app ? 'white lighten-4': 'grey lighten-3'" size="80">
									<v-icon size="30">{{app.icon}}</v-icon>
								</v-avatar>
							</div>
						</v-card>
					</v-col>
				</v-row>
				<v-row>
					<v-col>
						<div class="d-flex white--text">
							<v-icon small color="white">mdi-information</v-icon>
							<div class="px-3">Click on any item to view information</div>
						</div>
					</v-col>
				</v-row>
			</v-container>
			<v-spacer></v-spacer>
			<v-container>
				<div class="d-flex">
					<v-spacer></v-spacer>
					<!-- <v-btn :disabled="!selectedApp" color="white" large tile> -->
					<v-avatar
						@click="selectedApp ? goToNext() : ''"
						:class="selectedApp? 'pointer': ''"
						:color="selectedApp ? 'success': 'success lighten-5'"
						size="80"
						style="position: fixed; bottom: 10px; right: 10px"
					>
						<v-icon x-large>mdi-chevron-right</v-icon>
					</v-avatar>
					<!-- </v-btn> -->
				</div>
			</v-container>
		</v-card>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			selectedApp: null,
			apps: [
				{
					name: "General",
					icon: "mdi-view-dashboard",
					route: "student.dashboard",
					info: ""
				},
				{
					name: "News & Announcements",
					icon: "mdi-newspaper",
					route: "student.news",
					info: ""
				},
				{
					name: "Course Work",
					icon: "mdi-bookshelf",
					route: "student.course-reg",
					info: ""
				},
				{
					name: "Results & Grading",
					icon: "mdi-school",
					route: "student.results",
					info: ""
				},
				{
					name: "Calendar",
					icon: "mdi-calendar",
					route: "student-calendar",
					info: ""
				},
				{
					name: "Financials",
					icon: "mdi-finance",
					route: "student.payments",
					info: ""
				},
				{
					name: "Inbox",
					icon: "mdi-email",
					route: "student.inbox",
					info: ""
				},
				{
					name: "Attendance",
					icon: "mdi-presentation",
					route: "student.attendance",
					info: ""
				},
				{
					name: "Residency",
					icon: "mdi-bank",
					route: "student.residence",
					info: ""
				},
				{
					name: "Settings",
					icon: "mdi-settings",
					route: "student.settings",
					info: ""
				}
			]
		};
	},
	methods: {
		selectItem(selected) {
			if (selected == this.selectedApp) return (this.selectedApp = null);
			this.selectedApp = this.apps.find(item => item == selected);
		},
		goToNext() {
			this.$router.push({ name: this.selectedApp.route });
		}
	}
};
</script>
