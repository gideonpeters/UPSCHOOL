<template>
  <v-app>
    <div class="row wrap">
      <div class="col-lg-9 col-12">
        <div class="row wrap px-4">
          <div class="col-12">
            <academic-profile />
          </div>
          <div class="col-12">
            <courses />
          </div>
          <div class="col-12">
            <recent-happenings />
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-12 no-gutters bg-white primary-box-shadow">
        <div class>
          <div class="d-flex flex-column no-gutters">
            <dashboard-payments v-if="!paid" />
            <room-allocation />
          </div>
          <v-divider class="my-3" />
          <div class="d-flex flex-column no-gutters">
            <dashboard-calendar />
          </div>
        </div>
      </div>
    </div>
  </v-app>
</template>

<script>
import AcademicProfile from "@/components/student/dashboard/AcademicProfile";
import Courses from "@/components/student/dashboard/Courses";
import RecentHappenings from "@/components/student/dashboard/RecentHappenings";
import DashboardPayments from "@/components/student/dashboard/Payments";
import DashboardCalendar from "@/components/student/dashboard/Calendar";
import RoomAllocation from "@/components/student/dashboard/RoomAllocation";

export default {
	components: {
		AcademicProfile,
		Courses,
		RecentHappenings,
		DashboardPayments,
		DashboardCalendar,
		RoomAllocation
	},
	data: () => ({
		paid: true
	})
};
</script>

<style lang="scss" scoped>
.border-grey {
	border-right: 0.5px solid #c7c7c7;
}
</style>