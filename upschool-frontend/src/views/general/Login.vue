<template>
	<div class="auth-body">
		<v-row no-gutters>
			<v-col cols="5">
				<div class="bg-img"></div>
			</v-col>
			<v-col>
				<div class="pa-4">
					<div class="d-flex flex-column align-center">
						<div class="mb-5">
							<v-img cover fixed width="220px" height="220px" :src="logo" />
						</div>
					</div>
					<div class="d-flex justify-center">
						<div>
							<v-row no-gutters justify="center" align="center">
								<v-col cols="7">
									<div class="mt-5">
										<div class="fs-2 font-weight-light">Login to your school dashboard</div>
									</div>
								</v-col>
								<v-col cols="7">
									<div class="mt-5">
										<v-text-field v-model="userId" label="User ID" outlined :rules="[rules.required]"></v-text-field>
									</div>
								</v-col>
								<v-col cols="7">
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
								</v-col>
								<v-col cols="7">
									<div class="d-flex align-baseline justify-space-between">
										<div>
											<v-btn color="primary" block depressed @click="goToPage">LOGIN</v-btn>
										</div>
										<div class="fs-4 password-info t-primary pb-1">Forgot your User ID or Password?</div>
									</div>
								</v-col>
							</v-row>
						</div>
					</div>
				</div>
			</v-col>
		</v-row>
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
	background: white;
}

.bg-img {
	height: calc(100vh - 100px);
	background-image: url("./../../assets/loginphoto.jpg");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
}
.password-info {
	border-bottom: 1px dashed purple;
}
</style>
