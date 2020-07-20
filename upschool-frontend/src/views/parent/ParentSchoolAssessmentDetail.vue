<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col>
          <v-card flat class="pa-3" min-height="500">
            <v-row>
              <v-btn color="grey" text icon @click="$router.go(-1)">
                <v-icon>mdi-arrow-left</v-icon>Go Back
              </v-btn>
              <v-col cols="12">
                <div class="d-flex">
                  <metric-card
                    title="Number of Submissions"
                    :value="schoolAssessment.school_assessment_items ? schoolAssessment.school_assessment_items.length : 0 "
                  />
                  <v-spacer></v-spacer>

                  <div
                    class="headline font-italic"
                  >{{ `${schoolAssessment.name} (${schoolAssessment.total_score} Marks)` }}</div>
                </div>
              </v-col>
              <v-col cols="12">
                <!-- <v-col cols="12" sm="6" md="4"> -->
                <v-text-field
                  v-model="search"
                  single-line
                  hide-details
                  flat
                  label="search assessments"
                  solo
                  prepend-inner-icon="mdi-magnify"
                ></v-text-field>
                <!-- </v-col> -->
              </v-col>
              <v-col cols="12">
                <v-data-table
                  :headers="headers"
                  :search="search"
                  :items="schoolAssessment.school_assessment_items"
                  hide-default-footer
                >
                  <template v-slot:item.action="{item}">
                    <div class="d-flex">
                      <!-- <v-dialog v-model="dialog" persistent max-width="600px">
												<template v-slot:activator="{ on }">
													<v-btn depressed icon v-on="on">
														<v-icon small>mdi-eye</v-icon>
													</v-btn>
												</template>
												<v-card>
													<v-card-title>
														<span class="headline">{{isGrading ? 'Grade Submission' : 'View Submission'}}</span>
													</v-card-title>
													<v-card-text>
														<v-container>
															<v-row>
																<v-col cols="12">
																	<v-text-field
																		:value="`${item.student.name} : ${item.student.matric_number}`"
																		outlined
																		disabled
																	></v-text-field>
																</v-col>
																<v-col cols="12" v-if="!isGrading">
																	<v-card class="pa-3 mb-5">
																		<v-data-table
																			hide-default-header
																			:headers="[{text: 'type', value: 'type'}, {text: 'value', value: 'value'}]"
																			:items="items(item)"
																			hide-default-footer
																		>
																			<template v-slot:item.value=" props">
																				<v-btn
																					v-if="props.item.value == 'Download'"
																					outlined
																					small
																					color="success"
																					text
																					@click="goTo(item.file.url)"
																				>{{props.item.value}} to view</v-btn>
																				<div v-else>{{props.item.value}}</div>
																			</template>
																		</v-data-table>
																	</v-card>
																</v-col>
																<v-col cols="12" v-if="!isGrading">
																	<v-expansion-panels>
																		<v-expansion-panel>
																			<v-expansion-panel-header class="text-uppercase">STUDENT'S NOTES</v-expansion-panel-header>
																			<v-expansion-panel-content>
																				<div v-html="item.body"></div>
																			</v-expansion-panel-content>
																		</v-expansion-panel>
																		<v-expansion-panel>
																			<v-expansion-panel-header class="text-uppercase">FACILITATOR REVIEW</v-expansion-panel-header>
																			<v-expansion-panel-content>
																				<div v-html="item.review"></div>
																			</v-expansion-panel-content>
																		</v-expansion-panel>
																	</v-expansion-panels>
																</v-col>
																<v-col cols="12" v-if="isGrading">
																	<v-text-field
																		:value="item.grade_item.score"
																		label="Score"
																		outlined
																		v-model="gradeScore"
																		type="number"
																		:hint="`scores higher than the assessment total score of ${submission.gradelist.total_score} will not be uploaded`"
																	></v-text-field>
																</v-col>
																<v-col cols="12" v-if="isGrading">
																	<vue-editor
																		:editorToolbar="customToolbar"
																		v-model="review"
																		placeholder="write review here (optional)"
																	></vue-editor>
																</v-col>
															</v-row>
														</v-container>
													</v-card-text>
													<v-card-actions>
														<v-spacer></v-spacer>
														<v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
														<v-btn
															color="blue darken-1"
															v-if="isGrading & (isAdmin || isStaff)"
															text
															@click="isGrading = false"
														>Go back</v-btn>
														<v-btn
															color="blue darken-1"
															v-if="isGrading & (isAdmin || isStaff)"
															text
															:disabled="!gradeScore"
															@click="gradeSubmission(item.id)"
														>Submit</v-btn>
														<v-btn
															color="blue darken-1"
															v-if="isStudent"
															text
															@click="dialog = false"
														>Remove Submission</v-btn>
														<v-btn
															color="blue darken-1"
															v-if="!isGrading & (isAdmin || isStaff)"
															text
															@click="isGrading = true"
														>Grade</v-btn>
													</v-card-actions>
												</v-card>
											</v-dialog>
											<v-btn depressed icon>
												<v-icon small>mdi-pencil</v-icon>
                      </v-btn>-->
                    </div>
                  </template>
                  <!-- <template v-slot:item.status="{item}">
										<v-chip
											class="white--text"
											:color="!item.grade_item.score ? 'yellow darken-2' : 'green lighten-2'"
										>{{ item.grade_item.score ? `Graded (${item.grade_item.score} Marks)` : 'Not Graded' }}</v-chip>
                  </template>-->
                  <template v-slot:item.created_at="{item}">
                    <div>
                      {{`${moment(
                      item.created_at
                      ).format("dddd, MMMM Do YYYY, h:mm a")} (${moment(
                      item.created_at
                      ).fromNow()})`}}
                    </div>
                  </template>
                </v-data-table>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import Axios from "axios";
// import { VueEditor } from "vue2-editor";

export default {
  components: {
    MetricCard
    // VueEditor
  },
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
    }
  },
  data() {
    return {
      dialog: null,
      submission: [],
      review: "",
      search: "",
      gradeScore: "",
      isGrading: null,
      schoolAssessment: {},
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ align: "" }, { align: "justify" }, { align: "right" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ script: "sub" }, { script: "super" }],
        [{ size: ["small", false, "large", "huge"] }],
        ["code-block", "link"]
      ],
      headers: [
        {
          text: "Name",
          align: "left",
          sortable: false,
          value: "student_course.student.name"
        },
        {
          text: "Matriculation Number",
          value: "student_course.student.matric_number"
        },
        { text: "Score", value: "score" },
        {
          text: "Program",
          value: "student_course.student.program.name"
        },
        // { text: "Grade/Level", value: "student.level" },
        { text: "DATE SUBMITTED", value: "created_at" }
        // { text: "Status", value: "status" },
        // {
        // 	text: "Actions",
        // 	value: "action",
        // 	sortable: false,
        // 	align: "center"
        // }
      ]
      // items: []
    };
  },
  methods: {
    async getAssessment() {
      try {
        let id = this.$route.params.id;
        let res = await Axios.get(`school-assessment/${id}`);

        console.log(res.data);

        this.schoolAssessment = res.data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async gradeSubmission(id) {
      try {
        let body = {
          submission_item_id: id,
          score: this.gradeScore,
          review: this.review
        };
        let res = await Axios.post("submission-grade", body);

        this.$store.commit("openSnackbar", res.data.message);
        if (res.data.status) {
          this.getAssessment();
          this.dialog = false;
        }
      } catch (error) {
        console.log(error);
      }
    },
    items(prop) {
      let res = [
        {
          type: "File:",
          value: `Download`
        },
        {
          type: "Submission Date:",
          value: `${this.moment(prop.created_at).format(
            "dddd, MMMM Do YYYY, h:mm a"
          )} (${this.moment(prop.created_at).fromNow()})`
        },

        {
          type: "Grade Status:",
          value: `${prop.grade_item.score ? "Graded" : "Not Graded"}`
        }
      ];
      return res;
    },
    goTo(url) {
      if (url) {
        window.open(`${url}`, "_blank");
        // console.log(url);
      } else {
        this.$store.commit(
          "openSnackbar",
          "File not available, contact student"
        );
      }
    },
    goBack() {
      // let id = this.$route.params.id;
      let route = "parent.courses.view.submissions";

      this.$router.push({ name: route });
    },
    submit() {}
  },

  async mounted() {
    try {
      this.getAssessment();
    } catch (error) {
      console.log(error);
    }
  }
};
</script>