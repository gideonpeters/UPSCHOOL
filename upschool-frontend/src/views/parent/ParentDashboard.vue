<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col cols="12">
          <div>Dashboard</div>
        </v-col>
        <v-col cols="12" md="3">
          <metric title="Total Students" :value="students.length" routeName="parent.students" />
        </v-col>
        <v-col cols="12" md="3">
          <metric title="Total Staff" :value="staff.length" routeName="parent.staff" />
        </v-col>
        <v-col cols="12" md="3">
          <metric
            title="Total Departments"
            :value="departments.length"
            routeName="parent.students"
          />
        </v-col>
        <v-col cols="12" md="3">
          <metric title="Total Colleges" :value="colleges.length" routeName="parent.students" />
        </v-col>
        <v-col cols="12">
          <v-card class="pa-3">
            <v-subheader>Statistics</v-subheader>
            <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
          </v-card>
        </v-col>
        <v-col cols="12">
          <div class>
            <v-row>
              <v-col cols="12" md="8">
                <v-card class="pa-3">
                  <div class="d-flex align-center">
                    <v-subheader>Attendance</v-subheader>
                    <v-spacer></v-spacer>
                    <v-btn
                      color="primary"
                      x-small
                      text
                      @click="goToPage('parent.attendance')"
                    >VIEW ATTENDANCE</v-btn>
                  </div>
                  <apexchart
                    type="bar"
                    height="350"
                    :options="attendanceChart.chartOptions"
                    :series="attendanceChart.series"
                  ></apexchart>
                </v-card>
              </v-col>
              <v-col cols="12" md="4">
                <div class="flex-column">
                  <div>
                    <v-card class="pa-3">
                      <v-subheader class="pa-0">Birthdays</v-subheader>

                      <div class="d-flex fs-4 mb-3">
                        <div class="pr-4">
                          <v-icon size="15">mdi-circle-slice-8</v-icon>
                        </div>
                        <div>Professor AAA. Atayero</div>
                      </div>
                      <div class="d-flex fs-4 mb-3">
                        <div class="pr-4">
                          <v-icon size="15">mdi-circle-slice-8</v-icon>
                        </div>
                        <div>Francess Oyelade</div>
                      </div>
                    </v-card>
                  </div>

                  <div class="mt-4">
                    <v-card class="pa-3">
                      <div class="d-flex align-center">
                        <v-subheader class="pa-0">News Feed</v-subheader>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="primary"
                          text
                          x-small
                          @click="goToPage('parent.news')"
                        >View all</v-btn>
                      </div>

                      <div class="d-flex fs-4 mb-3" v-for="(item, i) in news" :key="i">
                        <div class="pr-4">
                          <v-icon size="15">mdi-circle-slice-8</v-icon>
                        </div>
                        <div>{{ item.title }}</div>
                      </div>
                    </v-card>
                  </div>
                </div>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import Metric from "./../../components/parent/Metric";
import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    Metric,
    apexchart: VueApexCharts
  },
  name: "dashboard",
  data() {
    return {
      series: [
        {
          name: "Number of Students",
          data: [31, 40, 28, 51, 42, 109, 100]
        },
        {
          name: "Number of Staff",
          data: [11, 32, 45, 32, 34, 52, 41]
        }
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "area"
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: "smooth"
        },
        xaxis: {
          type: "string",
          categories: [
            "2017",
            "2018",
            "2019",
            "2020"
            // "2018-09-19T01:30:00.000Z",
            // "2018-09-19T02:30:00.000Z",
            // "2018-09-19T03:30:00.000Z",
            // "2018-09-19T04:30:00.000Z",
            // "2018-09-19T05:30:00.000Z",
            // "2018-09-19T06:30:00.000Z"
          ]
        },
        tooltip: {
          x: {
            format: "dd/MM/yy HH:mm"
          }
        }
      },
      attendanceChart: {
        series: [
          // {
          // 	name: "Net Profit",
          // 	data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
          // },
          {
            name: "Revenue",
            data: [76, 85, 100, 98, 87]
          }
          // {
          // 	name: "Free Cash Flow",
          // 	data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
          // }
        ],
        chartOptions: {
          chart: {
            type: "bar",
            height: 350
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "8%",
              endingShape: "rounded"
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 2,
            colors: ["transparent"]
          },
          xaxis: {
            categories: [
              "100 level",
              "200 level",
              "300 level",
              "400 level",
              "500 level"
              // "Jul",
              // "Aug",
              // "Sep",
              // "Oct"
            ]
          },
          yaxis: {
            title: {
              text: "Attendance (%)"
            }
          },
          fill: {
            opacity: 1
          },
          tooltip: {
            y: {
              formatter: function(val) {
                return "$ " + val + " thousands";
              }
            }
          }
        }
      }
    };
  },
  computed: {
    news() {
      return this.$store.state.news;
    },
    staff() {
      return this.$store.state.staff;
    },
    students() {
      return this.$store.state.students;
    },
    colleges() {
      return this.$store.state.colleges;
    },
    departments() {
      return this.$store.state.departments;
    }
  },
  mounted() {
    this.$store.dispatch("setupDashboard");
  },
  methods: {
    goToPage(name) {
      this.$router.push({ name });
    }
  }
};
</script>
