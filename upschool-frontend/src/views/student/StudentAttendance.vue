<template>
	<!-- <v-app>
    <v-card
      flat
      class="pa-4"
    >
      <custom-header title="General Attendance" />
      <div
        class="d-flex flex-lg-row flex-column justify-lg-space-around mb-5"
      >
        <attendance-card
          title="CHOP"
          :number="5"
        />
        <attendance-card
          title="CHAPEL"
          :number="3"
        />
        <attendance-card
          title="ROLL-CALL"
          :number="15"
        />
        <attendance-card
          title="YOUTH ALIVE"
          :number="1"
        />
      </div>
      <custom-header title="Class Attendance" />
      <div class="attendance-table mx-5">
        <div style="width: 100%">
          <div class="d-flex text-center thead">
            <div class="col-lg-2 col">
              COURSE
            </div>
            <div class="col-3 col-lg-4 d-none d-lg-block">
              COURSE TITLE
            </div>
            <div class="col-lg-1 col">
              CREDIT UNIT
            </div>
            <div class="col">
              PERCENTAGE (%)
            </div>
          </div>
          <div class="row no-gutters">
            <div
              v-for="(course, i) in studentCourses"
              :key="i"
              class="col-12 no-gutters"
            >
              <attendance-item
                :course="course"
                :course-index="i"
              />
            </div>
          </div>
        </div>
      </div>
    </v-card>
	</v-app>-->
	<v-app>
		<attendance-view isStudent />
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
		}
	}
};
</script>

<style lang="scss" scoped>
.attendance-table {
	letter-spacing: 0.01785714em;
	// font-family: Roboto,Arial,sans-serif;
	font-size: 0.95rem;
	font-weight: 500;
	line-height: 1.25rem;
	color: #5f6368;
	overflow: hidden;
	padding: 4px;
	text-overflow: ellipsis;
	vertical-align: middle;
	white-space: nowrap;

	.thead {
		color: white;
		font-size: 0.8rem;
		background-color: #683587;
	}
}
</style>
