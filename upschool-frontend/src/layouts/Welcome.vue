<template>
  <v-app>
    <v-app-bar app color="primary accent-4" dark>

      <v-toolbar-title>UPSCHOOL</v-toolbar-title>

      <v-spacer></v-spacer>

      
    </v-app-bar>
    <v-content>
        <v-container>
          <v-row justify="start" align="center">
            <v-col cols="6">
				<div><h1>Welcome to UPSCHOOL</h1></div>
				<div><h4>School away from school</h4></div>
				<v-btn tile color="primary" class="mt-5">GET STARTED</v-btn>
            </v-col>
			<v-col>
				<v-img height="500px" :src="logo"></v-img>
			</v-col>
          </v-row>
        </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
	data() {
		return {
			logo: require('./../assets/upschool-logo.png')
		}
	},
}
</script>