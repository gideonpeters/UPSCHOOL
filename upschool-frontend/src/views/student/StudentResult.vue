<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col cols="12" md="7" sm="12">
          <v-card class="primary-box-shadow pa-3 my-3" flat>
            <v-subheader>RESULT OVERVIEW</v-subheader>
            <div class="d-flex flex-wrap flex-lg-column">
              <div class="d-flex flex-lg-row flex-column">
                <div class="d-flex justify-center">
                  <passed-courses rate="3.26" number="10" />
                </div>
                <div class="d-flex justify-center">
                  <passed-courses rate="-1.9" number="2" :status="1" />
                </div>
                <!-- <div class="d-flex">fkfk</div> -->
              </div>
              <div class="d-flex flex-lg-row flex-column">
                <div class="d-flex justify-center">
                  <passed-courses rate="+2.4" number="4.96" :status="2" />
                </div>
                <div class="d-flex justify-center">
                  <passed-courses rate="+1.2" number="4.89" :status="3" />
                </div>
              </div>
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" md="5">
          <v-card class="primary-box-shadow py-3 px-5 my-3" flat>
            <div class="d-flex justify-space-between">
              <div class="d-flex flex-column">
                <div>OVERVIEW</div>
                <div>RESULT CHART</div>
              </div>
              <div>
                <v-btn
                  color="primary"
                  class="course-btn pointer"
                  @click="isFullReport = false"
                >View full report</v-btn>
              </div>
            </div>
            <apexchart type="donut" width="380" :options="chartOptions" :series="series" />
          </v-card>
        </v-col>
        <v-col cols="12">
          <v-card>
            <v-row>
              <v-col cols="12">
                <v-subheader>FAILED COURSES</v-subheader>
              </v-col>
              <v-col cols="12">
                <v-data-table></v-data-table>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import Metric from "@/components/student/result/Metric";
import VueApexCharts from "vue-apexcharts";
// import ResultItem from "@/components/student/result/ResultItem";

export default {
  components: {
    "passed-courses": Metric,
    apexchart: VueApexCharts
    // ResultItem,
  },
  props: {
    // labels: {
    // 	// type: Array,
    // 	default: ["Apple", "Mango", "Banana", "Papaya", "Orange"]
    // }
  },
  data: () => ({
    selectedTab: 1,
    model: null,
    isFullReport: true,
    tabs: [
      { text: "100 LVL", value: 1 },
      { text: "200 LVL", value: 2 },
      { text: "300 LVL", value: 3 },
      { text: "400 LVL", value: 4 },
      { text: "500 LVL", value: 5 }
    ],
    semesters: ["ALPHA", "OMEGA"],
    series: [23, 11, 54, 72],

    chartOptions: {
      dataLabels: {
        enabled: false
      },
      labels: [
        "Passed Courses",
        "Failed Courses",
        "Current GPA",
        "Current CGPA"
      ],
      plotOptions: {
        pie: {
          donut: {
            size: "35%"
          }
        }
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              show: false
            }
          }
        }
      ],
      legend: {
        position: "right",
        offsetY: 0,
        height: 300
        // formatter: (seriesName, opts) => {
        // 	// this.labels
        // 	// eslint-disable-next-line
        // 	// console.log(seriesName, opts.w.globals, gdf);
        // 	return [seriesName, "-", opts.w.global[opts.seriesIndex]];
        // }
      }
    }
  }),
  computed: {
    studentCoursesResult() {
      return this.$store.state.student_courses;
    }
  }
};
</script>

<style lang="scss" scoped>
.result-btn {
  color: #683587;
  border-radius: 5px;
  border: 0.5px solid #683587;
}

.result-table {
  letter-spacing: 0.01785714em;
  // font-family: Roboto,Arial,sans-serif;
  font-size: 0.95rem;
  font-weight: 500;
  line-height: 1.25rem;
  color: #5f6368;
  overflow: hidden;
  padding: 4px;
  text-overflow: ellipsis;
  vertical-align: middle;
  white-space: nowrap;

  .thead {
    color: white;
    font-size: 0.8rem;
    background-color: #683587;
  }
}
</style>
