<v-dialog v-model="users.delete_dialog" max-width="700px">
    <v-card>
        <v-card-title class="headline">¿Estás seguro de que quieres eliminar este
            usuario?</v-card-title>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="users.reset(); users.delete_dialog = false">Cancelar</v-btn>
            <v-btn color="blue darken-1" text @click="users.delete()">Continuar
            </v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-card>
</v-dialog>