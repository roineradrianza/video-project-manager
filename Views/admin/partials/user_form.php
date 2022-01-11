<v-form v-model="users.form" lazy-validation>
    <v-card-text>
        <v-container>
            <v-row>
                <v-col cols="12" md="6">
                    <label class="body-1 font-weight-thin pl-1">Nombre</label>
                    <v-text-field type="text" name="first_name" v-model="users.user.first_name"
                        class="mt-3 fl-text-input" :rules="validations.nameRules" outlined></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                    <label class="body-1 font-weight-thin pl-1">Apellido</label>
                    <v-text-field type="text" name="last_name" v-model="users.user.last_name" class="mt-3 fl-text-input"
                        :rules="validations.nameRules" outlined></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                    <label class="body-1 font-weight-thin pl-1">Correo electrónico</label>
                    <v-text-field type="email" name="email" v-model="users.user.email" class="mt-3 fl-text-input"
                        :rules="validations.emailRules" outlined></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                    <label class="body-1 font-weight-thin pl-1">Contraseña</label>
                    <v-text-field type="password" name="password" v-model="users.user.password"
                        class="mt-3 fl-text-input" outlined></v-text-field>
                </v-col>

                <v-col cols="12" md="6">
                    <label class="body-1 font-weight-thin pl-1">Confirmar contraseña</label>
                    <v-text-field type="password" name="password_confirm" v-model="users.user.password_confirm"
                        class="mt-3 fl-text-input" outlined></v-text-field>
                </v-col>
            </v-row>
        </v-container>
    </v-card-text>

    <v-card-actions class="px-8">
        <v-spacer></v-spacer>
        <v-btn color="secondary white--text" block @click="users.save()" :disabled="!users.form">
            Guardar
        </v-btn>
    </v-card-actions>
</v-form>