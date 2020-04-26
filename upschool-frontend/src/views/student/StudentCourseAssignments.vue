<template>
	<v-app>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">SUBMISSIONS</v-subheader>

						<assignment-table isStudent />
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import AssignmentTable from "@/components/general/AssignmentTable";
export default {
	components: {
		AssignmentTable
	}
};
</script>
