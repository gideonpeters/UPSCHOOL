<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<div class="my-5 align-center d-flex">
						<v-btn icon color="grey" @click="$router.go(-1)">
							<v-icon small>mdi-arrow-left</v-icon>
						</v-btn>
						<v-skeleton-loader
							v-if="isLoading"
							ref="skeleton"
							:boilerplate="boilerplate"
							type="list-item"
							:tile="tile"
							width="60%"
							class
						></v-skeleton-loader>
						<div v-if="!isLoading">
							<span>Events & Attendance/</span>
							<span>{{event.name}}</span>
						</div>
					</div>
				</v-col>
				<v-col cols="12" sm="6" md="4">
					<v-text-field
						v-model="search"
						single-line
						hide-details
						flat
						label="Search participants by name, matric number, staff number"
						solo
						prepend-inner-icon="mdi-magnify"
					></v-text-field>
				</v-col>
				<v-col>
					<div class="d-flex">
						<v-spacer></v-spacer>
						<div class="d-flex align-center justify-end">
							<v-menu offset-y :close-on-content-click="false">
								<template v-slot:activator="{ on }">
									<v-btn :ripple="false" v-on="on" color text>
										<v-icon color="grey" size="18">mdi-filter</v-icon>
										<div>Filter</div>
									</v-btn>
								</template>
								<v-card class="pa-3" flat>
									<v-row>
										<v-col cols="12">
											<v-subheader class="fs-4 pa-0">PROPERTY</v-subheader>
											<div class="d-flex fs-5 align-stretch">
												<div class="d-flex align-center mr-3">
													<v-icon small>mdi-dots-vertical</v-icon>
													<div>Name</div>
												</div>
												<div class="d-flex align-center my-auto">
													<input placeholder="Name" class="pa-3" style="height: 16px; border: 0.5px solid grey;" />
												</div>
												<div class="d-flex align-center ml-3">
													<v-menu offset-y>
														<template v-slot:activator="{ on }">
															<v-btn v-on="on" icon color="grey">
																<v-icon small>mdi-plus-circle</v-icon>
															</v-btn>
														</template>
														<v-list>
															<v-list-item v-for="i in 3" :key="i">
																<v-list-item-title>
																	<div class="fs-5 pointer">Matriculation Number</div>
																</v-list-item-title>
															</v-list-item>
														</v-list>
													</v-menu>
												</div>
											</div>
										</v-col>
									</v-row>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn x-small color="success" text>Done</v-btn>
									</v-card-actions>
								</v-card>
							</v-menu>

							<div>
								<v-menu offset-y>
									<template v-slot:activator="{ on }">
										<v-btn v-on="on" color icon>
											<v-icon color="grey" small>mdi-dots-vertical</v-icon>
										</v-btn>
									</template>
									<v-list>
										<v-list-item>
											<v-list-item-title>View defaulters</v-list-item-title>
										</v-list-item>
										<v-list-item>
											<v-list-item-title>Export Data as CSV</v-list-item-title>
										</v-list-item>
										<v-list-item>
											<v-list-item-title>Import Attendance Data</v-list-item-title>
										</v-list-item>
										<v-list-item>
											<v-list-item-title>View Analysis</v-list-item-title>
										</v-list-item>
									</v-list>
								</v-menu>
							</div>
						</div>
					</div>
				</v-col>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<div class="d-flex align-center">
							<v-subheader>ATTENDANCE OVERVIEW</v-subheader>
							<v-spacer></v-spacer>
							<v-switch v-model="isSelecting" label="Edit Multiple"></v-switch>
							<v-menu offset-y v-if="isSelecting">
								<template v-slot:activator="{ on }">
									<v-btn
										:disabled="(selectedItems.length == 0)"
										class="ml-3"
										small
										v-on="on"
										depressed
									>ACTIONS</v-btn>
								</template>
								<v-list>
									<v-list-item>
										<v-list-item-title>Mark as Present</v-list-item-title>
									</v-list-item>
									<v-list-item>
										<v-list-item-title>Mark as Absent</v-list-item-title>
									</v-list-item>
								</v-list>
							</v-menu>
						</div>

						<v-data-table
							v-model="selectedItems"
							:headers="headers"
							:items="students"
							:search="search"
							:show-select="isSelecting"
							:items-per-page="5"
						>
							<template v-slot:item.action="{ item }">
								<v-btn icon color="grey" @click="goToPage(item)">
									<v-icon small>mdi-eye</v-icon>
								</v-btn>
								<v-menu offset-y :close-on-content-click="false">
									<template v-slot:activator="{ on }">
										<v-btn v-on="on" color="grey" icon>
											<v-icon small>mdi-pencil</v-icon>
										</v-btn>
									</template>
									<v-list>
										<v-list-item>
											<v-list-item-title>Mark as Present</v-list-item-title>
										</v-list-item>
										<v-list-item>
											<v-list-item-title>Mark as Absent</v-list-item-title>
										</v-list-item>
									</v-list>
								</v-menu>
							</template>
							<template
								v-slot:item.percentage="{ item }"
							>{{((item.weighted_attendance / event.total_attendance ) * 100).toFixed(2)}}</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	inject: ["theme"],
	data() {
		return {
			search: "",
			isSelecting: false,
			selectedItems: [],
			tile: false,
			boilerplate: false,
			isLoading: true,
			headers: [
				{
					text: "NAME",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "MATRICULATION NUMBER", value: "matric_number" },
				{ text: "PROGRAM", value: "program" },
				{ text: "RESIDENCE", value: "residence" },
				{ text: "STATUS", value: "status" },
				{ text: "ACTIONS", value: "action", align: "center" }
			],
			event: {}
		};
	},
	computed: {
		students() {
			return [
				{
					id: 1,
					name: "Anesi Igebu",
					matric_number: "15cj02880",
					program: "Comp Engr.",
					residence: "Dorcas Hall",
					status: "Present"
				}
			];
		}
	},
	async mounted() {
		try {
			this.getEvent().then(() => (this.isLoading = false));
		} catch (error) {
			throw error;
		}
	},
	methods: {
		goToPage(v) {
			this.$router.push({
				name: "parent.attendance-view",
				params: { id: v.matric_number }
			});
		},
		async getEvent() {
			try {
				let id = this.$route.params.id;
				let res = await Axios.get(`event/${id}`);
				if (res.data.status) {
					this.event = res.data.data;
				}
				console.log(res.data);
			} catch (error) {
				throw error;
			}
		},
		editItem() {},
		deleteItem() {}
	},
	watch: {
		isSelecting(v) {
			if (!v) {
				this.headers.push({
					text: "ACTIONS",
					value: "action",
					align: "center"
				});
			} else {
				this.headers.pop();
			}
		}
	}
};
</script>