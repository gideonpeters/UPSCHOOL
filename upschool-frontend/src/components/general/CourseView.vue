<template>
	<div>
		<div class="d-flex align-center">
			<v-btn icon color="black" @click="$router.go(-1)">
				<v-icon>mdi-arrow-left</v-icon>
			</v-btn>
			<div v-if="course">
				<h3>{{ course.course_code }}: {{ course.title }}</h3>
			</div>
			<v-spacer></v-spacer>
		</div>

		<div>
			<v-card flat class="pa-3 mt-5">
				<v-tabs v-model="tab" background-color="transparent">
					<v-tab exact :to="{name: item.route}" v-for="item in items" :key="item.id">
						{{
						item.tab
						}}
					</v-tab>
				</v-tabs>
				<router-view></router-view>

				<v-tabs-items v-model="tab">
					<v-tab-item v-for="(item, ix) in items" :key="ix">
						<v-card flat class="pa-3" v-if="ix == 5" min-height="500">
							<div class="fs-3">Currently under construction</div>
						</v-card>
					</v-tab-item>
				</v-tabs-items>
			</v-card>
		</div>
	</div>
</template>

<script>
export default {
	components: {
		// SectionItem,
		// MetricCard
		// VueEditor
	},
	props: {
		isStudent: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			tab: null,
			isHovered: false,
			selection: null,
			dialog2: null,
			course: {},
			items: [
				{ id: 1, tab: "OVERVIEW", route: "staff.courses.view" },
				{
					id: 2,
					tab: "COURSE MATERIAL",
					route: "staff.courses.view.materials"
				}
			],
			attachSubsection: false,
			showGradeList: false,
			enrollActions: [
				{ id: 1, title: "Student Enrollment", fn: () => {} },
				{ id: 2, title: "Staff Enrollment", fn: () => {} }
			]
		};
	},
	computed: {},
	methods: {
		reserve() {},
		openItem() {}
	},
	async mounted() {
		try {
			if (!this.isStudent) {
				this.items.push(
					{
						id: 3,
						tab: "PARTICIPANTS",
						route: "staff.courses.view.participants"
					},
					{
						id: 4,
						tab: "SUBMISSIONS",
						route: "staff.courses.view.submissions"
					},
					{
						id: 5,
						tab: "GRADES",
						route: "staff.courses.view.grades"
					},
					{
						id: 6,
						tab: "SETTINGS",
						route: "staff.courses.view.settings"
					}
				);
			}
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>

<style lang="scss" scoped>
.border-dashed {
	border-bottom: 1px dashed grey;
}
</style>
