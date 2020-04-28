<template>
	<v-card class="pa-3" flat min-height="600px">
		<v-row>
			<v-col cols="12">
				<v-dialog v-model="dialog" persistent max-width="600px">
					<template v-slot:activator="{ on }">
						<v-btn outlined tile color="primary" v-on="on">CREATE ISSUE</v-btn>
					</template>
					<v-card>
						<v-card-title>
							<span class="headline">Create Issue</span>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12" sm="6" md="12">
										<v-file-input
											show-size
											outlined
											prepend-icon
											prepend-inner-icon="mdi-paperclip"
											accept=".pdf, .docx, .doc, image/*"
											label="Select File"
											persistent-hint
											hint="upload a file that helps describe the issue"
										></v-file-input>
									</v-col>
									<v-col cols="12" sm="6" md="12">
										<v-textarea
											v-model="body"
											cols="12"
											outlined
											label="Description*"
											hint="Describe clearly the issue"
										></v-textarea>
									</v-col>
								</v-row>
							</v-container>
							<small>*indicates required field</small>
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
							<v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-col>
			<v-col cols="12">
				<v-card class="pa-3">
					<v-subheader>ALPHA SEMESTER 59</v-subheader>
					<v-data-table
						:headers="[{text: 'DESCRIPTION', value: 'description'}, {text: 'STATUS', value: 'status'}, {text: 'CREATED AT', value: 'created_at'} ]"
						:items="[]"
					></v-data-table>
				</v-card>
			</v-col>
		</v-row>
	</v-card>
</template>

<script>
export default {
	data() {
		return {
			dialog: null,
			body: ""
		};
	}
};
</script>