<template>
  <v-app>
    <!-- <h1>Manage</h1> -->
    <v-container>
      <v-row>
        <v-col cols="12" md="3" sm="6">
          <metric-card title="Number of Advisees" :value="0" />
        </v-col>
        <v-col cols="12" md="3" sm="6">
          <metric-card title="Approved Enrollments" :value="0" />
        </v-col>
        <v-col cols="12" md="3" sm="6">
          <metric-card title="Pending Enrollments" :value="0" />
        </v-col>
        <v-col cols="12" md="3" sm="6"></v-col>
        <v-col cols="12" md="4" sm="7">
          <v-text-field
            v-model="search"
            flat
            label="Search courses"
            solo
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <v-col cols="12">
          <v-card class="mt-4 pa-3">
            <v-subheader class="d-flex mb-4 pa-0">
              <div class="fs-5 font-italic">
                <v-icon size="10" class="mr-1" color="blue">mdi-information</v-icon>Click table item to view
              </div>
              <v-spacer></v-spacer>
              <div class="d-flex align-center justify-end">
                <v-btn color icon>
                  <v-icon color="grey" size="18">mdi-filter</v-icon>
                  <div>Filter</div>
                </v-btn>
                <div>
                  <v-btn color icon>
                    <v-icon color="grey" size="18">mdi-dots-vertical</v-icon>
                  </v-btn>
                </div>
              </div>
            </v-subheader>
            <v-data-table
              :search="search"
              @click:row="goToPage"
              :headers="headers"
              :items="students"
              hide-default-footer
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
  components: {
    MetricCard
  },
  data() {
    return {
      students: [],
      search: "",
      headers: [
        { text: "NAME ", value: "name", sortable: false },
        {
          text: "MATRIC NUMBER",
          align: "start",
          sortable: false,
          value: "matric_number"
        },
        { text: "LEVEL", value: "level", sortable: false },
        { text: "PROGRAM", value: "program.name", sortable: false }
        // {
        // 	text: "REGISTERED UNITS",
        // 	value: "total_units",
        // 	sortable: false
        // },
        // {
        // 	text: "APPROVAL STATUS",
        // 	value: "approval_status",
        // 	sortable: false
        // }
      ]
    };
  },
  methods: {
    goToPage(v) {
      // console.log(v);
      this.$router.push({
        name: "staff.courses.approve",
        params: { id: v.matric_number }
      });
    }
  },
  async mounted() {
    try {
      let res = await this.$store.dispatch("getAdvisees");
      this.students = res.data;
    } catch (error) {
      console.log(error);
    }
  }
};
</script>