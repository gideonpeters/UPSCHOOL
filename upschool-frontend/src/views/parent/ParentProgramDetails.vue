<template>
  <v-app>
    <div class="d-flex align-center">
      <v-btn color="grey" icon @click="$router.go(-1)">
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <div>{{program.name}}</div>
    </div>

    <v-row>
      <v-col cols="4">
        <metric-card title="Number of students" :value="120" />
      </v-col>
      <v-col cols="12">
        <div>
          <v-tabs v-model="currentItem" fixed-tabs slider-color="white">
            <v-tab v-for="item in items" :key="item" :href="'#tab-' + item">{{ item }}</v-tab>

            <v-menu v-if="more.length" bottom left>
              <template v-slot:activator="{ on }">
                <v-btn text class="align-self-center mr-4" v-on="on">
                  more
                  <v-icon right>mdi-menu-down</v-icon>
                </v-btn>
              </template>

              <v-list class="grey lighten-3">
                <v-list-item v-for="item in more" :key="item" @click="addItem(item)">{{ item }}</v-list-item>
              </v-list>
            </v-menu>
          </v-tabs>
        </div>

        <div>
          <v-tabs-items v-model="currentItem">
            <v-tab-item v-for="item in items.concat(more)" :key="item" :value="'tab-' + item">
              <div class="pa-4">{{ tabText(item) }}</div>
              <!-- <div class="pa-5">
                <v-card flat v-if="item == 'Profile'" min-height="500"></v-card>
              </div>-->
              <!-- 
              <div class="pa-5">
                <v-card
                  class="mt-0 pt-0"
                  flat
                  v-if="item == 'General Information'"
                  min-height="500"
                ></v-card>
              </div>-->
              <div class="px-5">
                <v-card class="mt-0 pt-0" flat v-if="item == 'Curriculum'" min-height="500">
                  <v-row justify="end">
                    <v-dialog v-model="dialog" fullscreen persistent max-width="600px">
                      <template v-slot:activator="{ on }">
                        <v-btn
                          color="primary"
                          depressed
                          dark
                          v-on="on"
                          class="mb-3"
                        >Manage Curriculum</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">
                            Program
                            Curriculum
                          </span>
                        </v-card-title>
                        <v-card-text>
                          <v-container>
                            <v-row>
                              <v-col cols="12" sm="6">
                                <v-select
                                  :items="[
																		'Elective',
																		'NUC',
																		'SIWES',
																		'SWEP'
																	]"
                                  label="Select Course Type"
                                  required
                                ></v-select>
                              </v-col>
                              <v-col cols="12" sm="6">
                                <v-select
                                  :items="[
																		'100',
																		'200',
																		'300',
																		'400',
																		'500'
																	]"
                                  label="Select Level"
                                  required
                                ></v-select>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Credit Unit" type="number" required></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6">
                                <v-select :items="courses" label="Select Course" required></v-select>
                              </v-col>
                            </v-row>
                          </v-container>
                          <small>
                            *indicates required
                            field
                          </small>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                          <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-row>
                  <v-tabs vertical>
                    <v-tab v-for="level in levels" :key="level">{{ level }} Level</v-tab>

                    <v-tab-item v-for="level in levels" :key="level" :href="'tab-' + level">
                      <v-card flat>
                        <v-card-text>
                          <curriculum-item
                            @updateItem="getCurricula"
                            :level="`${level}`"
                            v-for="curriculumItem in curricula.filter(
															it =>
																it.level ==
																level
														)"
                            :status="
															curriculumItem.status
														"
                            :key="curriculumItem.id"
                            :curriculumItem="
															curriculumItem
														"
                          />
                        </v-card-text>
                      </v-card>
                    </v-tab-item>
                  </v-tabs>
                </v-card>
              </div>
              <div class="pa-5">
                <v-card flat v-if="item == 'Students'" min-height="500">
                  <v-data-table :headers="headers" :items="students"></v-data-table>
                </v-card>
              </div>
              <div class="pa-5">
                <v-card flat v-if="item == 'Profile'" min-height="500"></v-card>
              </div>
            </v-tab-item>
          </v-tabs-items>
        </div>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import CurriculumItem from "@/components/general/CurriculumItem";

export default {
  components: {
    MetricCard,
    CurriculumItem
  },
  data() {
    return {
      currentItem: "tab-Curriculum",
      program: {},
      dialog: false,
      curriculumTab: null,
      levels: [100, 200, 300, 400, 500],
      items: ["Curriculum", "Students"],
      courses: [],
      more: [
        // "Finances",
        "Graduation Requirements"
        // "Issues"
        // "Flights",
        // "Apps"
      ],
      curricula: [],
      headers: [
        {
          text: "Name",
          align: "left",
          // sortable: false,
          value: "name"
        },
        { text: "Matriculation Number", value: "matric_number" },
        { text: "Registration Number", value: "reg_number" },
        { text: "Program", value: "program.name" },
        { text: "Grade/Level", value: "level" },
        // { text: "Residence", value: "residence" },
        { text: "Actions", value: "action", sortable: false }
      ],
      students: []
    };
  },
  computed: {
    courseStatuses() {
      return this.$store.state.course_statuses;
    }
  },
  methods: {
    tabText(item) {
      let res;
      switch (item) {
        case "Graduation Requirements":
          res = `To graduate from the 5-year Bachelor of Engineering (B.Eng) Degree Programme in ${this.program.name}, students must have successfully completed a minimum of ${this.program.min_graduation_units} Credit Units as shown:`;
          break;
        case "Curriculum":
          res = `This is the outlined curriculum for the the 5-year Bachelor of Engineering (B.Eng) Degree Programme in ${this.program.name}, students must have successfully completed a minimum of ${this.program.min_graduation_units} Credit Units as shown in the graduation requirements`;
          break;
        case "Profile":
          res = `Academic Information outlined below`;
          break;
        case "Issues":
          res = `These are points or important notes or records for the selected student. They could range from awards or commendations to disciplinary cases`;
          break;
        default:
          res = "";
          break;
      }
      return res;
    },
    addItem(item) {
      const removed = this.items.splice(0, 1);
      this.items.push(...this.more.splice(this.more.indexOf(item), 1));
      this.more.push(...removed);
      this.$nextTick(() => {
        this.currentItem = "tab-" + item;
      });
    },
    commitAction() {},
    async getCurricula() {
      try {
        let id = this.$route.params.id;
        this.curricula = await this.$store.dispatch("getCurricula", id);
      } catch (error) {
        console.log(error);
      }
    },
    async getProgramById() {
      try {
        let id = this.$route.params.id;
        this.$store
          .dispatch("getProgramById", id)
          .then(res => (this.program = res));
      } catch (error) {
        throw error;
      }
    }
  },
  async mounted() {
    try {
      this.getProgramById();
      await this.$store.dispatch("getCourseStatus");
      await this.$store.dispatch("getAllCourses");
      this.getCurricula();
    } catch (error) {
      console.log(error);
    }
  }
};
</script>
