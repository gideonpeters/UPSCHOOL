<template>
  <v-app>
    <v-navigation-drawer
      style="color: white"
      v-model="drawer"
      color="white"
      :mini-variant.sync="mini"
      permanent
      app
    >
      <!-- <v-list>
				<v-list-item class="px-2">
					<v-list-item-avatar>
						<v-img
							src="https://randomuser.me/api/portraits/women/85.jpg"
						></v-img>
					</v-list-item-avatar>
				</v-list-item>

				<v-list-item link>
					<v-list-item-content>
						<v-list-item-title class="title"
							>AAA Atayero</v-list-item-title
						>
						<v-list-item-subtitle
							>aaa@gmail.com</v-list-item-subtitle
						>
					</v-list-item-content>
				</v-list-item>
      </v-list>-->

      <v-list>
        <v-list-item>
          <v-list-item-icon @click="mini = !mini">
            <v-icon v-text="'mdi-menu'" />
          </v-list-item-icon>
          <v-list-item-title />
        </v-list-item>
      </v-list>

      <v-divider></v-divider>
      <v-list>
        <v-list-group
          class
          v-for="(item, indx) in items"
          :key="indx"
          exact
          @click="!item.subMenus ? goToPage(item.route) : ''"
          :to="{ name: item.route }"
          active-class="text--primary"
          :prepend-icon="item.icon"
          :append-icon="
						item.subMenus ? 'mdi-chevron-down' : 'mdi-nothing'
					"
        >
          <template v-slot:activator>
            <v-list-item-title class="fs-3">{{ item.title }}</v-list-item-title>
          </template>

          <v-list-group
            v-for="(subMenu, idx) in item.subMenus"
            :key="idx"
            no-action
            sub-group
            :prepend-icon="
							!subMenu.data ? 'mdi-nothing' : 'mdi-menu-down'
						"
            exact
            @click="!subMenu.data ? goToPage(subMenu.route) : ''"
            :to="{ name: subMenu.route }"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title class="fs-3">
                  {{
                  subMenu.title
                  }}
                </v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="(data, i) in subMenu.data"
              :key="i"
              link
              @click="!data.data ? goToPage(data.route) : ''"
            >
              <v-list-item-title v-text="data[0]" class="fs-3" />
              <v-list-item-icon>
                <v-icon v-text="data[1]" />
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>

          <!-- <v-list-group sub-group no-action>
						<template v-slot:activator>
							<v-list-item-content>
								<v-list-item-title>Actions</v-list-item-title>
							</v-list-item-content>
						</template>
						<v-list-item v-for="(crud, i) in cruds" :key="i">
							<v-list-item-title v-text="crud[0]" />
							<v-list-item-action>
								<v-icon v-text="crud[1]" />
							</v-list-item-action>
						</v-list-item>
          </v-list-group>-->
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
    <v-card :ripple="false" color="grey lighten-4" flat height="100%" tile>
      <v-app-bar app class="primary-box-shadow disable-dbl-tap-zoom" height="80">
        <!-- <v-app-bar-nav-icon :ripple="false" size="30" @click.stop="mini = !mini">
					<v-icon>$vuetify.icons.sidebar-dashboard</v-icon>
        </v-app-bar-nav-icon>-->
        <v-toolbar-title>
          <div class="nav-title text-truncate">{{ navTitle }}</div>
        </v-toolbar-title>

        <v-spacer />

        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>

        <v-btn icon>
          <v-icon>mdi-bell-outline</v-icon>
        </v-btn>

        <v-btn icon>
          <v-icon>mdi-message-outline</v-icon>
        </v-btn>

        <v-avatar class="ml-4">
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
        </v-avatar>
      </v-app-bar>
    </v-card>

    <v-content>
      <v-container fluid class="pa-4">
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
      search: "",
      items: [
        {
          title: "Dashboard",
          icon: "mdi-18px mdi-view-dashboard",
          route: "admin.dashboard"
        },
        {
          title: "Students",
          icon: "mdi-18px mdi-account-multiple",
          subMenus: [
            {
              title: "List",
              route: "admin.students.list"

              // data: [
              // 	["Create", "add"],
              // 	["Read", "insert_drive_file"],
              // 	["Update", "update"],
              // 	["Delete", "delete"]
              // ]
            }
          ]
        },
        {
          title: "Staff",
          icon: "mdi-18px mdi-account-multiple",
          subMenus: [
            {
              title: "Manage",
              data: [
                ["Create", "add"],
                ["Read", "insert_drive_file"],
                ["Update", "update"],
                ["Delete", "delete"]
              ]
            }
          ]
        },
        {
          title: "Admission",
          icon: "mdi-18px mdi-newspaper-variant-multiple",
          route: "admin.admissions"
        },
        {
          title: "Attendance",
          icon: "mdi-18px mdi-marker",
          subMenus: [
            { title: "Attendable Events", route: "admin.events" },
            {
              title: "Student Attendance",
              route: "admin.events.students"
            },
            {
              title: "Staff Attendance",
              route: "admin.events.staff"
            }
          ]
        },
        { title: "Classes", icon: "mdi-18px mdi-book-variant" },

        { title: "Fees", icon: "mdi-18px mdi-cash-100" },
        {
          title: "Accounts",
          icon: "mdi-18px mdi-account-box-multiple"
        },
        { title: "Reports", icon: "mdi-18px mdi-file-chart" },
        {
          title: "Examination",
          icon: "mdi-18px mdi-newspaper-variant"
        },
        {
          title: "Employees",
          icon: "mdi-18px mdi-briefcase-account",
          subMenus: [
            { title: "List of employees" },
            { title: "Payroll" },
            { title: "Leave Management" }
          ]
        },
        { title: "Messages/SMS", icon: "mdi-18px mdi-contact-mail" },
        {
          title: "Settings",
          icon: "mdi-18px mdi-settings",
          subMenus: [
            {
              title: "Academic Calendar"
            }
          ]
        },
        { title: "Users", icon: "mdi-18px mdi-account-group-outline" },
        { title: "Tools", icon: "mdi-18px mdi-tools" },
        { title: "Help", icon: "mdi-18px mdi-help-box" }
      ],
      admins: [
        ["Management", "mdi-18px mdi-account-group"],
        ["Settings", "mdi-18px mdi-settings"]
      ],
      cruds: [
        ["Create", "add"],
        ["Read", "insert_drive_file"],
        ["Update", "update"],
        ["Delete", "delete"]
      ],
      mini: false
    };
  },
  computed: {
    navTitle() {
      let metaTitle = this.$route.meta.title;
      let title = metaTitle ? metaTitle : "Dashboard";
      return title;
    }
  },
  methods: {
    goToPage(route) {
      return this.$router.push({ name: route }).catch(err => {
        err;
      });
    }
  }
};
</script>
 
<style lang="scss" scoped>
$primary-color: #683587;

.v-navigation-drawer::-webkit-scrollbar {
  width: 6px;
  // color: green;
  background-color: #f5f5f5;
}

.v-navigation-drawer::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #f5f5f5;
}

.fs-3 {
  font-size: 0.9rem;
}

i.v-icon {
  font-size: 18px;
}
.v-navigation-drawer::-webkit-scrollbar-thumb {
  background-color: $primary-color;
  outline: 1px solid slategrey;
}
.v-navigation-drawer__content::-webkit-scrollbar {
  width: 6px;
  background-color: #f5f5f5;
}

.v-navigation-drawer__content::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #f5f5f5;
}

.v-navigation-drawer__content::-webkit-scrollbar-thumb {
  background-color: $primary-color;
  outline: 1px solid slategrey;
}
.v-navigation-drawer {
  // display: none !important;

  .v-navigation-drawer__content {
    // display: none !important;
  }
}
</style>
