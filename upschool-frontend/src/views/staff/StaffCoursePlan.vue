<template>
  <v-app>
    <!-- <div>MY COURSES</div> -->
    <course-ui isStaff personal />
  </v-app>
</template>

<script>
import CourseUi from "@/components/general/CourseUi";

export default {
  components: {
    CourseUi
  },
  async mounted() {
    try {
      await this.$store.dispatch("getFacilitatedCourses", 1);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>