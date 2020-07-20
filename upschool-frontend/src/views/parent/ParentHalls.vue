<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col cols="3">
          <metric-card title="Number of Halls" :value="halls.length" />
        </v-col>
        <v-col cols="3">
          <metric-card
            title="Total Capacity"
            :value="
							halls.reduce((acc, val) => acc + val.capacity, 0)
						"
          />
        </v-col>
        <v-col cols="12">
          <v-col cols="12" md="12">
            <div class="text-lg-right">
              <v-menu offset-y close-on-click close-on-content-click>
                <template v-slot:activator="{ on }">
                  <v-spacer></v-spacer>
                  <v-btn color="primary" depressed dark v-on="on">ACTIONS</v-btn>
                </template>
                <v-list>
                  <v-list-item v-for="(item, index) in actions" :key="index">
                    <v-list-item-title class="pointer" @click="item.fn">{{ item.title }}</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
            </div>
            <div class>
              <v-dialog
                v-model="dialogFull"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
              >
                <v-card>
                  <v-toolbar dark color="primary">
                    <v-btn icon dark @click="dialogFull = false">
                      <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>CREATE HALL(S)</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                      <v-btn
                        dark
                        text
                        v-if="isBulk"
                        :disabled="
													isBulk
														? !dummy ||
														  dummy.length < 0
														: null
												"
                        @click="saveBulk"
                      >Save</v-btn>
                    </v-toolbar-items>
                  </v-toolbar>
                  <!-- <v-list>
										<v-list-item>
                  <v-list-item-content>-->
                  <v-container>
                    <v-checkbox label="Bulk Addition" v-model="isBulk"></v-checkbox>
                  </v-container>
                  <!-- </v-list-item-content>
										</v-list-item>
                  </v-list>-->
                  <v-list three-line subheader v-if="!isBulk">
                    <v-list-item>
                      <v-list-item-content>
                        <v-container>
                          <v-list-item-title>Create Hall</v-list-item-title>
                          <v-row align="center">
                            <v-col cols="6">
                              <v-text-field
                                outlined
                                label="Name"
                                v-model="
																	hallName
																"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                              <v-text-field
                                outlined
                                label="Description (Optional)"
                                v-model="
																	hallDescription
																"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                              <v-text-field
                                type="number"
                                outlined
                                label="Capacity (Optional)"
                                v-model="
																	hallCapacity
																"
                              ></v-text-field>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                :items="
																	roomTypes
																"
                                label="Room Type"
                                outlined
                              >
                                <template
                                  v-slot:item="{
																		item,
																	}"
                                >
                                  {{
                                  item.title
                                  }}
                                </template>
                                <template
                                  v-slot:selection="{
																		item,
																	}"
                                >
                                  {{
                                  item.title
                                  }},
                                </template>
                              </v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                multiple
                                clearable
                                :items="[
																	'Male',
																	'Female',
																]"
                                label="Preferred Sex to be allocated to this hall"
                                outlined
                              ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                multiple
                                clearable
                                :items="[
																	'100',
																	'200',
																	'300',
																	'400',
																	'500',
																]"
                                label="Preferred Level to be allocated to this hall"
                                outlined
                              ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                multiple
                                clearable
                                :items="[
																	'Nigerian',
																	'International',
																	'American',
																	'Chinese',
																	'Congolese',
																	'Kenyan',
																]"
                                label="Preferred Nationality to be allocated to this hall"
                                outlined
                              ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                multiple
                                clearable
                                :items="[
																	'Computer Engineering',
																	'Computer Science',
																	'International Relations',
																]"
                                label="Preferred Program to be allocated to this hall (Optional)"
                                outlined
                              ></v-select>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6">
                              <v-select
                                multiple
                                clearable
                                :items="[
																	'Undergraduate',
																	'Postgraduate',
																]"
                                label="Preferred Student type to be allocated to this hall (Optional)"
                                outlined
                              ></v-select>
                            </v-col>
                            <v-col cols="12">
                              <div class="d-flex">
                                <v-spacer></v-spacer>
                                <v-btn color="success" depressed>SAVE</v-btn>
                              </div>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                  <v-list three-line subheader v-if="isBulk">
                    <v-list-item>
                      <v-list-item-content>
                        <v-container>
                          <v-list-item-title>Add Halls (Bulk)</v-list-item-title>
                          <v-row>
                            <!-- <v-col cols="12">
                            </v-col>-->
                            <v-col cols="12" md="6">
                              <v-btn
                                class="my-5"
                                tile
                                outlined
                                color="primary"
                                text
                                @click="
																	downloadFormat
																"
                              >Download format</v-btn>
                              <v-file-input
                                persistent-hint
                                hint="make sure to download template before uploading file and upload with headers from template still present and unchanged in position"
                                prepend-icon
                                prepend-inner-icon="mdi-paperclip"
                                outlined
                                v-model="file"
                                accept=".csv"
                                @change="
																	showCsv
																"
                                label="Select csv file"
                              ></v-file-input>

                              <!-- <v-btn
																class="mt-4"
																color="primary"
																text
																tile
																v-if="bulkFile"
																outlined
																@click="
																	csvImport
																"
															>
																Preview imported
																CSV
                              </v-btn>-->
                            </v-col>
                            <v-col cols="12" md="6">
                              <div>
                                The required
                                fields are:
                                <ul class="mt-2">
                                  <li>Name</li>
                                </ul>
                              </div>
                              <div class="my-2">
                                Fields beginning
                                with preferred
                                can take more
                                than one value
                                seperated by
                                commas unless
                                where specified.
                                Note the
                                following:
                                <ul class="mt-2">
                                  <li>
                                    Preferred
                                    Levels
                                    can take
                                    values
                                    of
                                    500,400,300,400,100;
                                    leaving
                                    it blank
                                    means
                                    students
                                    of any
                                    level
                                    can be
                                    allocated
                                    the hall
                                  </li>
                                  <li>
                                    Preferred
                                    Sex can
                                    take
                                    values
                                    of
                                    male,female;
                                    leaving
                                    it empty
                                    means
                                    room
                                    allocation
                                    for this
                                    hall
                                    will be
                                    mixed
                                  </li>
                                  <li>
                                    Preferred
                                    Nationality
                                    can take
                                    values
                                    of any
                                    nationality
                                    (e.g.
                                    Nigerian,
                                    American);
                                    you may
                                    also
                                    choose
                                    to
                                    specify
                                    local or
                                    international
                                    (not
                                    both);
                                    leaving
                                    this
                                    field
                                    empty
                                    means
                                    this
                                    hall can
                                    be
                                    allocated
                                    to
                                    students
                                    of any
                                    nationality
                                  </li>
                                  <li>
                                    Preferred
                                    Student
                                    Type can
                                    take
                                    values
                                    of
                                    postgraduate
                                    or
                                    undergraduate
                                    (not
                                    both);
                                    you can
                                    specify
                                    masters,bachelors,doctoral
                                    for
                                    specificity,
                                    leaving
                                    it blank
                                    means
                                    students
                                    of any
                                    type can
                                    be
                                    allocated
                                    this
                                    hall
                                  </li>
                                  <li>
                                    Preferred
                                    Program
                                    can take
                                    values
                                    of the
                                    exact
                                    program
                                    name (it
                                    must be
                                    the
                                    exact
                                    name of
                                    the
                                    program
                                    as you
                                    saved
                                    it) e.g.
                                    Computer
                                    Engineering,
                                    Computer
                                    Science;
                                    leaving
                                    it blank
                                    means
                                    this
                                    hall can
                                    be
                                    assigned
                                    to
                                    students
                                    from any
                                    program
                                  </li>
                                </ul>
                              </div>
                            </v-col>
                            <v-col
                              cols="12"
                              md="12"
                              v-if="
																dummy.length > 0
															"
                            >
                              <v-card flat class="pa-3">
                                <v-subheader class="pa-0">PREVIEW</v-subheader>
                                <v-data-table
                                  :headers="
																		bulkHeaders
																	"
                                  :items="
																		dummy
																	"
                                ></v-data-table>
                              </v-card>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
                </v-card>
              </v-dialog>
            </div>
          </v-col>
        </v-col>
        <v-col cols="12">
          <v-card flat class="pa-3">
            <v-data-table :headers="headers" :items="halls">
              <template v-slot:item.name="{ item }">
                <div class="text-capitalize">{{ item.name }}</div>
              </template>
              <template v-slot:item.preferred_student_type="{ item }">
                <v-chip
                  small
                  class="text-uppercase"
                  v-for="(it,
									ix) in item.preferred_student_type"
                  :key="ix"
                >{{ it }}</v-chip>
              </template>

              <template v-slot:item.actions="{ item }">
                <div class="d-flex align-center justify-center">
                  <v-btn
                    color="grey"
                    icon
                    @click="
											goToPage(
												'parent.halls.details',
												item.id
											)
										"
                  >
                    <v-icon small>mdi-eye</v-icon>
                  </v-btn>
                  <v-btn color="grey" icon>
                    <v-icon small>mdi-delete</v-icon>
                  </v-btn>
                </div>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
// import DownloadCsv from "vue-json-csv";
import { saveAs } from "file-saver";
import MetricCard from "@/components/parent/Metric";
import Papa from "papaparse";
import Axios from "axios";
export default {
  components: {
    MetricCard
    // DownloadCsv
  },
  data() {
    return {
      dialogFull: false,
      isBulk: true,
      roomTypes: [],
      dummy: "",
      bulkHeaders: [
        { text: "NAME", value: "name" },
        { text: "CAPACITY", value: "capacity" },
        { text: "DESCRIPTION", value: "description" },
        { text: "PREFERRED SEX", value: "preferred_sex" },
        { text: "PREFERRED PROGRAM(S)", value: "preferred_program" },
        {
          text: "PREFERRED NATIONALITIES",
          value: "preferred_nationality"
        },
        {
          text: "PREFERRED STUDENT TYPE(S)",
          value: "preferred_student_type"
        },
        { text: "PREFERRED LEVEL(S)", value: "preferred_level" }
      ],
      bulkFile: "",
      file: [],
      hallCapacity: "",
      hallName: "",
      hallDescription: "",
      halls: [],
      headers: [
        { text: "NAME", value: "name", sortable: true },
        { text: "DESCRIPTION", value: "description", sortable: true },
        { text: "CAPACITY", value: "capacity", sortable: true },
        {
          text: "PREFERRED STUDENT TYPES",
          value: "preferred_student_type",
          sortable: true
        },
        {
          text: "ACTIONS",
          value: "actions",
          sortable: true,
          align: "center"
        }
      ],
      items: [
        {
          id: 1,
          name: "Daniel Hall",
          wings: 4,
          capacity: 4,
          description: "this is daniel hall",
          preferred_sex: "male",
          preferred_program_id: null,
          preferred_nationality: "local",
          preferred_student_type: "Undergraduate"
        },
        {
          id: 2,
          name: "Esther Hall",
          wings: 4,
          capacity: 4,
          description: "this is esther hall",
          preferred_sex: "female",
          preferred_program_id: null,
          preferred_nationality: "international",
          preferred_student_type: "Undergraduate"
        },
        {
          id: 3,
          name: "Lupita Hall",
          wings: 4,
          capacity: 4,
          description: "this is lupita hall",
          preferred_sex: "female",
          preferred_program_id: null,
          preferred_nationality: "local",
          preferred_student_type: "postgraduate"
        }
      ],
      actions: [
        {
          title: "Create Hall",
          fn: () => (this.dialogFull = true)
        }
      ]
    };
  },
  computed: {
    csvData() {
      return [
        {
          name: "",
          capacity: "",
          description: "",
          preferred_sex: "",
          preferred_program: "",
          preferred_nationality: "",
          preferred_student_type: "",
          preferred_level: ""
        }
      ];
    }
  },
  methods: {
    goToPage(routeName, id) {
      this.$router.push({ name: routeName, params: { id: id } });
    },
    async csvImport() {
      // let res = await Papa.parse(this.bulkFile, { header: true });
      // console.log(res);
    },
    async downloadFormat() {
      // let array = ["name", "id"];
      var csv = await Papa.unparse(this.csvData);
      // console.log(csv);

      var csvData = new File([csv], "hall_template.csv", {
        type: "text/csv;charset=utf-8"
      });

      saveAs(csvData);
    },
    showCsv(ent) {
      if (ent) {
        var reader = new FileReader();

        reader.readAsText(ent);
        reader.onload = async evt => {
          this.dummy = await Papa.parse(evt.target.result, {
            header: true,
            skipEmptyLines: true
          }).data;
          // console.log(this.dummy);
        };
      }
    },
    async saveBulk() {
      try {
        if (this.dummy.length > 0) {
          let items = this.dummy.map(item => ({
            name: item.name,
            description: item.description,
            capacity: item.capacity,
            preferred_sex: item.preferred_sex
              ? JSON.stringify(item.preferred_sex.split(","))
              : null,
            preferred_program: item.preferred_program
              ? JSON.stringify(item.preferred_program.split(","))
              : null,
            preferred_nationality: item.preferred_nationality
              ? JSON.stringify(item.preferred_nationality.split(","))
              : null,
            preferred_student_type: item.preferred_student_type
              ? JSON.stringify(item.preferred_student_type.split(","))
              : null,
            preferred_level: item.preferred_level
              ? JSON.stringify(item.preferred_level.split(","))
              : null
          }));

          let res = await Axios.post("halls-bulk", {
            data: JSON.stringify(items)
          });

          this.$store.commit("openSnackbar", res.data.message);

          console.log(res.data);
          this.isBulk = false;
          this.dialogFull = false;
        }
      } catch (error) {
        console.log(error);
      }
    },
    async getHalls() {
      try {
        let res = await Axios.get("hall");
        console.log(res.data);
        this.halls = res.data.data;
      } catch (error) {
        console.log(error);
      }
    }
  },
  async mounted() {
    try {
      this.getHalls();
    } catch (error) {
      console.log(error);
    }
  },
  watch: {
    file(v) {
      if (!v) {
        this.dummy = [];
      }
    }
  }
};
</script>
