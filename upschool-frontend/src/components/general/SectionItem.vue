<template>
	<div
		class="d-flex flex-column flex px-5 py-3 justify-space-around"
		:class="isHovered ? 'selected-item black--text ' : 'grey--text'"
		@mouseenter="isHovered = true"
		@mouseleave="isHovered = false"
		style="cursor: default"
	>
		<div class="d-flex justify-space-between align-center">
			<div class="align-center pointer" :class="isHovered? 'blue--text' : ''" @click="action">
				<v-icon v-if="subsection.file" :color="isHovered ? 'blue' : ''" size="18" class="mr-1">{{ icon}}</v-icon>
				{{subsection.name}}
			</div>
			<v-spacer></v-spacer>
			<div
				class="fs-6 font-italic t-primary"
			>{{ moment(subsection.created_at).format("dddd, MMMM Do YYYY, [at] h:mm a") }}</div>
		</div>
		<div class="pl-5 mt-1" v-html="subsection.body"></div>
		<!-- <div> </div> -->
		<v-row justify="center">
			<v-dialog v-model="dialog" width="600px">
				<v-card>
					<v-card-title>
						<span class="headline">{{subsection.name}}</span>
					</v-card-title>
					<v-card-text v-html="subsection.body"></v-card-text>
					<v-card class="mx-5 pa-3 mb-5" v-if="subsection.type == 'submission'">
						<v-data-table
							hide-default-header
							:headers="[{text: 'type', value: 'type'}, {text: 'value', value: 'value'}]"
							:items="items"
							hide-default-footer
						>
							<template v-slot:item.value="{ item }">
								<v-btn
									v-if="item.value == 'Download'"
									outlined
									small
									color="success"
									text
									@click="goTo(subsection.file.url)"
								>{{item.value}} to view</v-btn>
								<div v-else>{{item.value}}</div>
							</template>
						</v-data-table>
					</v-card>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="red darken-1" text @click="dialog = false">Remove Submission</v-btn>
						<v-btn color="blue darken-1" text @click="dialog = false, dialogSubmit = true">Add Submission</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
			<v-dialog v-model="dialogSubmit" persistent max-width="600px">
				<v-card>
					<v-card-title>
						<span class="headline">Make Submission</span>
					</v-card-title>
					<v-card-text>
						<v-container>
							<v-row>
								<v-col cols="12">
									<v-text-field :value="this.subsection.name" outlined disabled></v-text-field>
								</v-col>
								<v-col cols="12">
									<v-file-input
										show-size
										outlined
										prepend-icon
										prepend-inner-icon="mdi-paperclip"
										accept=".doc, .docx, .pdf, .xlsx, .xml, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
										@change="changeDoc"
										label="Add Document"
										persistent-hint
										hint="make sure you select .pdf, .doc or .docx files"
									></v-file-input>
								</v-col>
								<v-col cols="12">
									<vue-editor :editorToolbar="customToolbar" v-model="submissionBody"></vue-editor>
								</v-col>
							</v-row>
						</v-container>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="blue darken-1" text @click="dialogSubmit = false">Cancel</v-btn>
						<v-btn color="blue darken-1" text @click="submit">Proceed</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		</v-row>
	</div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Axios from "axios";

export default {
	components: {
		VueEditor
	},
	props: {
		subsection: {
			type: Object
		}
	},
	data: () => ({
		isHovered: false,
		dialog: null,
		dialogSubmit: null,
		submissionBody: "",
		submissionFile: "",
		customToolbar: [
			["bold", "italic", "underline", "strike"],
			[{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
			[{ align: "" }, { align: "justify" }, { align: "right" }],
			[{ indent: "-1" }, { indent: "+1" }],
			[{ script: "sub" }, { script: "super" }],
			[{ size: ["small", false, "large", "huge"] }],
			["code-block", "link"]
		]
	}),
	computed: {
		items() {
			let res = [
				{
					type: "File:",
					value: `Download`
				},
				{
					type: "Total Marks",
					value: `${this.subsection.submission_list.total_score} Marks`
				},
				{
					type: "Opens in:",
					value: `${this.moment(
						this.subsection.submission_list.open_date
					).format("dddd, MMMM Do YYYY, h:mm a")} (${this.moment(
						this.subsection.submission_list.open_date
					).fromNow()})`
				},
				{
					type: "Closes in:",
					value: `${this.moment(
						this.subsection.submission_list.due_date
					).format("dddd, MMMM Do YYYY, h:mm a")} (${this.moment(
						this.subsection.submission_list.due_date
					).fromNow()})`
				},
				{
					type: "Duration:",
					value: `${this.moment(
						this.subsection.submission_list.due_date
					).from(this.subsection.submission_list.open_date, true)}`
				},
				{
					type: "Submission Status:",
					value: `${
						this.subsection.submission_list.submission_status
							? "Submitted"
							: "Not Submitted"
					}`
				}
			];

			return res;
		},
		icon() {
			let res;
			switch (this.subsection.file.type) {
				case "application/pdf":
					res = "mdi-file-pdf";
					break;
				case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
					res = "mdi-file-excel";
					break;

				default:
					res = "mdi-poll-box";
					break;
			}
			return res;
		}
	},
	methods: {
		goTo(url) {
			if (url) {
				window.open(`http://127.0.0.1:8000${url}`, "_blank");
				// console.log(url);
			} else {
				this.$store.commit(
					"openSnackbar",
					"File not available, contact facilitator"
				);
			}
		},
		action() {
			if (this.subsection.file && this.subsection.type == "file") {
				this.goTo(this.subsection.file.url);
			} else if (this.subsection.type == "submission") {
				this.dialog = true;
			}
		},
		changeDoc(ent) {
			this.submissionFile = ent;
		},
		async submit() {
			try {
				const body = new FormData();
				body.append(
					"submission_list_id",
					this.subsection.submission_list.id
				);
				body.append("file", this.submissionFile);
				body.append("body", this.submissionBody);
				body.append("student_id", 1);

				let res = await Axios.post("submission-create", body);

				console.log(res.data);
				this.$store.commit("openSnackbar", res.data.message);
				this.dialogSubmit = false;
				this.$emit("submitted");
				this.submissionFile = "";
				this.submissionBody = "";
			} catch (error) {
				console.log(error);
			}
		}
	}
};
</script>

<style lang="scss" scoped>
.selected-item {
	border-left: 5px solid #607d8b !important;
	// color: green;
}
</style>