<v-row class="login-container gradient py-16" justify="center">
    <v-col class="mt-16 mt-md-0 bg-white rounded-lg py-0" cols="11" md="10" lg="8">
        <v-row>
            <v-col class="px-0 py-0" cols="12" md="6">
                <v-img src="<?= SITE_URL ?>/img/login.jpg"></v-img>
            </v-col>
            <v-col cols="12" md="6">
                <h2 class="text-h2 pt-md-8 text-center">Iniciar sesión</h2>
                <v-form>
                    <v-row class="px-8">
                        <v-col cols="12">
                            <v-text-field label="Correo electrónico" v-model="email" name="email">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field label="Contraseña" type="password" name="password" v-model="password">
                            </v-text-field>
                        </v-col>
                        <v-row>
                            <?= new Controller\Template('components/alert') ?>
                        </v-row>
                        <v-btn class="white--text secondary mb-6 mt-4 py-6" :loading="loading" @click="signIn"
                            :disabled="email == '' || password == ''" block>Iniciar sesión</v-btn>
                        <v-col class="mt-6" cols="12">
                            <a class="mb-13 secondary--text font-weight-bold d-block text-center"
                                @click="dialog = true">
                                Reestablecer contraseña
                            </a>
                        </v-col>
                    </v-row>
                    <?= new Controller\Template('components/reset_password') ?>
                </v-form>
            </v-col>
        </v-row>

    </v-col>
</v-row>