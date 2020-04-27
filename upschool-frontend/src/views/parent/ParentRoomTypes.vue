<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card
						title="Number of Room Types"
						:value="items.length"
					/>
				</v-col>
				<v-col cols="12" md="12">
					<div class="d-flex justify-end">
						<v-btn depressed color="primary" @click="dialog = true"
							>CREATE ROOM TYPE</v-btn
						>
					</div>
					<v-row justify="center">
						<v-dialog v-model="dialog" persistent max-width="600px">
							<v-card>
								<v-card-title>
									<span class="headline"
										>Create Room Type</span
									>
								</v-card-title>
								<v-card-text>
									<v-container>
										<v-row>
											<v-col cols="12" sm="6" md="12">
												<v-text-field
													outlined
													label="Name*"
													v-model="typeName"
													typeName
													required
												></v-text-field>
											</v-col>
											<v-col cols="12">
												<v-text-field
													outlined
													label="Standard Fee*"
													hint="If you choose to make room allocation based on payment, students will get rooms if they have paid the percentage of this fee."
													required
													v-model="typeFee"
													type="number"
												></v-text-field>
											</v-col>
											<v-col cols="12">
												<v-text-field
													outlined
													v-model="typeCapacity"
													label="Capacity"
													type="number"
												></v-text-field>
											</v-col>
											<v-col cols="12">
												<v-textarea
													v-model="typeDescription"
													outlined
													label="Description"
													cols="10"
												>
												</v-textarea>
											</v-col>
										</v-row>
									</v-container>
									<small>*indicates required field</small>
								</v-card-text>
								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn
										color="blue darken-1"
										text
										@click="dialog = false"
										>Close</v-btn
									>
									<v-btn
										color="blue darken-1"
										text
										:disabled="!(typeName || typeFee)"
										@click="saveItem"
										>Save</v-btn
									>
								</v-card-actions>
							</v-card>
						</v-dialog>
					</v-row>
				</v-col>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-data-table :headers="headers" :items="items">
							<template v-slot:item.actions="{ item }">
								<div class="d-flex align-center justify-center">
									<v-btn
										color="grey"
										icon
										@click="
											goToPage(
												'parent.rooms.types.details',
												item.id
											)
										"
									>
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
									<v-btn color="grey" icon>
										<v-icon small>mdi-delete</v-icon>
									</v-btn>
								</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import Axios from "axios";
export default {
	components: {
		MetricCard,
	},
	data() {
		return {
			dialog: null,
			typeName: "",
			typeFee: "",
			typeCapacity: "",
			typeDescription: "",
			headers: [
				{ text: "NAME", value: "name", sortable: true },
				{ text: "DESCRIPTION", value: "description", sortable: true },
				{ text: "CAPACITY", value: "capacity", sortable: true },
				{ text: "FEE (N)", value: "fee", sortable: true },
				{
					text: "ACTIONS",
					value: "actions",
					sortable: true,
					align: "center",
				},
			],
			items: [],
		};
	},
	methods: {
		goToPage(routeName, id) {
			this.$router.push({ name: routeName, params: { id: id } });
		},
		async saveItem() {
			try {
				let body = {
					name: this.typeName,
					fee: this.typeFee,
					capacity: this.typeCapacity,
					description: this.typeDescription,
				};

				let res = await Axios.post("roomtype", body);
				this.typeName = "";
				this.typeFee = "";
				this.typeCapacity = "";
				this.typeDescription = "";
				this.$store.commit("openSnackbar", res.data.message);

				this.dialog = false;
			} catch (error) {
				console.log(error);
			}
		},
		async getRoomTypes() {
			try {
				let res = await Axios.get("roomtype");

				this.items = res.data.data;

				// this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		},
	},
	async mounted() {
		try {
			this.getRoomTypes();
		} catch (error) {
			console.log(error);
		}
	},
};
</script>
