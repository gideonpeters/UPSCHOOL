<template>
  <div>
    <div class="d-flex flex-column pointer ma-3 course-item justify-space-between">
      <div>
        <div class="h-text">
          {{ course.course_code }}
        </div>
        <div class="pt-4 body-text course-title">
          {{ course.title }}
        </div>
      </div>
      <div>
        <v-card
          block
          :ripple="false"
          flat
          :color="courseStatus"
          class="course-btn py-2 text-center"
        >
          Registered
        </v-card>
      </div>
    </div>
  </div>
</template>

<script>
export default {
	props: {
		course: {
			type: Object
		}
	},
	computed: {
		courseStatus() {
			return this.course.status === "registered" ? "#BEF8C9" : "#F9CCCC";
		}
	}
};
</script>

<style lang="scss" scoped>
.course-item {
	height: 145px;
	overflow: hidden;

	.course-title {
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
}
</style>