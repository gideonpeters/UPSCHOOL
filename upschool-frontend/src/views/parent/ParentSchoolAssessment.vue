<template>
  <v-app>
    <div>
      <resource-view
        @create="isCreating = true"
        type="School Assessments"
        :headers="headers"
        :items="schoolAssessments"
        viewRoute="parent.school-assessments.view"
      />
      <v-dialog v-model="isCreating" hide-overlay transition="dialog-bottom-transition">
        <v-card>
          <!-- <v-toolbar dark color="primary">
            <v-btn icon dark @click="isCreating = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>CREATE ASSESSMENT</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>-->
          <v-container>
            <!-- <v-checkbox label="Bulk Addition" v-model="isBulk"></v-checkbox> -->
            <v-list three-line subheader v-if="!isBulk">
              <v-list-item>
                <v-list-item-content>
                  <v-container>
                    <v-list-item-title>
                      Create
                      Assessment
                    </v-list-item-title>
                    <v-row align="center">
                      <v-col cols="12" md="6">
                        <v-text-field
                          outlined
                          label="Name"
                          v-model="
																assessmentName
															"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" md="6">
                        <v-text-field
                          outlined
                          type="number"
                          label="Total Score"
                          v-model="totalScore"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12">
                        <div class="d-flex">
                          <v-spacer></v-spacer>
                          <v-btn
                            @click="saveSingle"
                            color="success"
                            depressed
                            :disabled="!(assessmentName && totalScore )"
                          >SAVE</v-btn>
                        </div>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-container>
        </v-card>
      </v-dialog>
    </div>
  </v-app>
</template>

<script>
import ResourceView from "@/components/general/ResourceView";
import Axios from "axios";

export default {
  components: {
    ResourceView
  },
  data: () => ({
    search: "",

    headers: [
      {
        text: "NAME",
        align: "left",
        sortable: false,
        value: "name"
      },
      { text: "TOTAL SCORE", value: "total_score" },
      { text: "ACTIVE", value: "visible" },

      { text: "ACTIONS", value: "action", sortable: false }
    ],
    isCreating: false,
    isDeleting: false,
    dialogDelete: false,
    selectedItem: {},
    isBulk: false,
    dummy: [],
    assessmentName: "",
    adminEmail: "",
    totalScore: "",
    bulkHeaders: [
      {
        text: "Name",
        align: "left",
        value: "name"
      },
      { text: "Email", value: "user.email" },
      { text: "Actions", value: "action", sortable: false }
    ],
    admins: []
  }),

  computed: {
    schoolAssessments() {
      return this.$store.state.schoolAssessments;
    },
    csvData() {
      return {};
    }
  },
  methods: {
    async saveSingle() {
      try {
        let body = {
          name: this.assessmentName,
          total_score: this.totalScore
        };

        let res = await Axios.post("school-assessment", body);
        if (res.data.status) {
          this.isCreating = false;
          this.assessmentName = "";
          this.totalScore = "";
          this.$store.commit("openSnackbar", res.data.message);
          await this.$store.dispatch("getAllSchoolAssessments");
        }
      } catch (error) {
        throw error;
      }
    }
  },
  async mounted() {
    try {
      await this.$store.dispatch("getAllSchoolAssessments");
    } catch (error) {
      console.log(error);
    }
  }
};
</script>