<template>
  <div
    class="row align-items-center justify-content-center text-center py-3"
    :style="{ backgroundColor: backgroundColor }"
  >
    <div class="col-lg-2 col">
      {{ course.course_code }}
    </div>
    <div class="col-3 col-lg-6 d-none d-lg-block mx-2">
      <div class="text-wrap">
        {{ course.title }}
      </div>
    </div>
    <div class="col">
      2
    </div>
    <div class="col justify-content-center">
      <div class="d-flex flex-row justify-center">
        <div class="pr-1">
          {{ attendance }}
        </div>
      </div>
    </div>
    <div class="col">
      A
    </div>
  </div>
</template>

<script>
export default {
	props: {
		course: {
			type: Object
		},
		courseIndex: {
			type: Number
		}
	},
	computed: {
		attendance() {
			let val = this.course.attendance;
			val = val * 100;
			return val;
		},
		itemWidth() {
			return `${this.attendance}px`;
		},

		backgroundColor() {
			return this.courseIndex % 2 == 0
				? "white"
				: "rgba(104, 5, 135, 0.16)";
		}
	}
};
</script>

<style lang="scss" scoped>
.attendance-bar {
	background-color: #8898aa;
	border-radius: 5px;
	width: 100px;
	height: 5px;
	.progress {
		@extend .attendance-bar;
		background-color: red;
		// width: 20px;
		// height: 5px;
	}
}
</style>
