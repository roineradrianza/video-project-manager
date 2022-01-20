<v-form>
    <v-row>
        <v-col cols="12" md="6">
            <v-text-field v-model="projects.video.item.name" label="Nombre del video" filled></v-text-field>
        </v-col>
        <v-col cols="12" md="6">
            <v-file-input v-model="projects.video.item.video" label="Agregar video" filled prepend-icon="mdi-video"
                accept="video/mp4,video/x-m4v,video/*" show-size>
                <template #selection="{ text }">
                    <v-chip small color="primary" v-if="text != ' (0 B)'">
                        {{ text }}
                    </v-chip>
                </template>
            </v-file-input>
        </v-col>
        <v-col cols="12">
            <v-btn color="primary" @click="projects.video.save()" :loading="projects.video.edit_loading" block>
                Subir
            </v-btn>
        </v-col>
    </v-row>
</v-form>