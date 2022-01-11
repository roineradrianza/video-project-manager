<v-dialog v-model="users.dialog" max-width="1200px">
    <template #activator="{ on, attrs }">
        <v-btn color="secondary" dark rounded class="mb-2" v-bind="attrs" v-on="on">
            <v-icon>mdi-plus</v-icon>
            Añadir usuario
        </v-btn>
    </template>
    <v-card>
        <v-toolbar elevation="0">
            <v-toolbar-title>{{ formTitle }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn icon @click="users.dialog = false">
                    <v-icon color="grey">mdi-close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <v-divider></v-divider>

        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12" sm="12" md="4">
                        <label>Nombre</label>
                        <v-text-field name="first_name" class="mt-3" v-model="users.user.first_name" outlined solo>
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                        <label>Apellido</label>
                        <v-text-field name="last_name" class="mt-3" v-model="users.user.last_name" outlined solo>
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                        <label>Correo electrónico</label>
                        <v-text-field name="email" class="mt-3" v-model="users.user.email" outlined solo></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <label>Contraseña</label>
                        <v-text-field type="password" class="mt-3" v-model="users.user.password" outlined solo>
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                        <label>Confirmar contraseña</label>
                        <v-text-field type="password" class="mt-3" v-model="users.user.password_confirm" outlined solo>
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>

        <v-card-actions class="px-8">
            <v-spacer></v-spacer>
            <v-btn color="secondary white--text" block @click="users.save()">
                Guardar
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>