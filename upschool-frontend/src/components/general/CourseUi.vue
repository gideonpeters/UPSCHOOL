<template>
  <div>
    <v-container>
      <v-row v-if="personal" align="center">
        <v-col cols="12" md="4" sm="6">
          <v-skeleton-loader
            transition="scale-transition"
            :loading="isLoadingCourses"
            height="94"
            type="list-item-two-line"
          >
            <metric-card
              :title="isStudent ?'Number of enrolled courses':'Number of facilitated courses'"
              :value="courses.length"
            />
          </v-skeleton-loader>
        </v-col>
      </v-row>
      <v-row align="center">
        <v-col cols="12" md="4" sm="8">
          <v-text-field
            v-model="search"
            flat
            label="Search courses"
            solo
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <!-- <v-col cols="12" md="3">
          <v-combobox
            outlined
            v-model="selectCategory"
            :items="categories.map(category => category.title)"
            label="Filter Categories"
            clearable
            multiple
            chips
          ></v-combobox>
        </v-col>-->

        <v-col cols="12" md="2" v-if="!isStudent">
          <div class="text-lg-right">
            <v-menu offset-y close-on-click close-on-content-click>
              <template v-slot:activator="{ on }">
                <v-btn color="primary" depressed dark v-on="on">ACTIONS</v-btn>
              </template>
              <v-list>
                <v-list-item v-for="(item, index) in items" :key="index">
                  <v-list-item-title class="pointer" @click="item.fn">{{ item.title }}</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
          <div class>
            <v-dialog
              v-model="dialogFull"
              fullscreen
              hide-overlay
              transition="dialog-bottom-transition"
            >
              <v-card>
                <v-toolbar dark color="primary">
                  <v-btn icon dark @click="dialogFull = false">
                    <v-icon>mdi-close</v-icon>
                  </v-btn>
                  <v-toolbar-title>CREATE COURSE(S)</v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-toolbar-items>
                    <v-btn
                      dark
                      text
                      :disabled="
												isBulk
													? !dummy || dummy.length < 0
													: null
											"
                      @click="saveBulk"
                    >Save</v-btn>
                  </v-toolbar-items>
                </v-toolbar>
                <v-checkbox label="Bulk Addition" v-model="isBulk"></v-checkbox>
                <v-list three-line subheader v-if="!isBulk">
                  <v-list-item>
                    <v-list-item-content>
                      <v-container>
                        <v-list-item-title>
                          Create
                          Course
                        </v-list-item-title>
                        <v-row align="center">
                          <v-col cols="6">
                            <v-text-field
                              outlined
                              label="Course Title"
                              v-model="
																courseTitle
															"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="6">
                            <v-text-field outlined label="Course Code" v-model="courseCode"></v-text-field>
                          </v-col>
                          <!-- <v-col cols="6">
                            <v-text-field outlined label="Credit Unit(s)" v-model="creditUnit"></v-text-field>
                          </v-col>-->
                          <!-- <v-col class="d-flex" cols="12" sm="6">
                            <v-select
                              :items="
																semesterTypes
															"
                              label="Semester Type"
                              outlined
                            >
                              <template v-slot:item="{
																	item
																}">
                                {{
                                item.title
                                }}
                              </template>
                              <template
                                v-slot:selection="{
																	item
																}"
                              >
                                {{
                                item.title
                                }},
                              </template>
                            </v-select>
                          </v-col>-->
                          <v-col cols="12">
                            <div class="d-flex">
                              <v-spacer></v-spacer>
                              <v-btn color="success" depressed @click="saveCourse">SAVE</v-btn>
                            </div>
                          </v-col>
                        </v-row>
                        <v-row align="center">
                          <v-col cols="12">
                            <v-subheader class="pa-0">CATEGORIES</v-subheader>
                          </v-col>
                          <v-col cols="6">
                            <v-combobox
                              v-model="select"
                              :items="optionItems"
                              label="What Category"
                              multiple
                              outlined
                            >
                              <template v-slot:item="{
																	item
																}">
                                {{
                                item.title
                                }}
                              </template>
                              <template
                                v-slot:selection="{
																	item
																}"
                              >
                                {{
                                item.title
                                }},
                              </template>
                            </v-combobox>
                          </v-col>
                          <v-col
                            class="d-flex"
                            cols="12"
                            sm="6"
                            v-for="(cat,
														indx) in select"
                            :key="indx"
                          >
                            <v-select
                              :items="
																cat.subCategories
															"
                              :label="
																`Select sub-category for ${cat.title}`
															"
                              outlined
                            >
                              <template v-slot:item="{
																	item
																}">
                                {{
                                item.title
                                }}
                              </template>
                              <template
                                v-slot:selection="{
																	item
																}"
                              >
                                {{
                                item.title
                                }}
                              </template>
                            </v-select>
                          </v-col>
                          <v-col cols="12">
                            <div class="d-flex">
                              <v-spacer></v-spacer>
                              <v-btn color="success" depressed @click="saveCourse">SAVE</v-btn>
                            </div>
                          </v-col>
                        </v-row>
                        <v-row align="center">
                          <v-col cols="12">
                            <v-subheader class="pa-0">FACILITATORS</v-subheader>
                          </v-col>
                          <v-col cols="6">
                            <v-combobox
                              v-model="
																selectFacilitators
															"
                              :items="staff"
                              label="Select Facilitators"
                              multiple
                              outlined
                            >
                              <template v-slot:item="{
																	item
																}">
                                {{
                                item.name
                                }}
                              </template>
                              <template
                                v-slot:selection="{
																	item
																}"
                              >
                                {{
                                item.name
                                }},
                              </template>
                            </v-combobox>
                          </v-col>
                          <v-col
                            class="d-flex"
                            cols="12"
                            sm="6"
                            v-for="(cat,
														indx) in select"
                            :key="indx"
                          >
                            <v-select
                              :items="
																cat.subCategories
															"
                              :label="
																`Select sub-category for ${cat.title}`
															"
                              outlined
                            >
                              <template v-slot:item="{
																	item
																}">
                                {{
                                item.title
                                }}
                              </template>
                              <template
                                v-slot:selection="{
																	item
																}"
                              >
                                {{
                                item.title
                                }},
                              </template>
                            </v-select>
                          </v-col>
                          <v-col cols="12">
                            <div class="d-flex">
                              <v-spacer></v-spacer>
                              <v-btn color="success" depressed>SAVE</v-btn>
                            </div>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
                <v-list three-line subheader v-if="isBulk">
                  <v-list-item>
                    <v-list-item-content>
                      <v-container>
                        <v-list-item-title>
                          Add Courses
                          (Bulk)
                        </v-list-item-title>
                        <v-row>
                          <v-col>
                            <download-csv :data="csvData">
                              <v-btn color="primary" text>
                                Download
                                format
                              </v-btn>
                            </download-csv>
                          </v-col>
                          <v-col>
                            <v-file-input accept=".csv" @change="showCsv" label="Select csv file"></v-file-input>

                            <v-btn color="primary" text @click="csvImport">
                              Preview imported
                              CSV
                            </v-btn>
                          </v-col>
                          <v-col cols="12" v-if="dummy">
                            <v-data-table
                              :headers="
																bulkHeaders
															"
                              :items="dummy"
                            ></v-data-table>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-card>
            </v-dialog>
          </div>
        </v-col>
        <v-col cols="12" v-if="search ? visibleCourses.length == 0 : courses.length == 0">
          <div class="d-flex text-center justify-center">
            <h2>{{search ?'No courses match your search' : 'No courses yet'}}</h2>
          </div>
        </v-col>
        <v-col cols="12" md="12">
          <v-card flat color="transparent" min-height="300px">
            <v-row
              :justify="
							$vuetify.breakpoint.mdAndUp ? 'start' : 'center'
						"
              v-if="!isLoadingCourses"
            >
              <v-col cols="12" md="4" sm="5" v-for="(course, index) in visibleCourses" :key="index">
                <course-item
                  :course="course"
                  :personal="personal"
                  :isStaff="isStaff"
                  :isAdmin="isAdmin"
                  :isStudent="isStudent"
                />
              </v-col>
            </v-row>
            <v-row v-else>
              <v-col cols="12" md="4" sm="5" v-for="i in 6" :key="i">
                <v-skeleton-loader ref="skeleton" type="card" class="mx-auto"></v-skeleton-loader>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
        <v-col>
          <div
            class="d-flex justify-end"
            v-if="search ? visibleCourses.length > 0  :courses.length > 0"
          >
            <div>
              <v-pagination
                v-model="page"
                :length="
									Math.ceil(courses.length / perPage)
								"
              ></v-pagination>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <div>
      <v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
        {{ snackbar.text }}
        <v-btn color="blue" text @click="snackbar.isActive = false">Close</v-btn>
      </v-snackbar>
    </div>
  </div>
</template>

<script>
import DownloadCsv from "vue-json-csv";
import MetricCard from "@/components/parent/Metric";
import CourseItem from "@/components/general/CourseItem";
// import VueCsvImport from "vue-csv-import";
import Papa from "papaparse";
import Axios from "axios";
export default {
  components: { DownloadCsv, MetricCard, CourseItem },
  props: {
    isStudent: {
      type: Boolean,
      default: false
    },
    isStaff: {
      type: Boolean,
      default: false
    },
    isAdmin: {
      type: Boolean,
      default: false
    },
    noOfUnits: {
      type: Number
    },
    personal: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      page: 1,
      perPage: 6,
      search: "",
      snackbar: {
        isActive: false,
        timeout: 3000,
        text: ""
      },
      isLoadingCourses: true,
      creditUnit: 0,
      courseTitle: null,
      courseCode: null,
      select: [],
      parseCsv: null,
      isBulk: false,
      model: [
        {
          title: "",
          course_code: "",
          description: "",
          venue: ""
        }
      ],
      selectFacilitators: [],
      // optionItems: ["Programming", "Design", "Vue", "Vuetify"],
      selectCategory: null,
      dialogFull: null,
      dialogSection: null,
      items: [
        {
          title: "Create Course",
          fn: () => (this.dialogFull = true)
        },
        {
          title: "Manage Course Categories",
          fn: () => alert("manage course categrories!")
        }
      ],
      bulkHeaders: [],
      categories: [
        { id: 1, title: "College Wide Courses" },
        { id: 2, title: "Alpha Semester Courses" },
        { id: 3, title: "Omega Courses" },
        { id: 4, title: "Departmental Courses" }
      ],
      dummy: null,
      pageLength: 0,
      enrolledCourses: []
      // subItems: []
    };
  },
  computed: {
    visibleCourses() {
      let items = this.courses.filter(item => {
        let search = this.search.toLowerCase();
        let title = item.title.toLowerCase();
        let code = item.course_code.toLowerCase();
        if (title.search(search) > -1 || code.search(search) > -1) return item;
      });

      return items.slice(
        (this.page - 1) * this.perPage,
        this.page * this.perPage
      );
      // return items;
    },
    getCourses() {
      return this.$store.state.courses;
    },
    getCoursesFromEnrollments() {
      return this.enrolledCourses;
    },
    courses() {
      let items;
      if (this.personal && this.isStudent) {
        items = [...this.getCoursesFromEnrollments];
      } else if (this.personal && this.isStaff) {
        items = [...this.$store.getters.getFacilitatedCourses];
      } else {
        items = [...this.getCourses];
      }
      return items;
    },
    optionItems() {
      return this.$store.state.courseCategories;
    },
    subItems() {
      return this.select.subCategories;
    },
    semesterTypes() {
      return this.$store.state.semesterTypes;
    },
    staff() {
      return this.$store.state.staff;
    },
    csvData() {
      return this.model.map(item => ({
        ...item
        // semester: item.semester.name, //item.address.city,
        // category: item.category.name //item.company.name
      }));
    }
  },
  methods: {
    openDialog() {
      this.dialogFull = true;
    },
    csvExport(arrData) {
      let csvContent = "data:text/csv;charset=utf-8,";
      csvContent += [
        Object.keys(arrData[0]).join(";"),
        ...arrData.map(item => Object.values(item).join(";"))
      ]
        .join("\n")
        .replace(/(^\[)|(\]$)/gm, "");

      const data = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", data);
      link.setAttribute("download", "export.csv");
      link.click();
    },
    showCsv(ent) {
      var reader = new FileReader();

      reader.readAsText(ent);
      reader.onload = evt => {
        this.dummy = Papa.parse(evt.target.result, {
          header: true,
          skipEmptyLines: true
        }).data;
      };
    },
    async saveBulk() {
      try {
        let res = await this.$store.dispatch("saveBulkCourses", this.dummy);
        if (res.status) {
          this.dummy = null;
          this.snackbar.text = res.message;
          this.snackbar.isActive = true;
          this.dialogFull = false;
          return;
        }
      } catch (error) {
        throw error;
      }
    },
    csvImport() {
      if (!this.dummy || this.dummy.length < 0) return;
      let headers = Object.keys(this.dummy[0]);
      let arr = [];
      headers.forEach(item => {
        let obj = {};
        obj.text = item.toUpperCase();
        obj.value = item;
        arr.push(obj);
      });
      this.bulkHeaders = arr;
      // console.log(headers);
    },
    async getEnrolledCourses() {
      try {
        let res = await Axios.get(
          `courses-enrolled?student_id=${this.$store.state.loggedInUser.id}`
        );
        this.enrolledCourses = res.data.data;

        // console.table(res.data);
      } catch (error) {
        throw error;
      }
    },
    async saveCourse() {
      let body = {
        title: this.courseTitle,
        course_code: this.courseCode
      };

      let res = await Axios.post("course", body);
      if (res.data.status) {
        this.$store.commit("openSnackbar", res.data.message);
        this.getAllCourses();
      }
    },
    async getAllCourses() {
      if (this.personal) {
        this.getEnrolledCourses().then(() => (this.isLoadingCourses = false));
      } else {
        await this.$store
          .dispatch("getAllCourses")
          .then(() => (this.isLoadingCourses = false));
      }
    }
  },
  watch: {
    dummy() {
      // console.log(v);
    }
  },
  async mounted() {
    try {
      // if (this.courses.length == 0) {
      this.getAllCourses();

      // }
    } catch (error) {
      throw error;
    }
  }
};
</script>
