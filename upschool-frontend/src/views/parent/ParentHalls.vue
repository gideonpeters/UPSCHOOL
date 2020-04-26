<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card title="Number of Halls" :value="items.length" />
				</v-col>
				<v-col cols="3">
					<metric-card
						title="Total Capacity"
						:value="items.reduce((acc, val) => acc + val.capacity, 0)"
					/>
				</v-col>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-data-table :headers="headers" :items="items">
							<template v-slot:item.actions="{item}">
								<div class="d-flex align-center justify-center">
									<v-btn color="grey" icon @click="goToPage('parent.halls.details', item.id)">
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
export default {
	components: {
		MetricCard
	},
	data() {
		return {
			headers: [
				{ text: "NAME", value: "name", sortable: true },
				{ text: "DESCRIPTION", value: "description", sortable: true },
				{ text: "CAPACITY", value: "capacity", sortable: true },
				{ text: "WINGS", value: "wings", sortable: true },
				{
					text: "ACTIONS",
					value: "actions",
					sortable: true,
					align: "center"
				}
			],
			items: [
				{
					id: 1,
					name: "Daniel Hall",
					wings: 4,
					capacity: 4,
					description: "this is daniel hall",
					preferred_sex: "male",
					preferred_program_id: null,
					preferred_nationality: "local",
					preferred_student_type: "Undergraduate"
				},
				{
					id: 2,
					name: "Esther Hall",
					wings: 4,
					capacity: 4,
					description: "this is esther hall",
					preferred_sex: "female",
					preferred_program_id: null,
					preferred_nationality: "international",
					preferred_student_type: "Undergraduate"
				},
				{
					id: 3,
					name: "Lupita Hall",
					wings: 4,
					capacity: 4,
					description: "this is lupita hall",
					preferred_sex: "female",
					preferred_program_id: null,
					preferred_nationality: "local",
					preferred_student_type: "postgraduate"
				}
			]
		};
	},
	methods: {
		goToPage(routeName, id) {
			this.$router.push({ name: routeName, params: { id: id } });
		}
	}
};
</script>
