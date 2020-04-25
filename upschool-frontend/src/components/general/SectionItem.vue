<template>
	<div class="pl-5">
		<div
			:class="isHovered ? 'blue--text text-underline' : 'grey--text'"
			@mouseenter="isHovered = true"
			@mouseleave="isHovered = false"
			@click="action"
		>
			<v-icon
				:color="isHovered ? 'blue' : ''"
				size="18"
				class="mr-1"
			>{{ subsection.type == 'file' ? 'mdi-file' : 'mdi-poll-box'}}</v-icon>
			{{subsection.name}}
		</div>
		<div class="pl-5 mt-1" v-html="subsection.body"></div>
		<v-row justify="center">
			<v-dialog v-model="dialog" width="600px">
				<!-- <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
				</template>-->
				<v-card>
					<v-card-title>
						<span class="headline">{{subsection.name}}</span>
					</v-card-title>
					<v-card-text v-html="subsection.body"></v-card-text>
					<v-card class="mx-5 pa-3 mb-5">
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
								>{{item.value}}</v-btn>
								<div v-else>{{item.value}}</div>
								<!-- {{item.type == 'File:' ? 'Click Here to Download' : item.type}} -->
								<!-- <v-checkbox v-model="item.visible" disabled></v-checkbox> -->
							</template>
						</v-data-table>
					</v-card>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="red darken-1" text @click="dialog = false">Remove Submission</v-btn>
						<v-btn color="blue darken-1" text @click="dialog = false">Add Submission</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		</v-row>
	</div>
</template>

<script>
export default {
	props: {
		subsection: {
			type: Object
		}
	},
	data: () => ({
		isHovered: false,
		dialog: null
	}),
	computed: {
		items() {
			// let dueDate = '' ;
			// let openDate = ''
			let res = [
				{
					type: "File:",
					value: `Download`
				},
				{
					type: "Total Marks",
					value: `${this.subsection.submission_list.total_score}`
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
					value: "6 days"
				}
			];

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
		}
	}
};
</script>