<template>
  <v-app>
    <v-row>
      <v-col cols="4" class="bg-img"></v-col>
      <v-col cols="8">
        <v-card height="100%" class="d-flex pa-5 flex-column justify-center h-100 w-100" tile flat>
          <div class="d-flex flex-column align-center">
            <v-img cover fixed height="100px" :src="logo" />
          </div>
          <v-row justify="center" align="center" no-gutters>
            <v-col cols="12" md="12">
              <div class="fs-2 font-weight-light">Create Account</div>
            </v-col>
            <v-col class cols="12" sm="12">
              <v-select :items="items" label="Account Type" outlined></v-select>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="firstName"
                label="First Name"
                outlined
                :rules="[rules.required]"
                @keyup.enter="
													firstName
														? $refs.passwordInput.focus()
														: ''
												"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="middleName"
                label="Middle Name"
                outlined
                :rules="[rules.required]"
                @keyup.enter="
													middleName
														? $refs.passwordInput.focus()
														: ''
												"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="lastName"
                label="Last Name"
                outlined
                :rules="[rules.required]"
                @keyup.enter="
													lastName
														? $refs.passwordInput.focus()
														: ''
												"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                v-model="email"
                label="Email"
                outlined
                :rules="[rules.required]"
                @keyup.enter="
													email
														? $refs.passwordInput.focus()
														: ''
												"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                outlined
                ref="passwordInput"
                :append-icon="
													show3
														? 'mdi-eye'
														: 'mdi-eye-off'
												"
                :rules="[rules.required]"
                :type="
													show3 ? 'text' : 'password'
												"
                name="input-10-2"
                label="Password"
                v-model="password"
                hint="At least 8 characters"
                value="wqfasds"
                class="input-group--focused"
                @click:append="show3 = !show3"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                outlined
                ref="passwordInput"
                :append-icon="
													show4
														? 'mdi-eye'
														: 'mdi-eye-off'
												"
                :rules="[rules.required, rules.passwordMatch]"
                :type="
													show4 ? 'text' : 'password'
												"
                name="input-10-2"
                label="Confirm Password"
                v-model="confirmPassword"
                hint="Must match password"
                value="wqfasds"
                class="input-group--focused"
                @click:append="show4 = !show4"
              ></v-text-field>
            </v-col>
            <v-col>
              <div
                class="d-flex flex-lg-row flex-column align-lg-baseline justify-lg-space-between"
              >
                <!-- <div class="d-flex mb-2">
                  <v-btn
                    color="primary"
                    block
                    depressed
                    :disabled="
														!(
															!!userId &&
															!!password
														)
													"
                    @click="goToPage"
                >LOGIN</v-btn>-->
                <!-- </div> -->
                <div class="d-flex mb-2">
                  <v-btn color="primary" block depressed @click="goToCreatePage">CREATE ACCOUNT</v-btn>
                </div>
                <div
                  class="fs-4 password-info t-primary pb-1 text-center text-lg-start"
                >Already a user?</div>
              </div>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      logo: require("./../../assets/upschool-logo.png"),
      show3: false,
      show4: false,
      userId: "",
      password: "secret",
      confirmPassword: "",
      firstName: "",
      lastName: "",
      middleName: "",
      email: "",
      userType: "",
      rules: {
        required: value => !!value || "Required.",
        min: v => v.length >= 6 || "Min 6 characters",
        emailMatch: () => "The email and password you entered don't match",
        passwordMatch: () =>
          this.password == this.confirmPassword ||
          "The password you entered doesn't match"
      }
    };
  },
  methods: {
    goToPage() {},
    goToCreatePage() {}
  }
};
</script>

<style lang="scss" scoped>
.bg-img {
  min-height: 100vh;
  background-image: url("./../../assets/loginphoto.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
}
</style>