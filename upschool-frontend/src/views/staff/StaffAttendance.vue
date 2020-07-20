<template>
  <v-app>
    <attendance-view isStaff :staff="staff" />
  </v-app>
</template>

<script>
import AttendanceView from "@/components/general/AttendanceView";

export default {
  components: {
    AttendanceView
  },
  computed: {
    studentCourses() {
      return this.$store.state.student_courses;
    },
    staff() {
      return this.$store.state.loggedInUser;
    }
  }
};
</script>
