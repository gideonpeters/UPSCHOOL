<template>
  <div>
    <v-card
      class="px-3"
      flat
    >
      <custom-header
        title="Course"
        cta-text="ff"
      />
      <div
        v-for="(course,i) in courses"
        :key="i"
        class="d-flex flex-column my-1"
      >
        <course-item :course="course" />
      </div>
    </v-card>
  </div>
</template>

<script>
import CourseItem from "./CourseItem";
export default {
	components: {
		CourseItem
	},
	computed: {
		courses() {
			return this.$store.getters.getCourses;
		}
	}
};
</script>