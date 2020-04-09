<template>
	<div>
		<v-container>
			<v-row align="center">
				<v-col cols="12" md="4">
					<v-text-field flat label="Search courses" solo prepend-inner-icon="mdi-magnify"></v-text-field>
				</v-col>
				<v-spacer></v-spacer>
				<v-col cols="12" md="3">
					<v-combobox
						v-model="selectCategory"
						:items="categories.map(category => category.title)"
						label="Filter Categories"
						clearable
						multiple
						chips
					></v-combobox>
				</v-col>
				<v-col cols="12" md="2" v-if="!isStudent">
					<div class="text-lg-right">
						<v-menu offset-y close-on-click close-on-content-click>
							<template v-slot:activator="{ on }">
								<v-btn color="primary" depressed dark v-on="on">ACTIONS</v-btn>
							</template>
							<v-list>
								<v-list-item
									v-for="(item, index) in items"
									:key="index"
									@click.stop="index == 0 ? openDialog() : item.action()"
								>
									<v-list-item-title>{{ item.title }}</v-list-item-title>
								</v-list-item>
								<v-dialog
									v-model="dialogFull"
									fullscreen
									hide-overlay
									transition="dialog-bottom-transition"
								>
									<v-card>
										<v-toolbar dark color="primary">
											<v-btn icon dark @click="dialogFull = false">
												<v-icon>mdi-close</v-icon>
											</v-btn>
											<v-toolbar-title>NEW COURSE</v-toolbar-title>
											<v-spacer></v-spacer>
											<v-toolbar-items>
												<v-btn dark text @click="dialogFull = false">Save</v-btn>
											</v-toolbar-items>
										</v-toolbar>
										<v-list three-line subheader>
											<v-list-item>
												<v-list-item-content>
													<v-container>
														<v-list-item-title>Create Course</v-list-item-title>
														<v-row align="center">
															<v-col cols="6">
																<v-text-field outlined label="Course Title"></v-text-field>
															</v-col>
															<v-col cols="6">
																<v-text-field outlined label="Course Code"></v-text-field>
															</v-col>
															<v-col cols="6">
																<v-slider
																	v-model="creditUnit"
																	color="primary"
																	:label="'Credit Units ' + creditUnit "
																	min="0"
																	max="5"
																	thumb-label
																></v-slider>
															</v-col>
															<v-col class="d-flex" cols="12" sm="6">
																<v-select :items="semesterTypes" label="Semester Type" outlined>
																	<template v-slot:item="{item}">{{item.title}}</template>
																	<template v-slot:selection="{item}">{{item.title}},</template>
																</v-select>
															</v-col>
															<v-col cols="12">
																<div class="d-flex">
																	<v-spacer></v-spacer>
																	<v-btn color="success" depressed>SAVE</v-btn>
																</div>
															</v-col>
														</v-row>
														<v-row align="center">
															<v-col cols="12">
																<v-subheader class="pa-0">CATEGORIES</v-subheader>
															</v-col>
															<v-col cols="6">
																<v-combobox
																	v-model="select"
																	:items="optionItems"
																	label="What Category"
																	multiple
																	outlined
																>
																	<template v-slot:item="{item}">{{item.title}}</template>
																	<template v-slot:selection="{item}">{{item.title}},</template>
																</v-combobox>
															</v-col>
															<v-col class="d-flex" cols="12" sm="6" v-for="(cat, indx) in select" :key="indx">
																<v-select
																	:items="cat.subCategories"
																	:label="`Select sub-category for ${cat.title}`"
																	outlined
																>
																	<template v-slot:item="{item}">{{item.title}}</template>
																	<template v-slot:selection="{item}">{{item.title}},</template>
																</v-select>
															</v-col>
															<v-col cols="12">
																<div class="d-flex">
																	<v-spacer></v-spacer>
																	<v-btn color="success" depressed>SAVE</v-btn>
																</div>
															</v-col>
														</v-row>
														<v-row align="center">
															<v-col cols="12">
																<v-subheader class="pa-0">FACILITATORS</v-subheader>
															</v-col>
															<v-col cols="6">
																<v-combobox
																	v-model="selectFacilitators"
																	:items="staff"
																	label="Select Facilitators"
																	multiple
																	outlined
																>
																	<template v-slot:item="{item}">{{item.name}}</template>
																	<template v-slot:selection="{item}">{{item.name}},</template>
																</v-combobox>
															</v-col>
															<v-col class="d-flex" cols="12" sm="6" v-for="(cat, indx) in select" :key="indx">
																<v-select
																	:items="cat.subCategories"
																	:label="`Select sub-category for ${cat.title}`"
																	outlined
																>
																	<template v-slot:item="{item}">{{item.title}}</template>
																	<template v-slot:selection="{item}">{{item.title}},</template>
																</v-select>
															</v-col>
															<v-col cols="12">
																<div class="d-flex">
																	<v-spacer></v-spacer>
																	<v-btn color="success" depressed>SAVE</v-btn>
																</div>
															</v-col>
														</v-row>
													</v-container>
												</v-list-item-content>
											</v-list-item>
										</v-list>
									</v-card>
								</v-dialog>
							</v-list>
						</v-menu>
					</div>
					<div class="mt-4"></div>
				</v-col>
				<v-col cols="12" md="12">
					<v-row :justify="$vuetify.breakpoint.mdAndUp ? 'start' : 'center'">
						<v-col cols="10" md="4" sm="5" v-for="(course, index) in courses" :key="index">
							<v-card
								flat
								class="d-flex flex-column pa-4 pointer"
								@click="goToPage(course.id)"
								min-height="180"
								max-height="300"
							>
								<div class="d-flex justify-space-between align-center">
									<div class="font-weight-bold">{{course.course_code}}</div>
									<div class="d-flex align center" v-if="!isStudent">
										<v-icon size="18" class="mr-1" color="grey">mdi-pencil</v-icon>
										<v-icon size="18" color="grey">mdi-delete</v-icon>
									</div>
								</div>
								<div class="fs-3 mt-2 mb-5">{{course.title}}</div>
								<v-spacer></v-spacer>
								<v-divider></v-divider>
								<div class="d-flex justify-space-between align-center mt-2">
									<div class="d-flex align-center">
										<div>
											<v-icon size="10" color="yellow accent-4">mdi-circle</v-icon>
										</div>
										<div class="fs-4 ml-2">Departmental Course</div>
									</div>
									<div class="fs-4 d-flex">
										<div class="mr-3">2 Units</div>
										<div class="font-italic">Alpha</div>
									</div>
								</div>
							</v-card>
						</v-col>
					</v-row>
				</v-col>
				<v-col>
					<div class="d-flex justify-end">
						<div>
							<v-pagination v-model="page" :length="5"></v-pagination>
						</div>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
export default {
	props: {
		isStudent: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			page: 1,
			creditUnit: 0,
			select: [],
			selectFacilitators: [],
			// optionItems: ["Programming", "Design", "Vue", "Vuetify"],
			selectCategory: null,
			dialogFull: true,
			items: [
				{
					title: "Create Course",
					action() {
						return (this.dialogFull = true);
						// alert("create course!");
					}
				},
				{
					title: "Manage Course Categories",
					action() {
						alert("manage course categrories!");
					}
				}
			],
			categories: [
				{ id: 1, title: "College Wide Courses" },
				{ id: 2, title: "Alpha Semester Courses" },
				{ id: 3, title: "Omega Courses" },
				{ id: 4, title: "Departmental Courses" }
			]
			// subItems: []
		};
	},
	computed: {
		courses() {
			return this.$store.state.courses;
		},
		optionItems() {
			return this.$store.state.courseCategories;
		},
		subItems() {
			return this.select.subCategories;
		},
		semesterTypes() {
			return this.$store.state.semesterTypes;
		},
		staff() {
			return this.$store.state.staff;
		}
	},
	methods: {
		goToPage(v) {
			if (this.isStudent) {
				return this.$router.push({
					name: "student.courses.view",
					params: { id: v }
				});
			}
			return this.$router.push({
				name: "parent.courses-view",
				params: { id: v }
			});
		},
		openDialog() {
			this.dialogFull = true;
		}
	},
	async mounted() {
		try {
			// this.$store.dispatch("getAllCourses");
		} catch (error) {
			console.log(error);
		}
	},
	watch: {
		// select(val) {
		// 	// console.log(val, this.subItems);
		// 	// this.subItems.push(val.subCategories);
		// }
	}
};
</script>