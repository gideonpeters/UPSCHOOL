<template>
	<div>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col cols="12" md="8">
					<div class="d-flex flex-column">
						<div>
							<v-card class="pa-3 mb-5" flat>
								<custom-header title="FEATURED POST" ctaText="View" route="student.news"></custom-header>

								<v-img
									:src="
										`http://127.0.0.1:8000${latestNews.image.url}`
									"
									class="white--text align-end"
									gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.8)"
									height="200px"
								>
									<v-card-title class="py-0" v-text="latestNews.title"></v-card-title>
									<v-card-title class="fs-4 py-0" v-html="latestNews.body" v-line-clamp:20="1"></v-card-title>
									<v-card-actions class="py-0">
										<v-spacer></v-spacer>

										<v-btn text color="white" @click="goToNews(latestNews.id)">READ MORE</v-btn>
									</v-card-actions>
								</v-img>
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
										</v-toolbar>
										<v-container>
											<v-row justify="center">
												<v-col cols="12">
													<editor @save-item="dialogFull = false" />
												</v-col>
											</v-row>
										</v-container>
									</v-card>
								</v-dialog>
							</div>
						</div>
						<div>
							<v-card flat class="pa-3 mb-4" v-for="newsItem in news" :key="newsItem.id">
								<news-item
									:newsItem="newsItem"
									:isStudent="isStudent"
									:isStaff="isStaff"
									:isAdmin="isAdmin"
								/>
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
		},
		isStaff: {
			type: Boolean,
			default: false
		},
		isAdmin: {
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
		latestNews() {
			return this.$store.state.news[0];
		},
		events() {
			return this.$store.state.schoolEvents;
		}
	},
	methods: {
		goToPage(name) {
			this.$router.push({ name: name });
		},
		goToNews(id) {
			if (this.isStudent) {
				return this.$router.push({
					name: "student.news.details",
					params: { id: id }
				});
			} else if (this.isStaff) {
				return this.$router.push({
					name: "staff.news.details",
					params: { id: id }
				});
			} else if (this.isAdmin) {
				return this.$router.push({
					name: "parent.news.details",
					params: { id: id }
				});
			}
			// this.$router.push({
			// 	name: "parent.news.details",
			// 	params: { id: id }
			// });
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
