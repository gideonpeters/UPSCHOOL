<template>
  <div>
    <div class="my-5">{{type}}</div>

    <v-row>
      <v-col cols="12" md="3" sm="6">
        <metric-card :title="`Number of ${type}`" :value="items.length" />
      </v-col>
      <v-col cols="8" md="0"></v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field
          v-model="search"
          single-line
          hide-details
          flat
          :label="'Search ' + type.toLowerCase()"
          solo
          prepend-inner-icon="mdi-magnify"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-card class="mt-4 pa-3">
      <v-subheader class="d-flex mb-4 pa-0">
        <div class="fs-5 font-italic d-flex align-center">
          <v-icon small color="blue">mdi-information</v-icon>Click table item to view
        </div>
        <v-spacer></v-spacer>
        <div class="d-flex align-center justify-end">
          <!-- <v-menu offset-y :close-on-content-click="false">
            <template v-slot:activator="{ on }">
              <v-btn :ripple="false" v-on="on" color="grey" text>
                <v-icon color="grey" small>mdi-filter</v-icon>
                <div>Filter</div>
              </v-btn>
            </template>
            <v-card class="pa-3" flat>
              <v-row>
                <v-col cols="12">
                  <v-subheader class="fs-4 pa-0">PROPERTY</v-subheader>
                  <div class="d-flex fs-5 align-stretch">
                    <div class="d-flex align-center mr-3">
                      <v-icon small>mdi-dots-vertical</v-icon>
                      <div>Name</div>
                    </div>
                    <div class="d-flex align-center my-auto">
                      <input
                        placeholder="Name"
                        class="pa-3"
                        style="height: 16px; border: 0.5px solid grey;"
                      />
                    </div>
                    <div class="d-flex align-center ml-3">
                      <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                          <v-btn v-on="on" icon color="grey">
                            <v-icon small>mdi-plus-circle</v-icon>
                          </v-btn>
                        </template>
                        <v-list>
                          <v-list-item v-for="i in 3" :key="i">
                            <v-list-item-title>
                              <div class="fs-5 pointer">Matriculation Number</div>
                            </v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </div>
                  </div>
                </v-col>
              </v-row>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn x-small color="success" text>Done</v-btn>
              </v-card-actions>
            </v-card>
          </v-menu>-->

          <v-menu offset-y :close-on-content-click="false">
            <template v-slot:activator="{ on }">
              <v-btn color="grey" icon v-on="on">
                <v-icon color="grey" small>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item @click="createResource">
                <v-list-item-title>Create New {{ type }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
      </v-subheader>
      <!-- <v-card-title>
      </v-card-title>-->
      <v-data-table :headers="headers" :items="items" :search="search" class="elevation-1">
        <template v-slot:item.action="{ item }">
          <v-btn
            v-if="!noView"
            icon
            @click="!singlePage ? goToPage(item): showItem(item)"
            color="grey"
          >
            <v-icon small>mdi-eye</v-icon>
          </v-btn>
          <v-btn v-if="!noView" icon @click="editItem(item)" color="grey">
            <v-icon small>mdi-pencil</v-icon>
          </v-btn>
          <v-btn icon @click="deleteItem(item)" color="grey">
            <v-icon small>mdi-delete</v-icon>
          </v-btn>
        </template>
        <template v-slot:item.department="{ item }">{{item.department.short_name}}</template>
        <!-- <template v-slot:item.program="{ item }">{{item.program.name}}</template> -->
        <template v-slot:item.duration="{ item }">{{item.no_of_years}}</template>
        <!-- <template v-slot:item.name="{ item }">{{item.user.name}}</template> -->
        <template v-slot:item.visible="{ item }">
          <v-checkbox v-model="item.visible" disabled></v-checkbox>
        </template>

        <template v-slot:no-data>
          <div>No data available yet</div>
          <!-- <v-btn color="primary
          " @click="initialize">Reset</v-btn>-->
        </template>
        <template v-slot:item.college_name="{ item }">{{item.college.name}}</template>
        <template v-slot:item.college_short_name="{ item }">{{item.college.short_name}}</template>
      </v-data-table>
    </v-card>
    <v-dialog v-model="dialog1" max-width="600px">
      <!-- <v-card>
				<v-card-title>{{type}}</v-card-title>
				<v-card-text>
					<div
						class="py-3 text-capitalize"
						v-for="item in Object.keys(selectedResource)"
						:key="item.id"
					>{{item.replace(/_/g, " ")}}: {{String(selectedResource[item]).replace(/_/g, " ")}}</div>
				</v-card-text>
      </v-card>-->
      <v-card>
        <v-card-title>{{type}}</v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col>
                <div class="d-flex">
                  <div class="font-weight-bold mr-2">NAME:</div>
                  <div>{{selectedResource.name}}</div>
                </div>
                <div class="d-flex mt-4">
                  <div class="font-weight-bold mr-2">TOTAL SCORE:</div>
                  <div>{{selectedResource.total_score}}</div>
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
  components: {
    MetricCard
  },
  props: {
    items: {
      type: Array
    },
    headers: {
      type: Array
    },
    viewRoute: {
      type: String
    },
    type: {
      type: String,
      default: "def"
    },
    "single-page": {
      type: Boolean,
      default: false
    },
    noView: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      search: "",
      dialog1: false,
      selectedResource: {}
    };
  },
  methods: {
    goToPage(v) {
      // console.log(this.type.toLowercase());
      let id;
      let type = this.type;

      if (type.toLowerCase() == "students") {
        id = v.matric_number;
      } else if (type.toLowerCase() == "staff") {
        id = v.staff_number;
      } else {
        id = v.id;
      }
      this.$router.push({
        name: this.viewRoute,
        params: { id }
      });
    },
    createResource() {
      this.$emit("create");
    },
    viewItem() {},
    showItem(item) {
      this.dialog1 = true;
      this.selectedResource = item;
    },
    deleteItem(item) {
      this.$emit("delete", item);
    },
    editItem() {}
  }
};
</script>