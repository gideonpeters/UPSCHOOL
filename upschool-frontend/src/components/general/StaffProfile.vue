<template>
	<div>
		<v-row>
			<v-col cols="12" md="3">
				<div class="d-flex flex-column">
					<staff-card :isSuspended="isSuspended" :staff="staff" flat />
					<v-menu v-if="!isStaff" bottom left>
						<template v-slot:activator="{ on }">
							<v-btn color="primary" depressed v-on="on">Actions</v-btn>
						</template>

						<v-list class="grey lighten-3">
							<v-list-item v-for="item in staffActions" :key="item" @click="item.function">{{ item.name }}</v-list-item>
						</v-list>
					</v-menu>
				</div>
			</v-col>
			<v-col cols="12" md="9">
				<div>
					<v-tabs v-model="currentItem" fixed-tabs slider-color="white">
						<v-tab v-for="item in items" :key="item" :href="'#tab-' + item">{{ item }}</v-tab>

						<v-menu v-if="more.length" bottom left>
							<template v-slot:activator="{ on }">
								<v-btn text class="align-self-center mr-4" v-on="on">
									more
									<v-icon right>mdi-menu-down</v-icon>
								</v-btn>
							</template>

							<v-list class="grey lighten-3">
								<v-list-item v-for="item in more" :key="item" @click="addItem(item)">{{ item }}</v-list-item>
							</v-list>
						</v-menu>
					</v-tabs>
				</div>

				<div>
					<v-tabs-items v-model="currentItem">
						<v-tab-item v-for="item in items.concat(more)" :key="item" :value="'tab-' + item">
							<v-card flat>
								<v-card-text>
									<h2>{{ item }}</h2>
									{{
									tabText(item)
									}}
								</v-card-text>
							</v-card>

							<div class="pa-5">
								<v-card flat v-if="item == 'Academic Profile'" min-height="500">
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">PROGRAM</div>
										<!-- <div>{{staff.program.degree.name}} ({{staff.progam.degree.short_name}})</div> -->
										<div class="font-italic">Major in</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">DURATION</div>
										<div>Years</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">YEAR OF ENTRY</div>
										<div>2015</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">DEPARTMENT</div>
										<div>{{staff.department.name}} ({{staff.department.short_name}})</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">COLLEGE</div>
										<div></div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">ACADEMIC STANDING</div>
										<div></div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">LEVEL/GRADE</div>
										<div>level</div>
									</div>
								</v-card>

								<v-card flat v-if="item == 'Personal Information'" min-height="500">
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">FULL NAME</div>
										<div
											class="font-italic"
										>{{ `${staff.first_name} ${staff.middle_name} ${staff.last_name}` }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">PHONE NUMBER</div>
										<div>{{ staff.phone_number }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">ADDRESS</div>
										<div>{{ staff.address }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">NATIONALITY</div>
										<div>{{ staff.nationality }}</div>
									</div>
								</v-card>

								<v-card flat v-if="item == 'Graduation Requirements'" min-height="500"></v-card>

								<v-card flat v-if="item == 'Curriculum'" min-height="500"></v-card>

								<v-card flat v-if="item == 'Results/Transcripts'" min-height="500"></v-card>

								<v-card flat v-if="item == 'Issues'" min-height="500">
									<div></div>
								</v-card>
							</div>
						</v-tab-item>
					</v-tabs-items>
				</div>
			</v-col>
		</v-row>
	</div>
</template>

<script>
import StaffCard from "./StaffCard";

export default {
	components: { StaffCard },
	props: {
		staff: {
			type: Object
		},
		isStaff: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			currentItem: "tab-Curriculum",
			curriculumTab: null,
			items: [
				"Academic Profile",
				"Personal Information",
				"Curriculum",
				"Results/Transcripts"
			],
			more: [
				"Finances",
				"Graduation Requirements",
				"Issues"
				// "Flights",
				// "Apps"
			],
			levels: ["100", "200", "300", "400", "500"],
			issues: [
				{
					id: 1,
					name: "Disciplinary case: Indecent Dressing",
					notes: "...",
					created_at: "4 days ago",
					reviews: [],
					attachments: []
				},
				{
					id: 1,
					name: "Commendation: Award of Global Excellence",
					notes: "....",
					created_at: "13 months ago",
					reviews: [],
					attachments: []
				}
			],
			isSuspended: false,
			staffActions: [
				{
					id: 1,
					name: "Create Issue",
					function: () => {
						this.createIssue();
					}
				},
				{
					id: 2,
					name: "Suspend Account",
					function: () => {
						return (this.isSuspended = true);
					}
				},
				{
					id: 3,
					name: "Delete Account",
					function: () => {
						alert(
							"Are you sure you want to delete this staff account?"
						);
					}
				}
			],
			text:
				"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
		};
	},
	computed: {
		// staff() {
		// 	return this.$store.state.loggedInUser;
		// },
		program() {
			return this.$store.state.programs.find(program => program.id == 1);
		},
		courseStatuses() {
			return this.$store.state.course_statuses;
		}
	},
	methods: {
		tabText(item) {
			let res;
			switch (item) {
				default:
					res = "";
					break;
			}
			return res;
		},
		addItem(item) {
			const removed = this.items.splice(0, 1);
			this.items.push(...this.more.splice(this.more.indexOf(item), 1));
			this.more.push(...removed);
			this.$nextTick(() => {
				this.currentItem = "tab-" + item;
			});
		},
		commitAction() {}
	},
	async mounted() {
		try {
			this.$store.dispatch("getCourseStatus");
			// this.$store.dispatch(
			// 	"getstaffCurriculum",
			// 	this.staff.program.id
			// );
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
