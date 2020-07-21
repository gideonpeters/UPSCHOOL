<template>
  <div>
    <v-container fluid class="pa-0">
      <v-row wrap>
        <v-col cols="12" sm="12" md="12">
          <div class="d-flex flex-lg-row flex-column align-baseline py-3">
            <div class="fs-2 font-weight-light">Welcome, {{ user.first_name }}!</div>
            <v-spacer></v-spacer>
            <div>{{ date.toDateString() }}</div>
          </div>
          <v-divider></v-divider>
        </v-col>
        <v-col cols="12" sm="12" md="8">
          <div class="d-flex flex-column">
            <featured-card
              :route="isStudent? 'student.news':  'staff.news'"
              :latestNews="latestNews"
              :handleClick="goToNews"
            />
            <div>
              <v-card class="pa-3 mb-5" flat>
                <custom-header
                  data-v-step="1"
                  title="TODAY'S SCHEDULE"
                  ctaText="View full schedule"
                  route="student.calendar"
                ></custom-header>
                <div>
                  <v-data-table
                    :headers="headers"
                    :items="schedule"
                    hide-default-header
                    hide-default-footer
                  >
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
                        <div>{{ moment(item.start_time).format("LT") }} - {{ moment(item.end_time).format("LT") }}</div>
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
                      <custom-header
                        title="UPCOMING C.A."
                        ctaText="View all"
                        route="student.courses.grading"
                      ></custom-header>
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
														toggle,
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
                      <custom-header
                        data-v-step="2"
                        title="PENDING SUBMISSIONS"
                        ctaText="View all"
                        :route="
													routeName(
														'courses.assignments'
													)
												"
                      ></custom-header>
                    </v-col>
                    <v-col cols="12">
                      <assignment-table isDashboard :isStudent="isStudent" :isStaff="isStaff" />
                    </v-col>
                  </v-row>
                </v-container>
              </v-card>
            </div>
            <!-- <v-card class="pa-3 mb-5" flat>
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
														toggle,
													}"
												>
													<quiz-card class :input-value="active" @click="toggle" />
												</v-slide-item>
											</v-slide-group>
										</v-col>
									</v-row>
								</v-container>
            </v-card>-->
          </div>
        </v-col>
        <v-col cols="12" sm="12" md="4">
          <div class="d-flex flex-column justify-center align-center">
            <div>
              <v-card class="pa-3 mb-5" flat v-if="isStudent">
                <v-container fluid>
                  <v-row justify="center">
                    <v-col cols="12">
                      <custom-header
                        title="ACADEMIC PROGRESS"
                        ctaText="View"
                        route="student.profile"
                      ></custom-header>
                    </v-col>
                    <v-col cols="4" sm="6" class="px-5">
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
                      <div v-if="isStudent">
                        <div class="d-flex flex-column">
                          <div class="font-weight-bold fs-4">PROGRAM</div>
                          <div class="fs-4" v-if="user.program">
                            {{
                            user.program.name
                            }}
                            ({{
                            user.program
                            .degree
                            .short_name
                            }})
                          </div>
                        </div>
                        <div class="d-flex flex-column mt-4">
                          <div class="font-weight-bold fs-4">STATUS</div>
                          <div class="fs-4">
                            PROMOTED:
                            {{ user.level }}
                            Level
                          </div>
                        </div>
                      </div>
                    </v-col>
                  </v-row>
                  <v-divider></v-divider>
                  <v-row v-if="isStudent">
                    <v-col cols="12">
                      <custom-header title="CREDITS TO GRADUATE"></custom-header>
                      <div class="fs-3">
                        <div>
                          You need a total of
                          {{
                          user.program
                          ? user.program
                          .min_graduation_units
                          : ""
                          }}
                          units to graduate
                        </div>
                        <div class="d-flex mt-3">
                          <div>
                            Current credits
                            achieved:
                          </div>
                          <v-spacer></v-spacer>
                          <div class="font-weight-bold mr-5">
                            {{
                            user.credits_achieved
                            }}
                          </div>
                        </div>
                      </div>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card>
            </div>
            <v-card class="pa-3 mb-5" flat>
              <v-container fluid class="pa-0">
                <v-row no-gutters>
                  <v-col cols="12">
                    <custom-header
                      title="NEWS"
                      ctaText="View more"
                      :route="
													isStudent
														? 'student.news'
														: 'staff.news'
												"
                    ></custom-header>
                  </v-col>
                  <v-col>
                    <div class="d-flex flex-column">
                      <div
                        class="fs-3 text-uppercase font-weight-bold grey--text"
                      >{{ latestNews.title }}</div>
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
            <v-card class="pa-3 mb-5" flat min-width="100%">
              <v-container fluid class="pa-0">
                <v-row no-gutters>
                  <v-col cols="12">
                    <custom-header title="EVENTS" ctaText="View more" route="student.news"></custom-header>
                  </v-col>
                  <v-col cols="12">
                    <div v-if="latestEvent">
                      <div
                        class="fs-3 text-uppercase font-weight-bold grey--text"
                      >{{ latestEvent.name }}</div>
                      <v-card
                        min-width="100%"
                        flat
                        max-height="76"
                        v-line-clamp:20="4"
                        class="fs-4 d-flex text-wrap"
                      >
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
            <!-- <v-card class="pa-3 mb-5" flat>
								<v-container fluid class="pa-0">
									<v-row no-gutters>
										<v-col cols="12">
											<custom-header title="CALENDAR" cta-text="View" route="student.calendar" />
										</v-col>
										<v-col>
											<dashboard-calendar />
										</v-col>
									</v-row>
								</v-container>
            </v-card>-->
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import QuizCard from "@/components/general/QuizCard";
import FeaturedCard from "@/components/general/FeaturedCard";
// import DashboardCalendar from "@/components/general/Calendar";
import AssignmentTable from "@/components/general/AssignmentTable";
import Axios from "axios";

export default {
  components: {
    QuizCard,
    // DashboardCalendar,
    AssignmentTable,
    FeaturedCard
  },
  props: {
    isStaff: {
      type: Boolean,
      default: false
    },
    isStudent: {
      type: Boolean,
      default: false
    }
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
        { text: "ICON", value: "check" },
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
        { text: "DUE DATE", value: "time", sortable: false }
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
      ],
      schedule: [],
      uri: process.env.VUE_APP_BACKEND_IMAGE_URI
    };
  },
  computed: {
    latestNews() {
      return this.$store.state.news ? this.$store.state.news[0] : {};
    },
    latestEvent() {
      return this.$store.state.schoolEvents
        ? this.$store.state.schoolEvents[0]
        : {};
    },
    user() {
      return this.$store.state.loggedInUser;
    },
    value() {
      let ans = this.user.program
        ? (this.user.credits_achieved /
            this.user.program.min_graduation_units) *
          100
        : 0;
      return ans;
    }
  },
  methods: {
    goToPage(name, id) {
      this.$router.push({ name: name, params: { id: id } });
    },
    getCourse(id) {
      return this.$store.getters.getCourseById(id);
    },
    routeName(route) {
      if (this.isStudent) {
        route = "student." + route;
      } else if (this.isStaff) {
        route = "staff." + route;
      }
      return route;
    },
    goToNews(id) {
      if (this.isStudent) {
        return this.$router.push({
          name: "student.news.details",
          params: { id: id }
        });
      } else if (this.isStaff) {
        return this.$router.push({
          name: "staff.news.details",
          params: { id: id }
        });
      } else if (this.isAdmin) {
        return this.$router.push({
          name: "parent.news.details",
          params: { id: id }
        });
      }
      // this.$router.push({
      // 	name: "parent.news.details",
      // 	params: { id: id }
      // });
    }
  },
  async mounted() {
    try {
      this.$store.dispatch("getNews");
      this.$store.dispatch("getSchoolEvents");
      let res = await Axios.get("event");
      // console.log(res.data);

      this.schedule = res.data.data.filter(item =>
        this.moment().isSame(this.moment(item.start_time), "day")
      );
      if (this.isStaff) {
        this.asgnHeaders.push({
          text: "ACTIONS",
          value: "action",
          sortable: false
        });
      }
    } catch (error) {
      throw error;
    }
  }
};
</script>

<style lang="scss" scoped>
.border-dashed {
  border-bottom: 1px dashed purple;
}
</style>
