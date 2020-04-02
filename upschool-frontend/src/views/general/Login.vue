<template>
	<div class="auth-body d-flex justify-center align-center">
		<v-card flat class="d-flex" height="90%" width="80%">
			<v-row no-gutters>
				<v-col cols="5" md="0" class="bg-img" v-if="$vuetify.breakpoint.mdAndUp"></v-col>
				<v-col cols="12" md="7">
					<v-card class="pa-5" tile flat>
						<div class="pa-4 d-flex flex-column">
							<div class="d-flex flex-column align-center">
								<div>
									<v-img cover fixed width="220px" height="220px" :src="logo" />
								</div>
							</div>
							<div class="d-flex justify-center">
								<v-row justify="center" align="center" no-gutters>
									<v-col cols="12" md="8">
										<div class>
											<div class="fs-2 font-weight-light">Login to your school dashboard</div>
										</div>
										<div class="mt-5">
											<v-text-field v-model="userId" label="User ID" outlined :rules="[rules.required]"></v-text-field>
										</div>
										<div>
											<v-text-field
												outlined
												:append-icon="
												show3
													? 'mdi-eye'
													: 'mdi-eye-off'
											"
												:rules="[
												rules.required,
												rules.emailMatch
											]"
												:type="show3 ? 'text' : 'password'"
												name="input-10-2"
												label="Password"
												hint="At least 8 characters"
												value="wqfasds"
												class="input-group--focused"
												@click:append="show3 = !show3"
											></v-text-field>
										</div>
										<div class="d-flex flex-lg-row flex-column align-lg-baseline justify-lg-space-between">
											<div class="d-flex mb-2">
												<v-btn color="primary" block depressed @click="goToPage">LOGIN</v-btn>
											</div>
											<div
												class="fs-4 password-info t-primary pb-1 text-center text-lg-start"
											>Forgot your User ID or Password?</div>
										</div>
									</v-col>
								</v-row>
							</div>
						</div>
					</v-card>
				</v-col>
			</v-row>
		</v-card>
	</div>
</template>

<script>
export default {
	data: () => ({
		logo: require("./../../assets/upschool-logo.png"),
		show3: false,
		userId: "",
		password: "Password",
		rules: {
			required: value => !!value || "Required.",
			min: v => v.length >= 8 || "Min 8 characters",
			emailMatch: () => "The email and password you entered don't match"
		}
	}),
	methods: {
		goToPage() {
			if (this.userId == "staff") {
				this.$router.push({ name: "staff.dashboard" });
				return this.$store.commit(
					"openSnackbar",
					"Welcome to UPSCHOL Staff!"
				);
			} else if (this.userId == "student") {
				this.$router.push({ name: "student.dashboard" });
				return this.$store.commit(
					"openSnackbar",
					"Welcome to UPSCHOL Student!"
				);
			} else if (this.userId == "admin") {
				this.$router.push({ name: "parent.dashboard" });
				return this.$store.commit(
					"openSnackbar",
					"Welcome to UPSCHOL Admin!"
				);
			} else {
				return;
			}
		}
	}
};
</script>

<style lang="scss" scoped>
.auth-body {
	font-family: "Roboto";
	background: #7038a8d9;
	height: 100vh;
	width: 100vw;
	overflow-x: hidden;
}

.bg-img {
	min-height: 100%;
	background-image: url("./../../assets/loginphoto.jpg");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
}
.password-info {
	border-bottom: 1px dashed purple;
}
</style>
