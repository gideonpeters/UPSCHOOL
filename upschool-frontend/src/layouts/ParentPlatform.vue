<template>
	<v-app>
		<v-navigation-drawer
			app
			v-model="drawer"
			:mini-variant.sync="mini"
			:permanent="$vuetify.breakpoint.mdAndUp ? mini : false"
			:temporary="$vuetify.breakpoint.smAndDown ? true : false"
			color="#43425D"
			dark
		>
			<v-list-item class="px-2">
				<!-- <v-list-item-avatar>
					<v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
				</v-list-item-avatar>-->

				<v-list-item-title>{{user.name}}</v-list-item-title>

				<v-btn icon @click.stop="mini = !mini">
					<v-icon>mdi-chevron-left</v-icon>
				</v-btn>
			</v-list-item>

			<v-divider></v-divider>

			<v-list dense>
				<div v-for="(item, i) in items" :key="i">
					<v-list-group
						v-if="item.subItems.length > 0"
						v-model="item.active"
						:prepend-icon="item.icon"
						no-action
						active-class="black white--text"
					>
						<template v-slot:activator>
							<!-- <v-list-item-icon>
								<v-icon>{{ item.icon }}</v-icon>
							</v-list-item-icon>-->
							<v-list-item-content>
								<v-list-item-title v-text="item.title"></v-list-item-title>
							</v-list-item-content>
						</template>

						<v-list-item
							v-for="(subItem, idx) in item.subItems"
							:key="idx"
							:to="{ name: subItem.route }"
							exact
							active-class="white--text"
							link
						>
							<!-- <v-list-item-icon>
								<v-icon>{{ subItem.icon }}</v-icon>
							</v-list-item-icon>-->
							<v-list-item-content>
								<v-list-item-title v-text="subItem.title"></v-list-item-title>
							</v-list-item-content>
						</v-list-item>
					</v-list-group>
					<v-list-item v-else :to="{ name: item.route }" exact class="my-2" link>
						<v-list-item-icon>
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-item-icon>

						<v-list-item-content>
							<v-list-item-title>{{ item.title }}</v-list-item-title>
						</v-list-item-content>
					</v-list-item>
				</div>
			</v-list>

			<!-- <v-footer absolute class="font-weight-medium">
				<v-col class="text-center" cols="12">
					<v-list dense>
						<v-list-item link>
							<v-list-item-icon>
								<v-icon>mdi-message</v-icon>
							</v-list-item-icon>

							<v-list-item-content>
								<v-list-item-title>Send us a message</v-list-item-title>
							</v-list-item-content>
						</v-list-item>
					</v-list>
				</v-col>
			</v-footer>-->
		</v-navigation-drawer>
		<v-app-bar color="white" app>
			<!-- <v-app-bar-nav-icon @click.stop="mini = !mini"></v-app-bar-nav-icon> -->

			<!-- <v-cols cols="8"> -->
			<v-icon
				color="grey"
				@click="
					$vuetify.breakpoint.mdAndUp
						? (mini = !mini)
						: (drawer = !drawer)
				"
			>mdi-menu</v-icon>
			<!-- <v-text-field
				v-if="$vuetify.breakpoint.mdAndUp"
				v-model="search"
				prepend-inner-icon="mdi-magnify"
				label="Search"
				single-line
				hide-details
			></v-text-field>-->
			<!-- </v-cols> -->

			<!-- <v-toolbar-title>Page title</v-toolbar-title> -->

			<v-spacer></v-spacer>

			<v-btn icon @click="goToPage('parent.inbox')">
				<v-icon>mdi-forum</v-icon>
			</v-btn>

			<v-menu left bottom>
				<template v-slot:activator="{ on }">
					<v-btn icon v-on="on">
						<v-icon>mdi-bell</v-icon>
					</v-btn>
				</template>

				<v-list>
					<v-list-item v-for="n in 5" :key="n" @click="() => {}">
						<v-list-item-title>Option {{ n }}</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>

			<v-menu offset-y bottom>
				<template v-slot:activator="{ on }">
					<v-avatar v-on="on">
						<v-img :src="user.profile_picture">
							<template v-slot:placeholder>
								<v-row class="fill-height grey ma-0" align="center" justify="center">
									<div class="headline text-center white--text text-bold" v-if="user.name">{{ user.name[0] }}</div>
								</v-row>
							</template>
						</v-img>
					</v-avatar>
				</template>

				<v-list>
					<v-list-item
						@click="
							() => {
								$router.push({ name: 'main.login' });
							}
						"
					>
						<v-list-item-title>Log Out</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>
		</v-app-bar>

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
			drawer: true,
			items: [
				{
					title: "Home",
					icon: "mdi-home-city",
					route: "parent.home",
					subItems: []
				},
				{
					title: "Dashboard",
					icon: "mdi-view-dashboard",
					route: "parent.dashboard",
					subItems: []
				},
				{
					title: "Inbox",
					icon: "mdi-inbox",
					route: "parent.inbox",
					subItems: []
				},
				{
					title: "Attendance",
					icon: "mdi-account-multiple-check",
					route: "parent.attendance",
					subItems: []
				},
				{
					title: "News & Announcements",
					icon: "mdi-newspaper",
					route: "parent.news",
					subItems: []
				},
				{
					title: "Calendar",
					icon: "mdi-calendar",
					route: "parent.calendar",
					subItems: []
				},
				{
					title: "Courses",
					icon: "mdi-book",
					route: "parent.courses",
					subItems: []
				},
				{
					title: "Resources",
					icon: "mdi-semantic-web",
					// route: "parent.courses",
					subItems: [
						{
							title: "Students",
							icon: "mdi-school",
							route: "parent.students",
							subItems: []
						},
						{
							title: "Staff",
							icon: "mdi-account-supervisor",
							route: "parent.staff",
							subItems: []
						},
						{
							title: "Admins",
							icon: "mdi-admin",
							route: "parent.admins",
							subItems: []
						},
						{
							title: "Colleges",
							icon: "mdi-teach",
							route: "parent.colleges",
							subItems: []
						},
						{
							title: "Departments",
							icon: "mdi-set-center",
							route: "parent.departments",
							subItems: []
						},
						{
							title: "Programs",
							icon: "mdi-golf",
							route: "parent.programs",
							subItems: []
						},
						{
							title: "School Assessments",
							icon: "mdi-golf",
							route: "parent.school-assessments",
							subItems: []
						}
					]
				},
				{
					title: "Residence",
					icon: "mdi-home",
					route: "parent.residence",
					subItems: [
						{
							title: "Halls",
							icon: "mdi-domain",
							route: "parent.halls",
							subItems: []
						},
						{
							title: "Room Types",
							icon: "mdi-domain",
							route: "parent.rooms.types",
							subItems: []
						},
						{
							title: "Rooms",
							icon: "mdi-domain",
							route: "parent.rooms",
							subItems: []
						},
						{
							title: "Allocation Settings",
							icon: "mdi-domain",
							route: "parent.rooms.settings",
							subItems: []
						}
					]
				},

				{
					title: "Fees",
					icon: "mdi-cash",
					route: "parent.fees",
					subItems: []
				},
				{
					title: "Financials",
					icon: "mdi-finance",
					route: "parent.financials",
					subItems: []
				},
				{
					title: "Reports",
					icon: "mdi-file-chart",
					route: "parent.reports",
					subItems: []
				},
				{
					title: "Applications",
					icon: "mdi-application",
					route: "parent.applications",
					subItems: []
				},
				{
					title: "Leave/Exeats",
					icon: "mdi-cloud-question",
					route: "parent.leave",
					subItems: []
				},
				{
					title: "Help Center",
					icon: "mdi-help",
					route: "parent.help",
					subItems: []
				},
				{
					title: "Settings",
					icon: "mdi-settings",
					route: "parent.settings",
					subItems: []
				}
			],
			mini: true,
			search: ""
		};
	},
	computed: {
		user() {
			let ans = this.$store.state.loggedInUser;
			if (ans) {
				return ans;
			}

			return {};
		}
	},
	methods: {
		goToPage(name) {
			this.$router.push({ name: name });
		}
	}
};
</script>
