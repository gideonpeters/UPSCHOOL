<template>
	<div>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col cols="12" md="8">
					<div class="d-flex flex-column">
						<div>
							<v-card class="pa-3 mb-5" flat>
								<custom-header title="FEATURED POST" ctaText="View" route="student.news"></custom-header>
							</v-card>
						</div>

						<div class="d-flex justify-space-between align-center">
							<v-subheader class="pa-0">NEWS & ANNOUNCEMENTS</v-subheader>
							<div v-if="!isStudent">
								<v-dialog
									v-model="dialogFull"
									fullscreen
									hide-overlay
									transition="dialog-bottom-transition"
								>
									<template v-slot:activator="{ on }">
										<v-btn color="blue accent-4" text v-on="on">POST NEWS</v-btn>
									</template>
									<v-card>
										<v-toolbar dark color="primary">
											<v-btn icon dark @click="dialogFull = false">
												<v-icon>mdi-close</v-icon>
											</v-btn>
											<v-toolbar-title>Create News Post</v-toolbar-title>
											<v-spacer></v-spacer>
											<v-toolbar-items>
												<v-btn dark text @click="dialogFull = false">Save</v-btn>
											</v-toolbar-items>
										</v-toolbar>
										<v-container>
											<v-row justify="center">
												<v-col cols="12">
													<editor />
												</v-col>
											</v-row>
										</v-container>
									</v-card>
								</v-dialog>
							</div>
						</div>
						<div>
							<v-card flat class="pa-3 mb-4" v-for="newsItem in news" :key="newsItem.id">
								<news-item :newsItem="newsItem" :isStudent="isStudent" />
							</v-card>
						</div>
					</div>
				</v-col>

				<v-col>
					<div class="d-flex justify-space-between align-center">
						<v-subheader class="pa-0">SCHOOL EVENTS</v-subheader>
						<v-btn color="blue accent-4" text v-if="!isStudent">CREATE EVENT</v-btn>
					</div>

					<v-card class="pa-3 mb-4" flat v-for="event in events" :key="event.id">
						<event-item :event="event" />
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
import NewsItem from "./NewsItem";
import Editor from "./Editor";
import EventItem from "./EventItem";

export default {
	name: "news-view",
	props: {
		isStudent: {
			type: Boolean,
			default: false
		}
	},
	components: {
		NewsItem,
		Editor,
		EventItem
	},
	data() {
		return {
			dialogFull: false
		};
	},
	computed: {
		news() {
			return this.$store.state.news;
		},
		events() {
			return this.$store.state.schoolEvents;
		}
	},
	methods: {
		goToPage(name) {
			this.$router.push({ name: name });
		}
	},
	async mounted() {
		try {
			this.$store.dispatch("getNews");
			this.$store.dispatch("getSchoolEvents");
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
