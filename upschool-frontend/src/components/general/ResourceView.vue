<template>
	<div>
		<div class="my-5">{{type}}</div>

		<v-row>
			<v-col cols="12" sm="6" md="6">
				<v-text-field
					v-model="search"
					single-line
					hide-details
					flat
					:label="'Search ' + type.toLowerCase()"
					solo
					prepend-inner-icon="mdi-magnify"
				></v-text-field>
			</v-col>
		</v-row>

		<v-card class="mt-4 pa-3">
			<v-subheader class="d-flex mb-4 pa-0">
				<div class="fs-5 font-italic">
					<v-icon size="10" class="mr-1" color="blue">mdi-information</v-icon>Click table item to view
				</div>
				<v-spacer></v-spacer>
				<div class="d-flex align-center justify-end">
					<v-btn color text>
						<v-icon color="grey" size="18">mdi-filter</v-icon>
						<div>Filter</div>
					</v-btn>
					<div>
						<v-btn color icon>
							<v-icon color="grey" size="18">mdi-dots-vertical</v-icon>
						</v-btn>
					</div>
				</div>
			</v-subheader>
			<!-- <v-card-title>
			</v-card-title>-->
			<v-data-table
				:headers="headers"
				:items="items"
				:search="search"
				@click:row="goToPage"
				class="elevation-1"
			>
				<template v-slot:item.action="{ item }">
					<v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
					<v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
				</template>
				<template v-slot:item.department="{ item }">{{item.department.short_name}}</template>
				<!-- <template v-slot:item.program="{ item }">{{item.program.name}}</template> -->
				<template v-slot:item.duration="{ item }">{{item.no_of_years}}</template>
				<!-- <template v-slot:item.name="{ item }">{{item.user.name}}</template> -->
				<template v-slot:item.visible="{ item }">
					<v-checkbox v-model="item.visible" disabled></v-checkbox>
				</template>

				<template v-slot:no-data>
					<div>No data available yet</div>
					<!-- <v-btn color="primary
					" @click="initialize">Reset</v-btn>-->
				</template>
				<template v-slot:item.college_name="{ item }">{{item.college.name}}</template>
				<template v-slot:item.college_short_name="{ item }">{{item.college.short_name}}</template>
			</v-data-table>
		</v-card>
	</div>
</template>

<script>
export default {
	props: {
		items: {
			type: Array
		},
		headers: {
			type: Array
		},
		viewRoute: {
			type: String
		},
		type: {
			type: String,
			default: "def"
		}
	},
	data() {
		return {
			search: ""
		};
	},
	methods: {
		goToPage(v) {
			// console.log(this.type.toLowercase());
			let id;
			let type = this.type;

			if (type.toLowerCase() == "students") {
				id = v.matric_number;
			} else if (type.toLowerCase() == "staff") {
				id = v.staff_number;
			} else {
				id = v.id;
			}
			this.$router.push({
				name: this.viewRoute,
				params: { id }
			});
		}
	}
};
</script>