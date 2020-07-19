<template>
  <div>
    <v-card class="pa-3 mb-5" v-for="result in results" :key="result.id">
      <!-- <v-card-text> -->
      <v-subheader>{{result.semester.name}}</v-subheader>
      <v-data-table :headers="headers" :items="result.result_items" hide-default-footer>
        <template slot="footer">
          <div class="d-flex mt-4 justify-end">
            <div class="fs-3 mr-4 font-weight-bold">GPA: {{result.gpa}}</div>
            <div class="fs-3 font-weight-bold">CGPA: {{result.cgpa}}</div>
          </div>
        </template>
      </v-data-table>
      <!-- </v-card-text> -->
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    text:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    headers: [
      {
        text: "COURSE CODE",
        align: "start",
        sortable: false,
        value: "student_course.curriculum_item.curriculumable.course_code"
      },
      {
        text: "COURSE TITLE",
        value: "student_course.curriculum_item.curriculumable.title"
      },
      {
        text: "CREDIT UNIT",
        value: "student_course.curriculum_item.credit_unit"
      },
      { text: "GRADE SCORE", value: "grade_score" },
      { text: "WEIGHTED SCORE", value: "weighted_score" }
    ],
    results: []
  }),
  async mounted() {
    try {
      this.results = await this.$store.dispatch("getStudentResults");
    } catch (error) {
      throw error;
      // console.log(error);
    }
  }
};
</script>