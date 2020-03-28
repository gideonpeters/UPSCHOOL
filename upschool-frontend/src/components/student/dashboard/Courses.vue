<template>
  <div class="primary-box-shadow">
    <v-card
      flat
      round
      class="py-3 px-5"
    >
      <custom-header
        title="Courses"
        cta-text="Edit Courses"
        route="student.course-reg"
      />
      <div class="row">
        <div
          v-for="course in courses"
          :key="course.id"
          class="col-lg-2 col-md-6 col-6"
        >
          <course-item :course="course" />
        </div>
      </div>
    </v-card>
  </div>
</template>

<script>
import CourseItem from "@/components/general/CourseItem";
export default {
	components: {
		CourseItem
	},
	data: () => ({
		img:
			"https://static.wixstatic.com/media/415a35bc6e1642e2a0f53f9a1963eb1d.jpg",
		courses: [
			{
				id: 1,
				title: "Real Analysis",
				course_code: "MAT411",
				status: "registered"
			},
			{
				id: 2,
				title: "Real Analysis II",
				course_code: "MAT412",
				status: "registered"
			},
			{
				id: 3,
				title: "Logisitics & Statistics",
				course_code: "MAT411",
				status: "registered"
			},
			{
				id: 4,
				title: "Numerical Analysis",
				course_code: "MAT411",
				status: "Pending"
			},
			{
				id: 5,
				title:
					"Introduction to Embedded Systems and VHDL design patterns",
				course_code: "MAT411",
				status: "Pending"
			}
		]
	})
};
</script>

<style lang="scss" scoped></style>
