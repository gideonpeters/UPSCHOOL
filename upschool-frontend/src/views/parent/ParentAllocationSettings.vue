<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<span class="headline">Room Allocation Settings</span>
				</v-col>
				<v-col cols="12">
					<v-list>
						<v-list-item>
							<v-checkbox :value="settings.allocate_by_sex" label="Allocate rooms based on sex"></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox :value="settings.allocate_by_program" label="Allocate rooms based on program"></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox :value="settings.allocate_by_level" label="Allocate rooms based on level"></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox
								:value="settings.allocate_by_nationality"
								label="Allocate rooms based on nationality"
							></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox
								:value="settings.allocate_by_student_type"
								label="Allocate rooms based on student type"
							></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox
								:value="settings.allocate_after_pay"
								label="Allocate rooms to only students that have paid"
							></v-checkbox>
						</v-list-item>
						<!-- <v-list-item>
							<v-checkbox :value="!settings.allocate_by_sex" label="Allow students reserve rooms"></v-checkbox>
						</v-list-item>-->
						<v-list-item>
							<v-checkbox :value="settings.allocate_personal" label="Allow students select their rooms"></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox :value="settings.allocate_by_semester" label="Allocate rooms per semester"></v-checkbox>
						</v-list-item>
						<v-list-item>
							<v-checkbox
								:value="settings.allocate_by_session"
								label="Allocate rooms per academic session"
							></v-checkbox>
						</v-list-item>
					</v-list>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	data() {
		return {
			settings: {}
		};
	},
	async mounted() {
		try {
			let res = await Axios.get("allocation-settings");
			console.log(res.data);
			this.settings = res.data.data;
		} catch (error) {
			console.log(error);
		}
	}
};
</script>