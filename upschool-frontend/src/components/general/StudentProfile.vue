<template>
	<div>
		<v-row>
			<v-col cols="12" md="3">
				<div class="d-flex flex-column">
					<student-card :isSuspended="isSuspended" :student="student" flat />
					<v-menu v-if="!isStudent" bottom left>
						<template v-slot:activator="{ on }">
							<v-btn color="primary" depressed v-on="on">Actions</v-btn>
						</template>

						<v-list class="grey lighten-3">
							<v-list-item
								v-for="item in studentActions"
								:key="item"
								@click="item.function"
							>{{ item.name }}</v-list-item>
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
										<!-- <div>{{student.program.degree.name}} ({{student.progam.degree.short_name}})</div> -->
										<div class="font-italic">Major in Computer Engineering</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">DURATION</div>
										<div>5 Years</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">YEAR OF ENTRY</div>
										<div>2015</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">DEPARTMENT</div>
										<div>
											Electrical and Information
											Engineering (EIE)
										</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">COLLEGE</div>
										<div>College of Engineering</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">ACADEMIC STANDING</div>
										<div>Promoted</div>
									</div>

									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">LEVEL/GRADE</div>
										<div>{{student.level}} level</div>
									</div>
								</v-card>

								<v-card flat v-if="item == 'Personal Information'" min-height="500">
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">FULL NAME</div>
										<div
											class="font-italic"
										>{{ `${student.first_name} ${student.middle_name} ${student.last_name}` }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">PHONE NUMBER</div>
										<div>{{ student.phone_number }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">ADDRESS</div>
										<div>{{ student.home_address }}</div>
									</div>
									<div class="d-flex flex-column mb-4">
										<div class="font-weight-bold fs-4">NATIONALITY</div>
										<div>{{ student.nationality }}</div>
									</div>
									<!-- <div
										class="d-flex flex-column"
										v-for="(guardian,
										idx) in student.guardians"
										:key="idx"
									>
										<v-subheader class="pa-0 text-uppercase">Guardian {{ idx + 1 }}</v-subheader>
										<div class="mb-3">
											<div class="font-weight-bold fs-4">FULL NAME</div>
											<div>{{ guardian.name }}</div>
										</div>
										<div>
											<div class="font-weight-bold fs-4">PHONE NUMBER</div>
											<div>{{ guardian.phone_number }}</div>
										</div>
									</div>-->
								</v-card>

								<v-card flat v-if="item == 'Graduation Requirements'" min-height="500">
									<v-tabs :vertical="$vuetify.breakpoint.mdAndUp">
										<v-tab>
											<!-- <v-icon left>mdi-account</v-icon> -->
											100 Level
										</v-tab>
										<v-tab>
											<!-- <v-icon left>mdi-lock</v-icon> -->
											200 Level
										</v-tab>
										<v-tab>
											<!-- <v-icon left>mdi-access-point</v-icon> -->
											300 Level
										</v-tab>
										<v-tab>
											<!-- <v-icon left>mdi-access-point</v-icon> -->
											400 Level
										</v-tab>
										<v-tab>
											<!-- <v-icon left>mdi-access-point</v-icon> -->
											500 Level
										</v-tab>

										<v-tab-item>
											<v-card flat>
												<v-card-text>
													<p>
														Sed aliquam ultrices
														mauris. Donec posuere
														vulputate arcu. Morbi ac
														felis. Etiam feugiat
														lorem non metus. Sed a
														libero.
													</p>

													<p>
														Nam ipsum risus, rutrum
														vitae, vestibulum eu,
														molestie vel, lacus.
														Aenean tellus metus,
														bibendum sed, posuere
														ac, mattis non, nunc.
														Aliquam lobortis.
														Aliquam lobortis.
														Suspendisse non nisl sit
														amet velit hendrerit
														rutrum.
													</p>

													<p class="mb-0">
														Phasellus dolor. Fusce
														neque. Fusce fermentum
														odio nec arcu.
														Pellentesque libero
														tortor, tincidunt et,
														tincidunt eget, semper
														nec, quam. Phasellus
														blandit leo ut odio.
													</p>
												</v-card-text>
											</v-card>
										</v-tab-item>
										<v-tab-item>
											<v-card flat>
												<v-card-text>
													<p>
														Morbi nec metus.
														Suspendisse faucibus,
														nunc et pellentesque
														egestas, lacus ante
														convallis tellus, vitae
														iaculis lacus elit id
														tortor. Sed mollis, eros
														et ultrices tempus,
														mauris ipsum aliquam
														libero, non adipiscing
														dolor urna a orci.
														Curabitur ligula sapien,
														tincidunt non, euismod
														vitae, posuere
														imperdiet, leo. Nunc sed
														turpis.
													</p>

													<p>
														Suspendisse feugiat.
														Suspendisse faucibus,
														nunc et pellentesque
														egestas, lacus ante
														convallis tellus, vitae
														iaculis lacus elit id
														tortor. Proin viverra,
														ligula sit amet ultrices
														semper, ligula arcu
														tristique sapien, a
														accumsan nisi mauris ac
														eros. In hac habitasse
														platea dictumst. Fusce
														ac felis sit amet ligula
														pharetra condimentum.
													</p>

													<p>
														Sed consequat, leo eget
														bibendum sodales, augue
														velit cursus nunc, quis
														gravida magna mi a
														libero. Nam commodo
														suscipit quam. In
														consectetuer turpis ut
														velit. Sed cursus turpis
														vitae tortor. Aliquam eu
														nunc.
													</p>

													<p>
														Etiam ut purus mattis
														mauris sodales aliquam.
														Ut varius tincidunt
														libero. Aenean viverra
														rhoncus pede. Duis leo.
														Fusce fermentum odio nec
														arcu.
													</p>

													<p class="mb-0">
														Donec venenatis
														vulputate lorem. Aenean
														viverra rhoncus pede. In
														dui magna, posuere eget,
														vestibulum et, tempor
														auctor, justo. Fusce
														commodo aliquam arcu.
														Suspendisse enim turpis,
														dictum sed, iaculis a,
														condimentum nec, nisi.
													</p>
												</v-card-text>
											</v-card>
										</v-tab-item>
										<v-tab-item>
											<v-card flat>
												<v-card-text>
													<p>
														Fusce a quam. Phasellus
														nec sem in justo
														pellentesque facilisis.
														Nam eget dui. Proin
														viverra, ligula sit amet
														ultrices semper, ligula
														arcu tristique sapien, a
														accumsan nisi mauris ac
														eros. In dui magna,
														posuere eget, vestibulum
														et, tempor auctor,
														justo.
													</p>

													<p class="mb-0">
														Cras sagittis. Phasellus
														nec sem in justo
														pellentesque facilisis.
														Proin sapien ipsum,
														porta a, auctor quis,
														euismod ut, mi. Donec
														quam felis, ultricies
														nec, pellentesque eu,
														pretium quis, sem. Nam
														at tortor in tellus
														interdum sagittis.
													</p>
												</v-card-text>
											</v-card>
										</v-tab-item>
									</v-tabs>
								</v-card>

								<v-card flat v-if="item == 'Curriculum'" min-height="500">
									<v-card flat>
										<v-tabs v-model="curriculumTab" background-color="transparent">
											<v-tab
												v-for="item in student.program.curricula"
												:key="item.id"
												:href="'#tab-'+item.level"
											>{{ item.level }}</v-tab>
										</v-tabs>

										<v-tabs-items v-model="curriculumTab">
											<v-tab-item
												v-for="item in student.program.curriculum_items"
												:key="item.id"
												:value="'tab-'+item.level"
											>
												<v-card flat class="pa-3">
													<curriculum-item
														:level="item.level"
														v-for="status in courseStatuses"
														:status="status"
														:key="status.id"
														:curriculumItem="item.curriculum_items.filter(it => it.level == item.level)"
													/>
													<!-- <v-card-text>{{ item }}</v-card-text> -->
												</v-card>
											</v-tab-item>
										</v-tabs-items>
									</v-card>
								</v-card>

								<v-card flat v-if="item == 'Results/Transcripts'" min-height="500">
									<result-tabs />
								</v-card>

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
import StudentCard from "./StudentCard";
import ResultTabs from "./ResultTabs";
import CurriculumItem from "./CurriculumItem";
export default {
	components: { StudentCard, ResultTabs, CurriculumItem },
	props: {
		student: {
			type: Object
		},
		isStudent: {
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
			studentActions: [
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
							"Are you sure you want to delete this student account?"
						);
					}
				}
			],
			text:
				"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
		};
	},
	computed: {
		// student() {
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
				case "Graduation Requirements":
					res = `To graduate from the 5-year Bachelor of Engineering (B.Eng) Degree Programme in ${this.student.program.name}, students must have successfully completed a minimum of ${this.student.program.min_graduation_units} Credit Units as shown:`;
					break;
				case "Curriculum":
					res = `This is the outlined curriculum for the the 5-year Bachelor of Engineering (B.Eng) Degree Programme in ${this.student.program.name}, students must have successfully completed a minimum of ${this.student.program.min_graduation_units} Credit Units as shown in the graduation requirements`;
					break;
				case "Academic Profile":
					res = `Academic Information outlined below`;
					break;
				case "Issues":
					res = `These are points or important notes or records for the selected student. They could range from awards or commendations to disciplinary cases`;
					break;
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
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
