<template>
	<v-app>
		<v-card flat>
			<v-container>
				<v-row>
					<v-col cols="3">
						<metric-card title="Number of pending applications" :value="14" />
					</v-col>
					<v-col cols="3">
						<metric-card title="Number of due applications" :value="14" />
					</v-col>
					<v-col cols="3">
						<metric-card title="Number of applications" :value="14" />
					</v-col>
					<v-col cols="12" sm="6" md="4">
						<v-text-field
							v-model="search"
							append-icon="mdi-magnify"
							label="Search"
							single-line
							flat
							outlined
							hide-details
						></v-text-field>
					</v-col>
					<v-col cols="12">
						<v-card class="mt-4 pa-3">
							<v-subheader class="d-flex mb-4 mr-4">
								<v-spacer></v-spacer>
								<v-icon size="18">mdi-filter</v-icon>
								<div>Filter</div>
							</v-subheader>
							<v-data-table
								:headers="headers"
								:items="exeats"
								:search="search"
								sort-by="calories"
								@click:row="goToPage"
								class="elevation-1"
							>
								<template v-slot:item.status="{ item }">
									<v-chip
										:color="getColor(item.status)"
										small
										dark
										class="text-uppercase"
									>{{ status(item.status) }}</v-chip>
								</template>
								<template v-slot:item.action="{ item }">
									<v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
									<v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
								</template>
								<template v-slot:no-data>
									<v-btn color="primary" @click="initialize">Reset</v-btn>
								</template>
							</v-data-table>
						</v-card>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		MetricCard
	},
	data() {
		return {
			search: "",
			dialog: false,
			headers: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "name"
				},
				{ text: "Matriculation Number", value: "calories" },
				{ text: "Type", value: "fat" },
				{ text: "Duration", value: "duration" },
				{ text: "Grade/Level", value: "protein" },
				{ text: "Department", value: "carbs" },
				{ text: "Status", value: "status" },
				{ text: "Residence", value: "residence" },
				{ text: "Actions", value: "action", sortable: false }
			],
			exeats: []
		};
	},
	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		}
	},

	watch: {
		dialog(val) {
			val || this.close();
		}
	},

	created() {
		this.initialize();
	},

	methods: {
		initialize() {
			this.exeats = [
				{
					id: 1,
					name: "Uzoatuegwu Petrina Chidera",
					calories: "15CJ02889",
					fat: "DAY EXEAT",
					carbs: "EIE",
					residence: "Dorcas Hall",
					protein: 500,
					duration: "1 day",
					status: 1
				},
				{
					id: 2,
					name: "Shobande Josephine",
					calories: "15CJ02873",
					fat: "BANK EXEAT",
					carbs: "EIE",
					residence: "Dorcas Hall",
					protein: 500,
					duration: "15 hours",
					status: 3
				},
				{
					id: 3,
					name: "Owolabi Ifeoluwa Anuoluwa",
					calories: "15CJ02880",
					fat: "HOME",
					carbs: "CST",
					residence: "Deborah Hall",
					protein: 500,
					duration: "3 DAYS",
					status: 2
				},
				{
					id: 4,
					name: "Udochi Dikamsiyochi Young",
					calories: "15CJ02885",
					fat: "CUSTOM",
					carbs: "CBSS",
					residence: "Daniel Hall",
					protein: 400,
					duration: "2 WEEKS",
					status: 2
				},
				{
					id: 5,
					name: "Williams Adedayo Adewale, a.",
					calories: "15CJ02890",
					fat: "HOME",
					carbs: "CDLS",
					residence: "Peter Hall",
					protein: 300,
					duration: "2 DAYS",
					status: 1
				},
				{
					id: 6,
					name: "Paul Chukwuebuka Chimezie",
					calories: "15CJ02875",
					fat: "DAY",
					carbs: "CEDS",
					protein: 500,
					residence: "Joseph Hall",
					duration: "15 hours",
					status: 1
				},
				{
					id: 7,
					name: "Okoye Emeka Elvis",
					calories: "15CJ02857",
					fat: "CUSTOM",
					carbs: "COE",
					protein: 200,
					residence: "John Hall",
					duration: "15 hours",
					status: 3
				},
				{
					id: 8,
					name: "Olomo Rachael Ayobami",
					calories: "14CJ016805",
					fat: "CUSTOM",
					carbs: 87,
					protein: 500,
					residence: "Dorcas Hall",
					duration: "15 hours",
					status: 1
				},
				{
					id: 9,
					name: "Olashore Oluwatoyosi ",
					calories: "15CJ02861",
					fat: "HOME",
					carbs: "COE",
					protein: 4.9,
					residence: "Dorcas Hall",
					duration: "15 hours",
					status: 1
				},
				{
					id: 10,
					name: "Oguntolu Shalom Folayan",
					calories: "15CJ02852",
					fat: "DAY",
					carbs: "CEDS",
					protein: 7,
					residence: "Paul Hall",
					duration: "15 hours",
					status: 3
				}
			];
		},

		editItem(item) {
			this.editedIndex = this.desserts.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.desserts.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.desserts.splice(index, 1);
		},

		goToPage(v) {
			// console.log(v);
			this.$router.push({
				name: "parent.leave-details",
				params: { id: v.id }
			});
		},

		getColor(status) {
			if (status == 1) return "green accent-3";
			else if (status == 2) return "orange accent-2";
			else if (status == 3) return "red accent-2";
			else return "red";
		},

		status(v) {
			let res;
			switch (v) {
				case 1:
					res = "Approved";
					break;
				case 2:
					res = "Pending";
					break;
				case 3:
					res = "Unapproved";
					break;
				default:
					res = "Unapproved";
					break;
			}

			return res;
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			if (this.editedIndex > -1) {
				Object.assign(this.desserts[this.editedIndex], this.editedItem);
			} else {
				this.desserts.push(this.editedItem);
			}
			this.close();
		}
	}
};
</script>