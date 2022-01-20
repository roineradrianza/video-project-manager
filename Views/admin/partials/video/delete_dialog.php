<v-dialog v-model="projects.video.delete_dialog" max-width="700px" @click:outside="projects.video.reset(); projects.video.delete_dialog = false;">
    <v-card>
        <v-card-title class="headline no-word-break">¿Estás seguro de que quieres eliminar este video?</v-card-title>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="projects.video.reset(); projects.video.delete_dialog = false">Cancelar</v-btn>
            <v-btn color="blue darken-1" text @click="projects.video.delete()">Continuar</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-card>
</v-dialog>