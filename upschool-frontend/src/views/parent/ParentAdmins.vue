<template>
	<v-app>
		<resource-view
			@create="isCreating = true"
			@delete="confirmDelete"
			type="Admins"
			:headers="headers"
			:items="admins"
			viewRoute="parent.admins.view"
		/>
		<v-dialog v-model="isCreating" fullscreen hide-overlay transition="dialog-bottom-transition">
			<v-card>
				<v-toolbar dark color="primary">
					<v-btn icon dark @click="isCreating = false">
						<v-icon>mdi-close</v-icon>
					</v-btn>
					<v-toolbar-title>CREATE ADMIN(S)</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-toolbar-items>
						<v-btn
							v-if="isBulk"
							dark
							text
							:disabled="
												isBulk
													? !dummy || dummy.length < 0
													: null
											"
							@click="saveBulk"
						>Save</v-btn>
					</v-toolbar-items>
				</v-toolbar>
				<v-container>
					<v-checkbox label="Bulk Addition" v-model="isBulk"></v-checkbox>
					<v-list three-line subheader v-if="!isBulk">
						<v-list-item>
							<v-list-item-content>
								<v-container>
									<v-list-item-title>
										Create
										Admin
									</v-list-item-title>
									<v-row align="center">
										<v-col cols="6">
											<v-text-field outlined label="Name" v-model="
																adminName
															"></v-text-field>
										</v-col>
										<v-col cols="6">
											<v-text-field outlined type="email" label="Email" v-model="adminEmail"></v-text-field>
										</v-col>
										<v-col cols="6">
											<v-text-field outlined type="password" label="Password" v-model="adminPassword"></v-text-field>
										</v-col>
										<!-- <v-col class="d-flex" cols="12" sm="6">
														<v-select
															:items="
																semesterTypes
															"
															label="Semester Type"
															outlined
														>
															<template v-slot:item="{
																	item
																}">
																{{
																item.title
																}}
															</template>
															<template v-slot:selection="{
																	item
																}">
																{{
																item.title
																}},
															</template>
														</v-select>
										</v-col>-->
										<v-col cols="12">
											<div class="d-flex">
												<v-spacer></v-spacer>
												<v-btn
													@click="saveSingle"
													color="success"
													depressed
													:disabled="!(adminName && adminPassword && adminEmail)"
												>SAVE</v-btn>
											</div>
										</v-col>
									</v-row>
								</v-container>
							</v-list-item-content>
						</v-list-item>
					</v-list>
					<v-list three-line subheader v-if="isBulk">
						<v-list-item>
							<v-list-item-content>
								<v-container>
									<v-list-item-title>
										Add Admins
										(Bulk)
									</v-list-item-title>
									<v-row>
										<v-col>
											<!-- <download-csv :data="csvData"> -->
											<v-btn color="primary" text>
												Download
												format
											</v-btn>
											<!-- </download-csv> -->
										</v-col>
										<v-col>
											<v-file-input accept=".csv" @change="showCsv" label="Select csv file"></v-file-input>

											<v-btn color="primary" text @click="csvImport">
												Preview imported
												CSV
											</v-btn>
										</v-col>
										<v-col cols="12" v-if="dummy">
											<v-data-table :headers="
																bulkHeaders
															" :items="dummy"></v-data-table>
										</v-col>
									</v-row>
								</v-container>
							</v-list-item-content>
						</v-list-item>
					</v-list>
				</v-container>
			</v-card>
		</v-dialog>
		<v-dialog v-model="dialogDelete" persistent max-width="600px">
			<v-card>
				<v-card-title>
					<span class="headline">Confirm</span>
				</v-card-title>
				<v-card-text>
					<v-container>
						<v-row>
							<div class="fs-3">Are you sure you want to delete this admin ({{selectedItem.name}})?</div>
						</v-row>
					</v-container>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="dialogDelete = false">Cancel</v-btn>
					<v-btn color="blue darken-1" text @click="deleteAdmin">Proceed</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-app>
</template>

<script>
import ResourceView from "@/components/general/ResourceView";
import Axios from "axios";

export default {
	components: {
		ResourceView
	},
	data: () => ({
		search: "",
		dialog: false,
		isCreating: false,
		isDeleting: false,
		dialogDelete: false,
		selectedItem: {},
		isBulk: false,
		dummy: [],
		adminName: "",
		adminEmail: "",
		adminPassword: "",
		headers: [
			{
				text: "Name",
				align: "left",
				value: "name"
			},
			{ text: "Email", value: "user.email" },
			{ text: "Actions", value: "action", sortable: false, align: "end" }
		],
		bulkHeaders: [
			{
				text: "Name",
				align: "left",
				value: "name"
			},
			{ text: "Email", value: "user.email" },
			{ text: "Actions", value: "action", sortable: false }
		],
		admins: []
	}),
	computed: {
		csvData() {
			return {};
		}
	},
	async mounted() {
		try {
			this.getAdmins();
		} catch (error) {
			throw error;
		}
	},
	methods: {
		goToPage(v) {
			this.$router.push({
				name: "parent.admins.view",
				params: { id: v.id }
			});
		},
		async getAdmins() {
			try {
				let res = await Axios.get("admin");
				console.log(res.data);
				this.admins = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		async saveSingle() {
			try {
				let body = {
					name: this.adminName,
					email: this.adminEmail,
					password: this.adminPassword
				};

				let res = await Axios.post("admin", body);
				this.$store.commit("openSnackbar", res.data.message);
				this.adminName = "";
				this.adminEmail = "";
				this.adminPassword = "";
				this.isCreating = false;
				this.getAdmins();
			} catch (error) {
				throw error;
			}
		},
		async deleteAdmin() {
			try {
				let res = await Axios.delete(`admin/${this.selectedItem.id}`);
				this.$store.commit("openSnackbar", res.data.message);
				this.dialogDelete = false;
				this.getAdmins();
			} catch (error) {
				throw error;
			}
		},
		saveBulk() {},
		showCsv() {},
		csvImport() {},
		confirmDelete(item) {
			this.selectedItem = item;
			this.dialogDelete = true;
		}
	}
};
</script>