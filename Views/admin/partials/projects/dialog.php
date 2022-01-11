<v-dialog v-model="projects.dialog" max-width="600px">
    <template #activator="{ on, attrs }">
        <v-btn color="secondary" dark rounded class="mb-2" v-bind="attrs" v-on="on">
            <v-icon>mdi-plus</v-icon>
            Añadir proyecto
        </v-btn>
    </template>
    <v-card>
        <v-toolbar elevation="0">
            <v-toolbar-title>{{ formTitle }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click="projects.dialog = false">
                    <v-icon color="grey">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-divider></v-divider>

        <v-card-text>
            <v-form>
                <v-row>
                    <v-col cols="12">
                        <label>Nombre</label>
                        <v-text-field name="first_name" v-model="projects.project.name">
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>

        <v-card-actions class="px-8">
            <v-spacer></v-spacer>
            <v-btn color="secondary white--text" block @click="projects.save()" :disabled="projects.project.name == ''">
                Guardar
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>