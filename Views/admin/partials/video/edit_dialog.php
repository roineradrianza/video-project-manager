<v-dialog v-model="projects.video.dialog" max-width="600px" @click:outside="projects.video.reset(); projects.video.dialog = false;">
    <v-card>
        <v-toolbar elevation="0">
            <v-toolbar-title>Actualizar nombre del video</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click="projects.video.reset(); projects.video.dialog = false;">
                    <v-icon color="grey">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-divider></v-divider>

        <v-card-text class="pb-0">
            <v-form>
                <v-row>
                    <v-col cols="12">
                        <v-text-field v-model="projects.video.item.name" label="Nombre del video" filled></v-text-field>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>

        <v-card-actions class="px-6">
            <v-spacer></v-spacer>
            <v-btn color="primary" block @click="projects.video.save()" :loading="projects.video.edit_loading">
                Guardar
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>