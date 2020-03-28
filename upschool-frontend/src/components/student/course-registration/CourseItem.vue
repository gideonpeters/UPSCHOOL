<template>
  <div
    class="d-flex justify-space-between flex-fill px-4 py-5 pointer course-item text-center text-sm-left"
    :style="{backgroundColor: selectedColor, borderRadius: isSelected ? '5px' : ''}"
    @click.stop="selectCourse"
  >
    <div class="d-flex">
      <div class="course-code">
        {{ course.course_code }}
      </div>
    </div>
    <div class="d-flex mx-2">
      <div>{{ course.title }}</div>
    </div>
    <div class="d-flex">
      <div>2</div>
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
	data() {
		return {
			isSelected: false
		};
	},
	computed: {
		selectedColor() {
			return this.isSelected ? "rgba(104, 53, 135, 0.16)" : "white";
		}
	},
	methods: {
		selectCourse() {
			this.isSelected = !this.isSelected;
		}
	}
};
</script>

<style lang="scss" scoped>
.course-item {
	position: relative;
	display: flex;
	// width: 100vh;
	background-color: transparent;
	&:hover {
		background-color: transparentize($color: #683587, $amount: 0.9);
		border-radius: 5px;
	}
}

.course-code {
	color: #683587;
	// width: 40%;
}

.selected-course-item {
	background-color: transparentize($color: #683587, $amount: 0.9);
	border-radius: 5px;
}
</style>