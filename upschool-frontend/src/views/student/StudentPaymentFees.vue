<template>
	<v-app>
		<v-container>
			<v-card flat class="pa-3" min-height="800px">
				<v-container>
					<v-row>
						<v-col cols="12">
							<v-subheader class="fs-2-b mb-3 px-0 text-uppercase">2019/2020 Session</v-subheader>
							<div class="fs-3">
								<div>Paid: 50%</div>
								<div class="py-3">Period From: 10/12/2019</div>
								<div>Period To: 10/12/2020</div>
							</div>
						</v-col>
						<v-col cols="12">
							<v-card class="pa-3">
								<v-subheader>FEE ITEMS</v-subheader>
								<v-data-table
									v-model="selectedFees"
									show-select
									hide-default-footer
									:headers="headers"
									:items="studentInvoice.fee_items"
								></v-data-table>
							</v-card>
						</v-col>
						<v-col cols="12">
							<div class="d-flex my-5 align-center">
								<v-spacer></v-spacer>
								<div class="fs-3 mr-4">TOTAL AMOUNT DUE:</div>
								<div class="fs-2 font-italic">N{{700000}}</div>
							</div>
							<div class="d-flex">
								<v-spacer></v-spacer>
								<v-btn depressed tile outlined color="primary">PROCEED TO PAYMENT</v-btn>
							</div>
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-container>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			selectedFees: [],
			studentInvoice: {
				fee_items: [
					{
						id: 1,
						name: "SCHOOL FEES",
						value_paid: 0,
						value: 569000,
						status: null,
						description: "This is the school fees for this semester"
					},
					{
						id: 2,
						name: "DEPARTMENTAL DUES",
						value: 10000,
						value_paid: 0,
						status: null,
						description:
							"This is the departmental dues for this semester"
					}
				]
			},
			headers: [
				{ text: "NAME", value: "name" },
				{ text: "DESCRIPTION", value: "description" },
				{ text: "AMOUNT DUE (N)", value: "value" },
				{ text: "AMOUNT PAID (N)", value: "value_paid" }
			]
		};
	}
};
</script>