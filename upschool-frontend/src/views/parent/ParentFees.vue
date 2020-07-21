<template>
  <v-app>
    <div>
      <div class="d-flex justify-space-between my-5">
        <div>Fee Management</div>
        <div>
          <v-btn depressed outlined>APPLY FEE</v-btn>
        </div>
      </div>
      <div>
        <!-- <div class="d-flex mb-4">
					<metric />
        </div>-->
        <v-card flat class="pa-3">
          <v-tabs v-model="tab" background-color="transparent">
            <v-tab v-for="item in items" :key="item.id">{{ item.tab }}</v-tab>
          </v-tabs>

          <v-tabs-items v-model="tab">
            <v-tab-item v-for="(item, ix) in items" :key="ix">
              <div v-if="ix == 0">
                <v-row>
                  <v-col cols="12" md="9">
                    <v-card flat class="pa-3 elevation-1">
                      <v-row>
                        <v-col cols="12" md="4">
                          <v-subheader>FEES</v-subheader>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-col cols="12" sm="5" md="5">
                          <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            outlined
                            hide-details
                          ></v-text-field>
                        </v-col>
                      </v-row>

                      <v-data-table
                        :headers="headers"
                        :items="desserts"
                        :search="search"
                        sort-by="calories"
                        @click:row="goToPage"
                        :items-per-page="5"
                      >
                        <template v-slot:item.name="{ item }">
                          <div>{{item.name}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>
                        <template v-slot:footer>
                          <div>{{item.name}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>
                        <template v-slot:item.action="{ item }">
                          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
                          <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
                        </template>
                      </v-data-table>
                    </v-card>
                  </v-col>
                  <v-col cols="12" md="3">
                    <v-card flat class="pa-3 elevation-1">
                      <v-subheader>PAYABLE GROUPS</v-subheader>

                      <div class="d-flex flex-column">
                        <div
                          class="d-flex fs-4 mb-3"
                          v-for="(payableGroup, i) in payableGroups"
                          :key="i"
                        >
                          <div class="pr-4">
                            <v-icon size="15">mdi-circle-slice-8</v-icon>
                          </div>
                          <div>{{payableGroup}}</div>
                        </div>
                        <v-btn color="success" depressed>Add Payable Group</v-btn>
                      </div>
                    </v-card>

                    <!-- <v-card flat class="pa-3 elevation-1 mt-4">
											<v-subheader>PRIORITY LEVELS</v-subheader>

											<div class="d-flex fs-4 mb-3">
												<div class="pr-4">
													<v-icon size="15" color="info lighten-3">mdi-circle-slice-8</v-icon>
												</div>
												<div>Voluntary</div>
											</div>
											<div class="d-flex fs-4 mb-3">
												<div class="pr-4">
													<v-icon size="15" color="red lighten-3">mdi-alert-circle</v-icon>
												</div>
												<div>Mandatory</div>
											</div>
                    </v-card>-->
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="12">
                    <v-card flat class="pa-3 elevation-1">
                      <v-row>
                        <v-col cols="4">
                          <v-subheader>STUDENT FEES</v-subheader>
                          <div class="fs-5 ml-3">
                            <v-icon color="blue accent-3" size="10" class="mr-1">mdi-information</v-icon>Click to view details
                          </div>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-col cols="5" sm="5" md="5">
                          <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                          ></v-text-field>
                        </v-col>
                      </v-row>

                      <v-data-table
                        :headers="headers2"
                        :items="studentFees"
                        :search="search"
                        sort-by="calories"
                        @click:row="goToPage"
                        :items-per-page="5"
                      >
                        <template v-slot:item.name="{ item }">
                          <div class="my-2">{{item.name}}</div>
                          <div class="mb-2 font-italic">{{ item.calories }}</div>
                          <!-- <div class="mb-2 fs-4 font-weight-bold">Not paid</div> -->
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.fee="{  }">
                          <div>{{getFee}}</div>
                          <div class="mb-2 fs-4 font-weight-bold">{{ 'paid' }}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.protein="{ }">
                          <div>{{Date.now()}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.created="{ }">
                          <div>{{Date.now()}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>
                        <template v-slot:item.action="{ item }">
                          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
                          <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
                        </template>
                      </v-data-table>
                    </v-card>
                  </v-col>
                </v-row>

                <!-- <div>dkdk</div> -->
              </div>

              <div v-if="ix == 1">
                <v-row>
                  <v-col cols="12">
                    <v-card flat class="pa-3 elevation-1">
                      <v-row align-center justify-space-between>
                        <v-col cols="4">
                          <v-subheader>STUDENT FEES [DEFAULTERS]</v-subheader>
                        </v-col>
                        <v-spacer></v-spacer>

                        <v-col cols="4" sm="4" md="4">
                          <div class="d-flex align-center">
                            <div v-if="showSearch">
                              <v-text-field
                                @blur="toggleIcon"
                                v-model="search"
                                prepend-inner-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                              ></v-text-field>
                            </div>
                            <div class="d-flex justify-end">
                              <v-icon @click="toggleIcon" v-if="!showSearch">mdi-magnify</v-icon>
                              <v-icon>mdi-filter</v-icon>
                            </div>
                          </div>
                        </v-col>
                      </v-row>

                      <v-data-table
                        :headers="headers2"
                        :items="studentFees"
                        :search="search"
                        sort-by="calories"
                        @click:row="goToPage"
                        :items-per-page="5"
                      >
                        <template v-slot:item.name="{ item }">
                          <div class="my-2">{{item.name}}</div>
                          <div class="mb-2 font-italic">{{ item.calories }}</div>
                          <div class="mb-2 fs-4 font-weight-bold">Not paid</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.fee="{  }">
                          <div>{{getFee}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.protein="{ }">
                          <div>{{Date.now()}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>

                        <template v-slot:item.created="{ }">
                          <div>{{Date.now()}}</div>
                          <!-- <v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip> -->
                        </template>
                        <template v-slot:item.action="{ item }">
                          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
                          <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
                        </template>
                      </v-data-table>
                    </v-card>
                  </v-col>
                </v-row>
              </div>

              <div v-if="ix == 2">
                <div class="pa-auto">Currently under construction</div>
              </div>
            </v-tab-item>
          </v-tabs-items>
        </v-card>
      </div>
    </div>
  </v-app>
</template>

<script>
// import Metric from "./../../components/parent/Metric";
// import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    // Metric
    // apexchart: VueApexCharts
  },
  // name: "attendance",
  data: () => ({
    search: "",
    showSearch: false,
    tab: null,
    items: [
      { id: 1, tab: "OVERVIEW" },
      { id: 2, tab: "FEE DEFAULTERS" },
      { id: 3, tab: "SETTINGS" }
    ],
    headers: [
      {
        text: "NAME",
        align: "start",
        sortable: false,
        value: "name"
      },
      { text: "DESCRIPTION", value: "fat" },
      { text: "AMOUNT (₦)", value: "calories" },
      // { text: "PRIORITY", value: "carbs" },
      { text: "ACTIONS", value: "action" }
      // { text: "WEIGHTED SCORE", value: "protein" }
    ],
    headers2: [
      {
        text: "NAME",
        align: "left",
        sortable: false,
        value: "name"
      },
      { text: "FEE", value: "fee" },
      { text: "AMOUNT", value: "fat" },
      { text: "FINE", value: "carbs" },
      { text: "DUE DATE", value: "protein" },
      { text: "CREATED", value: "created" },
      { text: "ACTIONS", value: "action" }
    ],
    studentFees: [
      {
        id: 1,
        name: "Uzoatuegwu Petrina Chidera",
        calories: "15CJ02889",
        fat: 1500448,
        carbs: "0.00",
        residence: "Dorcas Hall",
        protein: 500
      },
      {
        id: 2,
        name: "Shobande Josephine",
        calories: "15CJ02873",
        fat: 1500448,
        carbs: "0.00",
        residence: "Dorcas Hall",
        protein: 500
      },
      {
        id: 3,
        name: "Owolabi Ifeoluwa Anuoluwa",
        calories: "15CJ02880",
        fat: 1500448,
        carbs: "0.00",
        residence: "Deborah Hall",
        protein: 500
      },
      {
        id: 4,
        name: "Udochi Dikamsiyochi Young",
        calories: "15CJ02885",
        fat: 1500448,
        carbs: "0.00",
        residence: "Daniel Hall",
        protein: 400
      }
    ],
    desserts: [
      {
        id: 1,
        name: "School Fees: Engineering 500 level",
        calories: 900000,
        fat: "School fees for all students in 500 level Engineering courses.",
        carbs: "Compulsory"
        // protein: 4.+
      },
      {
        id: 2,
        name: "School Fees: CST 300 level",
        calories: 980000,
        fat: "School fees for all students in 300 level CST courses.",
        carbs: "Compulsory"
        // protein: 4.+
      },
      {
        id: 3,
        name: "Damaged school property",
        calories: 14593,
        fat: "Due to damaged items in the hall of residence",
        carbs: "Compulsory"
        // protein: 4.+
      },
      {
        id: 4,
        name: "Medical Bills",
        calories: 50000,
        fat: "Medical charge for services offered at the health center",
        carbs: "Compulsory"
        // protein: 4.+
      },
      {
        id: 5,
        name: "SWEP Toolkit",
        calories: 980000,
        fat: "Payment for SWEP toolbox and PPE",
        carbs: "Voluntary"
        // protein: 4.+
      }
    ],
    payableGroups: [
      "All Students",
      "All 100 level students",
      "All CST students",
      "All Daniel Hall residents"
    ]
  }),
  computed: {
    getFee() {
      return this.desserts[0].name;
    }
  },
  methods: {
    goToPage(v) {
      this.$router.push({
        name: "parent.attendance-details",
        params: { id: v.id }
      });
    },
    getColor(calories) {
      if (calories == "Active") return "green accent-3";
      else if (calories == "Inactive") return "red accent-2";
      else return "green";
    },
    toggleIcon() {
      this.showSearch = !this.showSearch;
    }
  }
};
</script>