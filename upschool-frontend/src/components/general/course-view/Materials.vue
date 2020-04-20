<template>
	<div>
		<v-card flat class="pa-3" min-height="500">
			<v-row justify="start">
				<v-dialog v-model="dialogSection" persistent max-width="600px">
					<template v-slot:activator="{ on }">
						<v-btn color="primary" v-on="on" depressed text v-if="!isStudent">Add Section</v-btn>
					</template>
					<v-card>
						<v-card-title>
							<span class="headline">Add Section</span>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12" sm="6" md="12">
										<v-text-field
											outlined
											label="Title"
											placeholder="e.g Module 1 or Week 1 - Week 2"
											required
											v-model="sectionTitle"
										></v-text-field>
									</v-col>
									<v-col cols="12" sm="6" md="6">
										<v-text-field outlined label="Course" :value="course.title" disabled></v-text-field>
									</v-col>
									<v-col cols="12" sm="6" md="12">
										<vue-editor :editorToolbar="customToolbar" v-model="editorContent2"></vue-editor>
									</v-col>
								</v-row>
							</v-container>
							<small>*indicates required field</small>
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue darken-1" text @click="cancelSectionSave">Close</v-btn>
							<v-btn color="blue darken-1" text @click="saveSection">Save</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-row>

			<div class="mt-5 border-dashed pb-5" v-for="section in courseSections" :key="section.id">
				<div class="d-flex justify-space-between align-center">
					<h3>{{ section.title }}</h3>

					<div class="text-center" v-if="!isStudent">
						<v-menu offset-y>
							<template v-slot:activator="{ on }">
								<v-btn v-on="on" depressed icon>
									<v-icon color="grey">mdi-dots-vertical</v-icon>
								</v-btn>
							</template>
							<v-list>
								<v-list-item
									v-for="(item,
													index) in sectionActions"
									:key="index"
									@click="item.fn"
								>
									<v-list-item-title>
										{{
										item.title
										}}
									</v-list-item-title>
								</v-list-item>
							</v-list>
						</v-menu>
					</div>
				</div>
				<div v-html="section.body"></div>
				<div
					class="fs-3 mt-3 align-center d-flex pointer"
					v-for="(subsection,
									idx) in section.subsections"
					:key="idx"
				>
					<section-item :subsection="subsection" />
				</div>
				<div class="d-flex mt-4 align-baseline">
					<div class="fs-5 font-weight-light">Uploaded {{moment(section.created_at).fromNow()}}</div>
					<div class="px-2"></div>
					<div class="fs-5 font-weight-light">Updated {{ moment(section.updated_at).fromNow() }}</div>
				</div>
			</div>
		</v-card>
	</div>
</template>

<script>
import SectionItem from "@/components/general/SectionItem";
import { VueEditor } from "vue2-editor";

export default {
	components: {
		SectionItem,
		VueEditor
	},
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
			course: {},
			sectionTitle: "",
			subsectionType: "",
			subsectionTitle: "",
			editorContent2: "",
			courseSections: [],
			dialogSection: null,
			sectionActions: [
				{ id: 1, title: "Add Document", fn: () => {} },
				{ id: 2, title: "Add Submission", fn: () => {} },
				{ id: 3, title: "Edit Section", fn: () => {} },
				{ id: 4, title: "Delete Section", fn: () => {} }
			],
			customToolbar: [
				["bold", "italic", "underline", "strike"],
				[{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
				[{ align: "" }, { align: "justify" }, { align: "right" }],
				[{ indent: "-1" }, { indent: "+1" }],
				[{ script: "sub" }, { script: "super" }],
				[{ size: ["small", false, "large", "huge"] }],
				["code-block", "link"]
			]
		};
	},
	methods: {
		cancelSectionSave() {
			this.sectionTitle = "";
			this.editorContent2 = "";
			this.dialogSection = false;
		},
		async getCourseSections() {
			try {
				let id = this.$route.params.id;

				this.courseSections = await this.$store.dispatch(
					"getCourseSection",
					id
				);
			} catch (error) {
				console.log(error);
			}
		},
		async saveSection() {
			try {
				let body = {
					course_id: this.course.id,
					title: this.sectionTitle,
					body: this.editorContent2
				};

				let res = await this.$store.dispatch("saveCourseSection", body);

				this.dialogSection = false;
				if (res.status) {
					this.getCourseSections();
				}
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;

			this.course = await this.$store.dispatch("getCourseById", id);
			this.getCourseSections();

			// this.getCourseSections();
			// this.getCourseParticipants();
			// this.getGradelists();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>