<template>
	<div>
		<v-card flat class="pa-3" min-height="500">
			<v-card-text>
				<div class="my-4 subtitle-1">Description</div>

				<div>{{ course.description }}</div>
				<v-row align="center" class="mx-0 mt-5">
					<div>CLASSES:</div>
					<!-- <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating> -->

					<div
						class="grey--text ml-4 d-flex align-center"
						v-for="i in 2"
						:key="i"
					>
						Mondays 8:00AM -10PM
						<v-icon size="15" class="px-2">mdi-close-circle</v-icon>

						<v-icon size="15">mdi-pencil</v-icon>
					</div>
					<v-spacer></v-spacer>
					<v-btn color="primary" outlined>ADD CLASS</v-btn>
				</v-row>
			</v-card-text>

			<v-divider class="mx-4"></v-divider>
			<v-row align="center">
				<v-card-title>Prerequisites</v-card-title>
				<v-spacer></v-spacer>
				<v-btn color="success" text>ADD PREREQUISITE</v-btn>
			</v-row>

			<v-card-text>
				<v-chip-group
					active-class="deep-purple accent-4 white--text"
					column
				>
					<v-chip
						v-for="prerequisite in course.prerequisites"
						:key="prerequisite.id"
						>{{ prerequisite.course_code }}</v-chip
					>
				</v-chip-group>
			</v-card-text>

			<v-card-text>
				<v-row>
					<div class="mb-4 subtitle-1">Facilitators</div>
					<v-spacer></v-spacer>

					<v-btn color="success" text>ADD FACILITATOR</v-btn>
				</v-row>

				<div
					v-for="facilitator in course.facilitators"
					:key="facilitator.id"
				>
					{{ facilitator.user.name }}
				</div>
			</v-card-text>

			<v-card-actions>
				<div class="d-flex flex-lg-row flex-column">
					<div v-if="isStudent">
						<v-btn
							color="deep-purple lighten-2"
							text
							@click="reserve"
							>Enrolled as Student</v-btn
						>
					</div>
					<div>
						<v-btn
							color="deep-purple lighten-2"
							text
							@click="reserve"
							>Enroll as Staff/Facilitator</v-btn
						>
					</div>
				</div>
			</v-card-actions>
		</v-card>
	</div>
</template>

<script>
export default {
	props: {
		isStudent: {
			type: Boolean,
			default: false
		},
		isStaff: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			course: {}
		};
	},
	methods: {
		reserve() {}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);

			// this.getCourseSections();
			// this.getCourseParticipants();
			// this.getGradelists();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
