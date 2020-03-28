/* eslint-disable */
<template>
	<!-- <v-app>
		<v-card class="primary-box-shadow pa-4 ma-3">
			Max Registrable units: 25
		</v-card>
		<v-sheet height="100" class="ma-3">
			<v-tabs
				v-model="model"
				background-color="transparent"
				next-icon="mdi-chevron-right"
				prev-icon="mdi-chevron-left"
				show-arrows
			>
				<v-tabs-slider color="purple" />
				<v-tab
					v-for="(tab, ix) in tabs"
					:key="ix"
					class="px-3"
					:href="`#tab-${ix}`"
					active-class="purple--text"
				>
					{{ tab.text }}
				</v-tab>

				<v-tabs-items v-model="model">
					<v-tab-item value="tab-0">
						<div class="pa-2">
							<available-course />
						</div>
					</v-tab-item>
					<v-tab-item value="tab-1">
						0
					</v-tab-item>
					<v-tab-item value="tab-2">
						1
					</v-tab-item>
					<v-tab-item value="tab-3">
						2
					</v-tab-item>
					<v-tab-item value="tab-4">
						2
					</v-tab-item>
					<v-tab-item value="tab-5">
						2
					</v-tab-item>
				</v-tabs-items>
			</v-tabs>
		</v-sheet>
	</v-app>-->
	<v-app>
		<course-ui isStudent />
	</v-app>
</template>

<script>
// import AvailableCourse from "@/components/student/course-registration/AvailableCourse";
import CourseUi from "@/components/general/CourseUi";
export default {
	components: {
		// AvailableCourse,
		CourseUi
	},
	data() {
		return {
			selectedTab: 1,
			model: null,
			tabs: [
				{ text: "Register", value: 1 },
				{ text: "Registered", value: 2 },
				{ text: "Pending", value: 3 },
				{ text: "Approved", value: 4 },
				{ text: "Add/Drop", value: 5 }
			]
		};
	}
};
</script>
