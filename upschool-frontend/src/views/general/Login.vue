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
              <div v-if="!isGuest" class="d-flex justify-center">
                <v-row justify="center" align="center" no-gutters>
                  <v-col cols="12" md="8">
                    <div class>
                      <div class="fs-2 font-weight-light">Login to your school dashboard</div>
                    </div>
                    <div class="mt-5">
                      <v-text-field
                        v-model="userId"
                        label="User ID"
                        outlined
                        :rules="[rules.required]"
                        @keyup.enter="
													userId
														? $refs.passwordInput.focus()
														: ''
												"
                      ></v-text-field>
                    </div>
                    <div>
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
                        @keyup.enter="
													userId ? goToPage() : ''
												"
                      ></v-text-field>
                    </div>
                    <div
                      class="d-flex flex-lg-row flex-column align-lg-baseline justify-lg-space-between"
                    >
                      <div class="d-flex mb-2">
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
                        >LOGIN</v-btn>
                      </div>
                      <div class="d-flex mb-2">
                        <v-btn
                          color="primary"
                          block
                          depressed
                          @click="goToCreatePage"
                        >CREATE ACCOUNT</v-btn>
                      </div>
                      <div
                        class="fs-4 password-info t-primary pb-1 text-center text-lg-start"
                      >Forgot your User ID or Password?</div>
                    </div>
                  </v-col>
                </v-row>
              </div>
              <div v-else class="d-flex flex-column mt-5">
                <v-btn color="info" @click="signIn(1)">Sign In as Admin</v-btn>
                <v-btn class="my-4" color="primary" outlined @click="signIn(2)">Sign In as Student</v-btn>
                <v-btn color="primary" depressed @click="signIn(3)">Sign In as Staff</v-btn>
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
    isGuest: true,
    password: "secret",
    rules: {
      required: value => !!value || "Required.",
      min: v => v.length >= 6 || "Min 6 characters",
      emailMatch: () => "The email and password you entered don't match"
    }
  }),
  methods: {
    async goToPage(guestInfo) {
      try {
        if (this.userId == "admin" && !guestInfo) {
          return this.$router.push({ name: "parent.dashboard" });
        }
        let body = {
          email: this.userId,
          password: this.password
        };
        let res = await this.$store.dispatch(
          "login",
          guestInfo ? guestInfo : body
        );

        if (res.data.status) {
          if (res.type == "student") {
            return this.$router.push({ name: "student.dashboard" });
          } else if (res.type == "staff") {
            return this.$router.push({ name: "staff.dashboard" });
          } else if (res.type == "admin") {
            return this.$router.push({ name: "parent.home" });
          } else {
            return;
          }
        } else {
          this.$store.commit("openSnackbar", res.data.message);
        }
      } catch (error) {
        this.$store.commit("openSnackbar", "Something went wrong. Try again.");
        throw error;
        // console.log(error);
      }
    },
    goToCreatePage() {
      this.$router.push({ name: "main.register" });
    },
    async signIn(v) {
      let studentBody = {
        email: "student@test.com",
        password: "password"
      };

      let adminBody = {
        email: "admin@test.com",
        password: "password"
      };

      let staffBody = {
        email: "staff@test.com",
        password: "password"
      };

      switch (v) {
        case 1:
          this.goToPage(adminBody);
          break;
        case 2:
          this.goToPage(studentBody);
          break;
        case 3:
          this.goToPage(staffBody);
          break;
        default:
          this.$store.commit("openSnackbar", "You need to login");
          break;
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
