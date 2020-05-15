<template>
	<div>
		<v-card
			flat
			:class="flat ? '' : 'elevation-1'"
			class="px-3 pa-3 pb-5 mb-3 text-center"
			v-if="student"
		>
			<div class="d-flex flex-column align-center pb-5">
				<div class="my-3">
					<v-avatar height="130" width="130">
						<v-img :src="student.profile_picture">
							<template v-slot:placeholder>
								<v-row class="fill-height grey ma-0" align="center" justify="center">
									<div
										class="text-center fs-1 white--text text-bold"
									>{{ student.user ? student.user.name[0] : "" }}</div>
								</v-row>
							</template>
						</v-img>
					</v-avatar>
				</div>
				<div
					class="text-uppercase"
				>{{`${student.first_name} ${student.middle_name} ${student.last_name}`}}</div>
				<div class="pt-3 grey--text">#{{ student.matric_number }}</div>
				<div
					class="py-3"
					v-if="student.program"
				>{{student.program.name}} {{' / '}}{{student.program.department.name}}</div>
				<!-- <div class="pb-5 fs-4" v-if="!staff">{{student.residence}}/{{student.room_number}}</div> -->

				<div class="py-5" v-if="isSuspended">
					<v-chip color="red lighten-2" class="white--text" small>Account Suspended</v-chip>
				</div>
			</div>
		</v-card>
	</div>
</template>

<script>
export default {
	props: {
		student: {
			type: Object
		},
		staff: {
			type: Boolean,
			default: false
		},
		isStudent: {
			type: Boolean,
			default: false
		},
		isSuspended: {
			type: Boolean,
			default: false
		},
		flat: {
			type: Boolean,
			default: false
		}
	}
};
</script>