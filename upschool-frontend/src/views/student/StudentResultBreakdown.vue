<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col>
					<div>
						<v-card class="pa-3" flat>
							<v-subheader>RESULT BREAKDOWN</v-subheader>
							<result-tabs />
						</v-card>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import ResultTabs from "@/components/general/ResultTabs";

export default {
	components: {
		ResultTabs
	}
};
</script>